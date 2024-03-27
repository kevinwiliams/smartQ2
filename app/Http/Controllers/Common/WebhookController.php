<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\CustomerRating;
use App\Models\RatingMetric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Netflie\WhatsAppCloudApi\Message\ButtonReply\Button;
use Netflie\WhatsAppCloudApi\Message\ButtonReply\ButtonAction;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Action;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Row;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Section;
use Netflie\WhatsAppCloudApi\WebHook;
use Netflie\WhatsAppCloudApi\WebHook\Notification\Button as ButtonNotification;
use Netflie\WhatsAppCloudApi\WebHook\Notification\Interactive;
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


        if ($notification instanceof MessageNotification) {
            Log::info('Mark message as read');
            Log::info('notification->id: ' . $notification->id());
            Log::info('notification->replyingToMessageId: ' . $notification->replyingToMessageId());

            $this->markMessageRead($notification->id());

            $this->processMessage($notification);
        }

        return response()->noContent(200);
    }

    private function processMessage(MessageNotification $notification)
    {
        Log::info('Process message');
        //Retrieve customer number
        $customer_mobile = $notification->customer()->phoneNumber();
        Log::info('Customer: ' . $customer_mobile);
        //Check survey table
        try {

            if ($notification->replyingToMessageId() != null){
                $c_rating = CustomerRating::where('mobile', $customer_mobile)
                ->whereRaw('current_step  <=  max_step')
                ->where('last_context', $notification->replyingToMessageId())
                ->orderBy('id', 'desc')->first();
            }else{
                $c_rating = CustomerRating::where('mobile', $customer_mobile)
                ->whereRaw('current_step  <=  max_step')
                ->whereNull('last_context')
                ->orderBy('id', 'desc')->first();
            }
      
        } catch (\Exception $e) {
            Log::error('Caught exception: ',  $e->getMessage());
        }

        if ($c_rating != null) {
            Log::info('Survey found');
            //get config
            $config = json_decode($c_rating->config, true);
            $currentStep = $c_rating->current_step;
            Log::info('Step: ' . $currentStep);
            $crecord = null;
            foreach ($config as $value) {
                if ($value['step'] == $currentStep) {
                    $crecord = $value;
                    break;
                }
            }
            $config_config = json_decode($crecord['config'], true);
            Log::info('config_config: ' . $crecord['config']);
            if ($currentStep == 0) {
                if ($notification instanceof Interactive) {
                    Log::info('Interactive notification');
                    Log::info('notification->description: ' . $notification->description());
                    Log::info('notification->title: ' . $notification->title());
                    if ($config_config['success'] == $notification->title()) {
                        //Send next message and move to next step
                        $this->sendNextSurveyMessage($c_rating);
                    } else {
                        // Close survey
                    }
                }
            } elseif ($currentStep == $c_rating->max_step) {
                if ($notification instanceof Interactive) {
                    Log::info('Interactive notification');
                    Log::info('notification->description: ' . $notification->description());
                    Log::info('notification->title: ' . $notification->title());
                    Log::info('notification->id: ' . $notification->id());

                    if ($config_config['success'] == $notification->title()) {
                        //Send next message and move to next step
                        // $this->sendNextSurveyMessage($c_rating);
                        $c_rating->last_context = NULL;
                        // $c_rating->max_step += 1;
                        $c_rating->save();

                        //Send request for text feedback                        
                        $response = $this->whatsappCloudApi->sendTextMessage($c_rating->mobile, 'Enter the feedback below. It may be as long as you wish but keep it to a single message');
                    } else {
                        $c_rating->status = 'Completed';
                        $c_rating->save();
                    }
                }

                if ($notification instanceof TextNotification) {
                    $c_rating->additional_comments = $notification->message();
                    $c_rating->status = 'Completed';
                    $c_rating->save();
                }
            } else {
                if ($notification instanceof Interactive) {
                    Log::info('Interactive notification');
                    Log::info('notification->description: ' . $notification->description());
                    Log::info('notification->title: ' . $notification->title());
                    Log::info('notification->id: ' . $notification->id());
                    $metric = new RatingMetric();
                    $metric->customer_rating_id = $c_rating->id;
                    $metric->metric_id = $crecord['id'];
                    $metric->rating = $notification->id();
                    $metric->save();
                
                    $this->sendNextSurveyMessage($c_rating);
                }
            }
        } else {
            Log::info('No survey found');
            if ($notification instanceof TextNotification) {
                //Respond / process message
                //$this->sendMessage($notification);
            }
        }
    }

    public function sendNextSurveyMessage(CustomerRating $rating)
    {
        try {
            $UTILS = new Utilities_lib();
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

            if ($next == 0 || $next == $rating->max_step) {
                //Send feedback request
                $rows = [
                    new Button('button-1', $config_config['success']),
                    new Button('button-2', $config_config['failure']),
                ];
                $action = new ButtonAction($rows);

                $response = $this->whatsappCloudApi->sendButton(
                    $rating->mobile,
                    $crecord['description'],
                    $action,
                    $crecord['name'], // Optional: Specify a header (type "text")
                    'Please choose an option' // Optional: Specify a footer 
                );
                $waid = $UTILS->getWhatsAppMessageID($response->decodedBody());
                $rating->last_context = $waid;
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

                $response = $this->whatsappCloudApi->sendList(
                    $rating->mobile,
                    $crecord['name'],
                    $crecord['description'],
                    'Thanks for your time',
                    $action
                );
                $waid = $UTILS->getWhatsAppMessageID($response->decodedBody());
                $rating->last_context = $waid;
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

    private function sendMessage($message)
    {
        // Instantiate the WhatsAppCloudApi super class.
        $whatsapp_cloud_api = new WhatsAppCloudApi([]);
        $response = $whatsapp_cloud_api->replyTo($message['id'])->sendTextMessage($message['from'], 'Echo: ' . $message['text']['body']);

        Log::info('Send message response');
        Log::info($response->decodedBody());
    }
}
