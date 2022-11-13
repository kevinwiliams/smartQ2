<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Kutia\Larafirebase\Facades\Larafirebase;
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

                $reponse = Larafirebase::fromArray(['title' => 'SmartQ Notification', 'body' => $body])->sendNotification($deviceTokens);
            }
        }
    }


    public function sendWhatsAppText(User $client, $message)
    {
        // // Instantiate the WhatsAppCloudApi super class.
        // $whatsapp_cloud_api = new WhatsAppCloudApi([
        //     'from_phone_number_id' => '100105399597511',
        //     'access_token' => 'EAAHlTVMO9m4BACi3qyZBuuSZAM3b34IUUiSHvO7NspUIH1OaA0jtRNisiYPYKLmuBPvPodBkGw2Wjr1EZBYk95P6cY0gHO74FqhPnc4ZAsqjumf4rmi4e2ayypu4ZBeajWZABnwjZAyJ3cFD1U9SWSG30ss3eRXIL5NmbXeEOuf5vg99D0L7rPvneFPUnwot8WO6cr8nwllWAZDZD',
        // ]);
        $whatsapp_cloud_api = new WhatsAppCloudApi([]);
        if ($client) {            

                $phone = $this->sanitizePhoneNumber($client->mobile);

                $whatsapp_cloud_api->sendTextMessage($phone, $message);
        }

        // $phone = $this->sanitizePhoneNumber($client->mobile);
        // $msgobj = [
        //     "messaging_product" => "whatsapp",            
        //     "recipient_type" => "individual",
        //     "to" => $phone,
        //     "type" => "text",
        //     "text" => [
        //         "preview_url" => false,
        //         "body" => $message
        //     ]
        // ];



        // $dataString = json_encode($msgobj);

        // $headers = [
        //     'Authorization: Bearer EAAHlTVMO9m4BACi3qyZBuuSZAM3b34IUUiSHvO7NspUIH1OaA0jtRNisiYPYKLmuBPvPodBkGw2Wjr1EZBYk95P6cY0gHO74FqhPnc4ZAsqjumf4rmi4e2ayypu4ZBeajWZABnwjZAyJ3cFD1U9SWSG30ss3eRXIL5NmbXeEOuf5vg99D0L7rPvneFPUnwot8WO6cr8nwllWAZDZD',
        //     'Content-Type: application/json',
        // ];

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v15.0/100105399597511/messages');
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        // $response = curl_exec($ch);
    }
}
