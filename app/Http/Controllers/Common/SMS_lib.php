<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

/*
*---------------------------------------------------------------
*                           SMS GATEWAY
*---------------------------------------------------------------
* @author    : Md. Shohrab Hossain
* @email     : <sourav.diubd@gmail.com>
* @created at: 21 December 2017
*---------------------------------------------------------------
*  | HOW TO USE 
*  -------------
*  | load library
*  | $this->load->library('sms_lib');
*  | or
*  | $sms_lib = new SMS_lib;
*  | 
*  | $template = "Your template with %custom_id% and %custom_name%";
*  | $template_config = array(
*  |    'custom_id' => '30252',
*  |    'custom_name' => 'Jane Doe'
*  | );
*  | 
*  | If you don't have custom template then you can send direct message
*  | ->message($template)
*  | Destination / to must be integer (don't use qoute)
*  | ->to(0123456789)
*  | 
*  | $this->sms_lib->provider("provider_name")
*  |        ->api_key("api key or handle")
*  |        ->username("username")
*  |        ->password("password or user id")
*  |        ->from("form")
*  |        ->to("to")
*  |        ->message($template, $template_config)
*  |        ->response();
*  |         
*---------------------------------------------------------------
* NOTE: Only supported nexmo, clickatell, budgetsms & robi
*---------------------------------------------------------------
*/

class SMS_lib extends Controller
{
    private $_provider = "nexmo";
    private $_url;
    private $_data;
    private $_api_key;
    private $_username;
    private $_password;
    private $_from;
    private $_to;
    private $_message;


    public function provider($provider = null)
    {
        $this->_provider = trim($provider);
        return $this;
    }


    public function api_key($api_key = null)
    {
        $this->_api_key = trim($api_key);
        return $this;
    }


    public function username($username = null)
    {
        $this->_username = trim($username);
        return $this;
    }


    public function password($password = null)
    {
        $this->_password = trim($password);
        return $this;
    }


    public function from($from = null)
    {
        $this->_from = trim($from);
        return $this;
    }


    public function to($to = null)
    {
        $this->_to = trim($to);
        return $this;
    }


    public function message($template = null, $data = array())
    {
        $message = $template;
        if (is_array($data) && sizeof($data) > 0) {
            $message = $this->_template($template, $data);
        }
        $this->_message = trim($message);
        return $this;
    }


    public function response()
    {
        switch ($this->_provider) {
            case 'budgetsms':
                $this->_budgetsms();
                return $this->_postRequest($this->_url);
                break;
            case 'nexmo':
                $this->_nexmo();
                return $this->_postRequest($this->_url);
                break;
            case 'clickatell':
                $this->_clickatell();
                return $this->_getRequest($this->_url);
                break;
            case 'robi':
                $this->_robi();
                return $this->_postRequest($this->_url);
                break;
            case 'robi':
                $this->_campaigntag();
                return $this->_postRequest($this->_url);
                break;
            case 'd7':
                $this->_d7();
                return $this->_postRequest($this->_url);
                break;
            case 'floppysend':
                $this->_floppysend();
                return $this->_postRequest($this->_url);
                break;
            case 'smschef':
                $this->_smschef();
                return $this->_postRequest($this->_url);
                break;
            default:
                return json_encode(array(
                    'status'  => false,
                    'request_url' => $this->_url,
                    'message' => 'Unknown api provider'
                ));
                break;
        }
    }


    private function _template($template = null, $data = array())
    {
        foreach ($data as $key => $value) {
            $template = str_replace("[$key]", $value, $template);
        }
        return $template;
    }


    /*
    *---------------------------------------------------------------
    * AVAILABLE SMS API
    *---------------------------------------------------------------
    * NOTE: Those function return api url
    */
    private function _budgetsms()
    {
        $this->_data = array(
            'username' => $this->_username,
            'handle'   => $this->_api_key,
            'userid'   => $this->_password,
            'msg'      => $this->_message,
            'from'     => $this->_from,
            'to'       => $this->_to,
        );
        $this->_url = "https://api.budgetsms.net/sendsms/?";
    }


    private function _nexmo()
    {
        $this->_data = array(
            'api_key'   => $this->_api_key,
            'api_secret'   => $this->_password,
            'text'      => $this->_message,
            'from'      => strstr($this->_from, ' ', true),
            'to'        => $this->_to,
            'type'      => "unicode",
        );
        $this->_url = "https://rest.nexmo.com/sms/json?";
    }


