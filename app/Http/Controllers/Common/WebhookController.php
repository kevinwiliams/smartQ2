<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\CustomerRating;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Netflie\WhatsAppCloudApi\Message\ButtonReply\Button;
use Netflie\WhatsAppCloudApi\Message\ButtonReply\ButtonAction;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Action;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Row;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Section;
use Netflie\WhatsAppCloudApi\WebHook;
use Netflie\WhatsAppCloudApi\WebHook\Notification;
use Netflie\WhatsAppCloudApi\WebHook\Notification\Button as ButtonNotification;
use Netflie\WhatsAppCloudApi\WebHook\Notification\MessageNotification;
use Netflie\WhatsAppCloudApi\WebHook\Notification\Text as TextNotification;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

class WebhookController extends Controller
{
    protected $whatsappCloudApi;

    public function __construct()
    {
        $this->whatsappCloudApi = new WhatsAppCloudApi([]);
    }

    public function handleGet(Request $request)
    {
        // Verify the webhook using the provided token
        $webhook = new WebHook();
        echo $webhook->verify($request->query(), config('services.whatsapp.verify_token'));
    }

    public function handleWebhook(Request $request)
    {
        // Log incoming message
        $rawData = $request->getContent();
        Log::info('Raw Data');
        Log::info($rawData);

        $data = json_decode($rawData, true);
        // Instantiate the Webhook super class.
        $webhook = new WebHook();
        $notification = $webhook->read($data);

        $this->markMessageRead($notification->id());
        if ($notification instanceof MessageNotification) {
            $this->processMessage($notification);
        }

        return response()->noContent(200);
    }

    private function processMessage(MessageNotification $notification)
    {
        //Retrieve customer number
        $customer_mobile = $notification->customer()->phoneNumber();

        //Mark message as read       
        $this->markMessageRead($notification->id());

        //Check survey table
        $c_rating = CustomerRating::where('mobile', $customer_mobile)
            ->where('current_step', '<', 'max_step')
            ->orderBy('id', 'desc')
            ->first();

        if ($c_rating) {
            //get config
            $config = json_decode($c_rating->config, true);
            $currentStep = $c_rating->current_step;

            $crecord = null;
            foreach ($config as $value) {
                if ($value['step'] == $currentStep) {
                    $crecord = $value;
                    break;
                }
            }
            $config_config = json_decode($crecord['config'], true);

            if ($currentStep == 0) {
                if ($notification instanceof ButtonNotification) {
                    if ($config_config['success'] == $notification->text()) {
                        //Send next message and move to next step
                        $this->sendNextSurveyMessage($c_rating, $customer_mobile);
                    } else {
                        //Thank you/rejection message
                    }
                } else {
                    //Invalid response
                }
            } elseif ($currentStep == $c_rating->max_step) {
                // Handle max step
            } else {
                // Handle other steps
            }

            if ($notification instanceof TextNotification) {
                //Respond / process message
                // $this->sendMessage($notification);
            }

            if ($notification instanceof ButtonNotification) {
                //Respond / process message
                // $this->sendMessage($notification);
            }
        } else {
            // Handle case where customer rating is not found
        }
    }

    public function sendNextSurveyMessage(CustomerRating $rating, $mobile)
    {
        try {
            $config = json_decode($rating->config, true);
            $next = $rating->current_step + 1;
            $crecord = null;
            foreach ($config as $value) {
                if ($value['step'] == $next) {
                    $crecord = $value;
                    break;
                }
            }
            
            $config_config = json_decode($crecord['config'], true);

            // echo '<pre>';
            // print_r($next);
            // echo '</pre>';
            // echo '<pre>';
            // print_r($crecord);
            // echo '</pre>';            
            // echo '<pre>';
            // print_r($config_config);
            // echo '</pre>';
            // echo '<pre>';
            // print_r($config_config['success']);
            // echo '</pre>';
            // die();

            if ($next == 0) {
                //Send feedback request
                $rows = [
                    new Button('button-1', $config_config['success']),
                    new Button('button-2', $config_config['failure']),
                ];
                $action = new ButtonAction($rows);

                $response = $this->whatsappCloudApi->sendButton(
                    $mobile,
                    $crecord['description'],
                    $action,
                    $crecord['name'], // Optional: Specify a header (type "text")
                    'Please choose an option' // Optional: Specify a footer 
                );

                Log::info($response->decodedBody());
            } else {
                $rows = [
                    new Row('1', '⭐️', "Experience wasn't good enough"),
                    new Row('2', '⭐⭐️', "Experience could be better"),
                    new Row('3', '⭐⭐⭐️', "Experience was ok"),
                    new Row('4', '⭐⭐️⭐⭐', "Experience was good"),
                    new Row('5', '⭐⭐️⭐⭐⭐️', "Experience was excellent"),
                ];
                $sections = [new Section('Stars', $rows)];
                $action = new Action('Submit', $sections);

                $this->whatsappCloudApi->sendList(
                    $mobile,
                    'Rate your experience',
                    'Please consider rating your shopping experience on our website',
                    'Thanks for your time',
                    $action
                );
            }

            //Move record to next step
            $rating->current_step = $next;
            $rating->save();
        } catch (\Exception $ex) {
            Log::error($ex);
        }
    }

    private function markMessageRead($messageId)
    {
        $this->whatsappCloudApi->markMessageAsRead($messageId);
    }
}
