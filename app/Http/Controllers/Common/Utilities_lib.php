<?php

namespace App\Http\Controllers\Common;

use App\Core\Constants;
use App\Http\Controllers\Controller;
use App\Mail\CustomerNotification;
use App\Models\DisplaySetting;
use App\Models\Notification;
use App\Models\SmsHistory;
use App\Models\SmsSetting;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;
use Kutia\Larafirebase\Facades\Larafirebase;
use Mail;
use Netflie\WhatsAppCloudApi\Message\Template\Component;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

class Utilities_lib extends Controller
{
    public function getStartAndEndDate($week, $year)
    {
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $ret['week_start'] =  $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end'] =  $dto->format('Y-m-d');
        return $ret;
    }

    // Function to generate OTP
    public function generateNumericOTP($n)
    {

        // Take a generator string which consist of
        // all numeric digits
        $generator = "1234567890";

        // Iterate for n-times and pick a single character
        // from generator and append it to $result

        // Login for generating a random character from generator
        //     ---generate a random number
        //     ---take modulus of same with length of generator (say i)
        //     ---append the character at place (i) from generator to result

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        // Return result
        return $result;
    }

    public function maskEmail($x)
    {
        $arr = explode("@", trim($x));

        return $arr[0][0] . str_repeat("*", strlen($arr[0])  - 2) . $arr[0][strlen($arr[0]) - 1] . "@" . $arr[1];
    }

    public function sanitizePhoneNumber($phone)
    {

        // Using str_replace() function 
        // to replace the word 
        $res = str_replace(array(
            '(', ')',
            '-', ' '
        ), '', $phone);

        // Returning the result 
        return $res;
    }

    public function notificationLog($type, $user, $receiver, $location, $subject, $message, $status, $responseData)
    {
        $notification = new Notification();
        $notification->sender_id = auth()->user()->id;
        $notification->recipient_id = $user->id;
        $notification->location_id = $location;
        $notification->recipient = $receiver;
        $notification->channel = $type;
        if ($subject != "")
            $notification->subject = $subject;

        if ($message != "")
            $notification->message = $message;

        $notification->status = $status;        

        if ($responseData != null)
            $notification->response = $responseData;

        $notification->save();

    }

    public function sendPushNotification(User $client, $message, $location = null, $subject = null)
    {

        if ($client) {
            if ($client->push_notifications && $client->user_token != null) {
                $deviceTokens = [$client->user_token];
                $body = $message;

                $response = Larafirebase::fromArray(['title' => 'SmartQ Notification', 'body' => $body])->sendNotification($deviceTokens);

                $this->notificationLog('push', $client, $client->user_token, $location, $subject, $message, 'Sent', $response);
                return $response;
            }
        }
    }

    public function sendTokenNotification(User $client, $message, $location = null, $subject = null)
    {
        if ($client) {
            

            if ($client->otp_type == "sms") {
                (new Utilities_lib)->sendPushNotification($client, $message, $location, $subject);
                $setting  = SmsSetting::first();
                $sms_lib = new SMS_lib;

                $phone = $this->sanitizePhoneNumber($client->mobile);

                $data = $sms_lib
                    ->provider("$setting->provider")
                    ->api_key("$setting->api_key")
                    ->username("$setting->username")
                    ->password("$setting->password")
                    ->from("$setting->from")
                    ->to("$phone")
                    ->message("$message")
                    ->response();

                $this->notificationLog($client->otp_type, $client, $phone, $location, $subject, $message, 'Sent', $data);

                //store sms information 
                // $sms = new SmsHistory();
                // $sms->from        = $setting->from;
                // $sms->to          = $phone;
                // $sms->message     = $message;
                // $sms->response    = $data;
                // $sms->created_at  = date('Y-m-d H:i:s');
                // $sms->save();
            } else if ($client->otp_type == "email") {
                (new Utilities_lib)->sendPushNotification($client, $message, $location, $subject);
                Mail::to($client->email)->send(new CustomerNotification($client->firstname, $message));
                $this->notificationLog($client->otp_type, $client, $client->email, $location, $subject, $message, 'Sent', '');
            } elseif ($client->otp_type == "whatsapp") {
                $response = $this->sendWhatsAppText($client, $message);
                ///TODO: get interaction id from response
                $this->notificationLog($client->otp_type, $client, $client->mobile, $location, $subject, $message, 'Sent', json_encode($response));
            }
        }
    }

    public function sendWhatsAppText(User $client, $message)
    {
        // // Instantiate the WhatsAppCloudApi super class.

        $whatsapp_cloud_api = new WhatsAppCloudApi([]);
        if ($client) {

            $phone = $this->sanitizePhoneNumber($client->mobile);

            $response = $whatsapp_cloud_api->sendTextMessage($phone, $message);

            // echo '<pre>';
            // print_r($response);
            // echo '</pre>';
            // die();
            return $response;
        }
    }

    public function sendWhatsAppOTP(User $client, $otp)
    {
        // // Instantiate the WhatsAppCloudApi super class.

        $whatsapp_cloud_api = new WhatsAppCloudApi([]);
        if ($client) {

            $phone = $this->sanitizePhoneNumber($client->mobile);

            $component_header = [];

            $component_body = [
                [
                    'type' => 'text',
                    'text' => $otp,
                ],
            ];

            $component_buttons = [
                [
                    'type' => 'button',
                    'sub_type' => 'url',
                    'index' => 0,
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => $otp,
                        ]
                    ]
                ],
            ];