    private function _clickatell()
    {
        $this->_data = array(
            'apiKey'   => $this->_api_key,
            'content'  => $this->_message,
            'from'     => $this->_from,
            'to'       => $this->_to,
        );
        $this->_url = "https://platform.clickatell.com/messages/http/send?";
    }


    private function _robi()
    {
        $this->_data = array(
            'apiKey'   => $this->_api_key,
            'Username' => $this->_username,
            'Password' => $this->_password,
            'Message'  => $this->_message,
            'From'     => $this->_from,
            'To'       => $this->_to,
        );
        $this->_url = "http://bmpws.robi.com.bd/ApacheGearWS/SendTextMessage?";
    }

    private function _campaigntag()
    {
        $this->_data = array(
            'key'        => $this->_api_key,
            'campaign'   => 0,
            'routeid'    => (!empty($this->_username)) ? ($this->_username) : 7,
            'type'       => 'text',
            'contacts'   => $this->_to,
            'senderid'   => $this->_from,
            'msg'        => $this->_message,
        );
        $this->_url = "http://sms.campaigntag.com/app/smsapi/index.php?";
    }


    private function _d7()
    {
        $this->_data = array();

        // $this->_username = Config::get('services.sms.username');
        // $this->_password = Config::get('services.sms.password');

        $encodedmsg = urlencode($this->_message);
        $this->_url = "https://http-api.d7networks.com/send?username=$this->_username&password=$this->_password&dlr-method=POST&dlr-url=https://4ba60af1.ngrok.io/receive&dlr=yes&dlr-level=3&to=$this->_to&from=smsinfo&content=$encodedmsg";
    }

    private function _floppysend()
    {
        $this->_data = array(
            'to'   => $this->_to,
            'from' => $this->_from,
            'dcs' => 0,
            'text'  => $this->_message
        );
        $this->_url = "https://api.floppy.ai/sms";
    }

    private function _smschef()
    {
        $this->_data = array(
            'to'   => $this->_to,
            'from' => $this->_from,
            'dcs' => 0,
            'text'  => $this->_message
        );

        $this->_data = array(
            "secret" => $this->_api_key, 
            "mode" => "devices",
            "device" => env('SMS_DEVICE_ID'),
            "sim" => 1,
            "priority" => 1,
            "phone" => "+" . $this->_to,
            "message" => $this->_message
        );
        $this->_url = "https://www.cloud.smschef.com/api/send/sms";
    }

    /*
    *---------------------------------------------------------------
    * CURL RESPONSE
    *---------------------------------------------------------------
    * NOTE: Return response data 
    */
    private function _getRequest()
    {
        // Send the GET request with cURL
        $ch = curl_init($this->_url . "" . http_build_query($this->_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        // curl_close($ch);

        if (curl_errno($ch)) {
            return json_encode(array(
                'status'      => false,
                'request_url' => $this->_url,
                'error'       => curl_error($ch),
                'message'     => $this->_message
            ));
        } else {
            return json_encode(array(
                'status'      => true,
                'request_url' => $this->_url,
                'success'     => $response,
                'message'     => $this->_message
            ));
        }
        curl_close($ch);
    }


    private function _postRequest()
    {
        switch ($this->_provider) {
            case 'floppysend':
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $this->_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => http_build_query($this->_data),
                    CURLOPT_HTTPHEADER => array(
                        'x-api-key: ' . $this->_api_key . '',
                        'Content-Type: application/x-www-form-urlencoded'
                    ),
                ));
                $response = curl_exec($ch);
                break;
            default:
                $ch = curl_init($this->_url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->_data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                break;
        }


        // echo '<pre>';
        // print_r($response);
        // echo '</pre>';
        // die();

        if (curl_errno($ch)) {
            curl_close($ch);
            return json_encode(array(
                'status'      => false,
                'request_url' => $this->_url,
                'error'       => curl_error($ch),
                'message'     => $this->_message
            ));
        } else {
            curl_close($ch);
            return json_encode(array(
                'status'      => true,
                'request_url' => $this->_url,
                'success'     => $response,
                'message'     => $this->_message
            ));
        }

        
    }
}



// $obj = new SMS_lib;
// $data = $obj->provider("budgetsms")
//             ->api_key("b39edd600577b6b3bd16cc69aec82f05")
//             ->username("yungong")
//             ->password("13906")
//             ->from("BdTask")
//             ->to(8801821742285)
//             ->message("Hello %mr_x%. Your email is : %email%. Thank you", array('mr_x'=>'Mr. X','email'=>'xyz@example.com'))
//             ->response();
// echo "<pre>";
// $data = json_decode($data, true);
// print_r($data);
// echo "</pre>";