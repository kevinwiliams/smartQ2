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
        $message = $data['entry'][0]['changes'][0]['value']['messages'][0] ?? null;

        if ($message && $message['type'] === 'text') {
            $this->sendMessage($message);
            $this->markMessageRead($message['id']);
        }

        
        // Instantiate the Webhook super class.
        $webhook = new WebHook();

        // Read the first message
        Log::info('Webhook Read the first message');
        $notification = $webhook->read(json_decode($rawData, true));
        
        if($notification instanceof TextNotification){
            Log::info('Message Info');
            Log::info('Message: ' . $notification->message());
            Log::info('ID: ' . $notification->id());
            Log::info('Received: ' . $notification->receivedAt()->format('D M d Y h:i a'));
            Log::info('Customer: ' . $notification->customer()?->name());
            Log::info('Phone: ' . $notification->customer()?->phoneNumber());
            
        }

        //Read all messages in case Meta decided to batch them
        // Log::info('Read all messages in case Meta decided to batch them');
        // Log::info(json_encode($webhook->readAll(json_decode($rawData, true))));

        return response()->noContent(200);
    }


    private function sendMessage($message)
    {
        // Instantiate the WhatsAppCloudApi super class.
        $whatsapp_cloud_api = new WhatsAppCloudApi([]);
        $response = $whatsapp_cloud_api->replyTo($message['id'])->sendTextMessage($message['from'], 'Echo: ' . $message['text']['body']);

        Log::info('Send message response');
        Log::info($response->decodedBody());
    }

    private function markMessageRead($messageId)
    {
        // Instantiate the WhatsAppCloudApi super class.
        $whatsapp_cloud_api = new WhatsAppCloudApi([]);
        $whatsapp_cloud_api->markMessageAsRead($messageId);
    }
}
