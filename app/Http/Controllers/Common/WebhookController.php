<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Netflie\WhatsAppCloudApi\WebHook;
use Netflie\WhatsAppCloudApi\WebHook\Notification\Text as TextNotification;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

class WebhookController extends Controller
{
    public function handleGet()
    {
        // Instantiate the WhatsAppCloudApi super class.
        $webhook = new WebHook();

        echo $webhook->verify($_GET, config('services.whatsapp.verify_token'));
    }

    public function handleWebhook()
    {
        // Log incoming message
        $rawData = file_get_contents('php://input');

        $data = json_decode($rawData, true);
        Log::info('Raw Data');
        Log::info($data);
        
        // Instantiate the Webhook super class.
        $webhook = new WebHook();

        $notification = $webhook->read($data);
        
        if($notification instanceof TextNotification){
            //Mark message as read
            $this->markMessageRead($notification->id());

            //Respond / process message
            $this->sendMessage($notification);
            

            // Log::info('Message Info');
            // Log::info('Message: ' . $notification->message());
            // Log::info('ID: ' . $notification->id());
            // Log::info('Received: ' . $notification->receivedAt()->format('D M d Y h:i a'));
            // Log::info('Customer: ' . $notification->customer()?->name());
            // Log::info('Phone: ' . $notification->customer()?->phoneNumber());
            
        }

        return response()->noContent(200);
    }


    private function sendMessage(TextNotification $notification)
    {
        // Instantiate the WhatsAppCloudApi super class.
        $whatsapp_cloud_api = new WhatsAppCloudApi([]);
        $whatsapp_cloud_api->replyTo($notification->id())->sendTextMessage($notification->customer()->phoneNumber(), 'Echo: ' . $notification->message());
    }

    private function markMessageRead($messageId)
    {
        // Instantiate the WhatsAppCloudApi super class.
        $whatsapp_cloud_api = new WhatsAppCloudApi([]);
        $whatsapp_cloud_api->markMessageAsRead($messageId);
    }
}