            $components = new Component($component_header, $component_body, $component_buttons);
            // echo '<pre>';
            // print_r($components->toJson());
            // echo '</pre>';
            // die();


            $response = $whatsapp_cloud_api->sendTemplate($phone, 'waitwise_otp', 'en', $components);
            $this->notificationLog('whatsapp', $client, $client->mobile, 0, 'waitwise_otp', $otp, 'Sent', json_encode($response));
            return $response;
        }
    }

    public function generateZoomMeeting()
    {
        // Replace these values with your own API key and secret
        $api_key = 'your_api_key';
        $api_secret = 'your_api_secret';

        // Set the meeting details
        $meeting_topic = 'My Zoom Meeting';
        $meeting_duration = 60;  // in minutes

        // Create the meeting
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.zoom.us/v2/meetings');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . base64_encode("$api_key:$api_secret"),
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'topic' => $meeting_topic,
            'duration' => $meeting_duration,
        ]));
        $response = curl_exec($ch);
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($response_code !== 201) {
            // handle error
        }
        $meeting = json_decode($response);

        // Start the meeting
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.zoom.us/v2/meetings/{$meeting->id}/start");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . base64_encode("$api_key:$api_secret"),
        ]);
        $response = curl_exec($ch);
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($response_code !== 204) {
            // handle error
        }
    }

    public function WhatsAppWebhook()
    {
        // Make sure the request is a POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            die('Invalid request method');
        }

        // Read the request body
        $requestBody = file_get_contents('php://input');

        // Parse the request body as JSON
        $requestData = json_decode($requestBody, true);

        // Validate the request data
        if (!isset($requestData['event']) || !isset($requestData['timestamp']) || !isset($requestData['data'])) {
            http_response_code(400);
            die('Invalid request data');
        }

        // Process the request based on the event type
        switch ($requestData['event']) {
            case 'message_received':
                // Do something with the received message
                $message = $requestData['data']['message'];
                break;
            case 'message_sent':
                // Do something with the sent message
                $message = $requestData['data']['message'];
                break;
            case 'message_delivered':
                // Do something with the delivered message
                $message = $requestData['data']['message'];
                break;
                // Add additional event types here as needed
            default:
                http_response_code(400);
                die('Invalid event type');
        }

        http_response_code(200);
    }

    public function TokenNotification()
    {
        $locationId = auth()->user()->location_id;
        $setting   = DisplaySetting::where('location_id', $locationId)->first();

        $counters = DB::table('counter')
            ->where('status', 1)
            ->where('location_id', $locationId)
            ->orderBy('name', 'ASC')
            ->get();

        $allToken = array();
        $data     = array();
        foreach ($counters as $counter) {
            $tokens = DB::table('token AS t')
                ->select(
                    "t.id",
                    "t.token_no AS token",
                    "t.client_id AS client",
                    "t.client_mobile AS mobile",
                    "d.name AS department",
                    "c.name AS counter",
                    DB::raw("CONCAT_WS(' ', o.firstname, o.lastname) as officer"),
                    "t.status",
                    "t.sms_status",
                    "t.created_at",
                    "t.notification_type AS notification_type"
                )
                ->leftJoin("department AS d", "d.id", "=", "t.department_id")
                ->leftJoin("counter AS c", "c.id", "=", "t.counter_id")
                ->leftJoin("user AS o", "o.id", "=", "t.user_id")
                ->where("t.counter_id", $counter->id)
                ->where("t.location_id",  $locationId)
                ->where("t.status", "0")
                ->offset($setting->alert_position)
                ->orderBy('t.is_vip', 'DESC')
                ->orderBy('t.id', 'ASC')
                ->limit(1)
                ->get();

            foreach ($tokens as $token) {
                $allToken[$counter->name] = (object)array(
                    'id'         => $token->id,
                    'token'      => $token->token,
                    'department' => $token->department,
                    'counter'    => $token->counter,
                    'officer'    => $token->officer,
                    'mobile'     => $token->mobile,
                    'date'       => $token->created_at,
                    'status'     => $token->status,
                    'sms_status' => $token->sms_status,
                    'notification_type' => $token->notification_type,
                );
            }
        }

        foreach ($allToken as $counter => $tokenInfo) {
            if ($tokenInfo->status == 0 && ($tokenInfo->sms_status == 0 || $tokenInfo->sms_status == 2)) {
                if ($tokenInfo->notification_type == "sms" && !empty($tokenInfo->mobile)) {
                    // send sms
                    $data['status'] = true;
                    $data['result'][] = $tokenInfo;
                    $this->sendSMS($tokenInfo, $setting->alert_position);
                    (new CronjobController)->sendPushNotification($tokenInfo);
                } elseif ($tokenInfo->notification_type == "email") {
                    //Send email
                    $data['status'] = true;
                    $data['result'][] = $tokenInfo;
                    $this->sendEmail($tokenInfo);
                    (new CronjobController)->sendPushNotification($tokenInfo);
                } elseif ($tokenInfo->notification_type == "whatsapp") {
                    $data['status'] = true;
                    $data['result'][] = $tokenInfo;
                    $this->sendWhatsAppNotification($tokenInfo, $setting->alert_position);
                } else {
                    //Send email
                    $data['status'] = true;
                    $data['result'][] = $tokenInfo;
                    $this->sendEmail($tokenInfo);
                    (new CronjobController)->sendPushNotification($tokenInfo);
                }
            }
        }
    }
}
