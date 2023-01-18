<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\DisplaySetting;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;
use Kutia\Larafirebase\Facades\Larafirebase;
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

    public function sendPushNotification(User $client, $message)
    {

        if ($client) {
            if ($client->push_notifications && $client->user_token != null) {
                $deviceTokens = [$client->user_token];
                $body = $message;

                $response = Larafirebase::fromArray(['title' => 'SmartQ Notification', 'body' => $body])->sendNotification($deviceTokens);
                return $response;
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

            $component_buttons = [];

            $components = new Component($component_header, $component_body, $component_buttons);

            // $response = $whatsapp_cloud_api->sendTemplate($phone, $message);
            $response = $whatsapp_cloud_api->sendTemplate($phone, 'smartq_otp', 'en', $components);

            // echo '<pre>';
            // print_r($response);
            // echo '</pre>';
            // die();
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

    public function TokenNotification(){
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
                if (!empty($tokenInfo->mobile) && $tokenInfo->status == 0 && ($tokenInfo->sms_status == 0 || $tokenInfo->sms_status == 2)) {
                    if ($tokenInfo->notification_type == "sms") {
                        // send sms
                        $data['status'] = true;
                        $data['result'][] = $tokenInfo;
                        $this->sendSMS($tokenInfo, $setting->alert_position);
                        (new CronjobController)->sendPushNotification($tokenInfo);
                    } elseif ($tokenInfo->notification_type == "email") {
                        //Send email
                        $data['status'] = true;
                        $data['result'][] = $tokenInfo;
                        // send Email 
                        $this->sendEmail($tokenInfo);
                        (new CronjobController)->sendPushNotification($tokenInfo);
                    } elseif ($tokenInfo->notification_type == "whatsapp") {
                        $data['status'] = true;
                        $data['result'][] = $tokenInfo;
                        $this->sendWhatsAppNotification($tokenInfo, $setting->alert_position);
                    }
                }
            }
    }
}
