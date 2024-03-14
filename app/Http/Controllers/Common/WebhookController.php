<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleGet(Request $request)
    {
        $mode = $request->hub_mode;
        $challenge = $request->hub_challenge;
        $token = $request->hub_verify_token;
        Log::info($mode);
        Log::info($challenge);
        Log::info($token);
        if ($mode === 'subscribe' && $token === config('services.whatsapp.verify_token')) {
            return response($challenge, 200);
        } else {
            return response('Unauthorized', 403);
        }
    }

    // public function handleWebook(Request $request)
    // {
    //     // Log incoming message
    //     Log::info("Incoming webhook message: " . $request->all());

    //     $data = json_decode($request->all(), true);
    //     Log::info($data);
    //     $message = $data['entry'][0]['changes'][0]['value']['messages'][0] ?? null;

    //     if ($message && $message['type'] === 'text') {
    //         $businessPhoneNumberId = $data['entry'][0]['changes'][0]['value']['metadata']['phone_number_id'];

    //         $this->sendMessage($businessPhoneNumberId, $message);
    //         $this->markMessageRead($businessPhoneNumberId, $message['id']);
    //     }

    //     return response()->noContent(200);
    // }

    public function handleWebhook()
    {
        // Log incoming message
        $rawData = file_get_contents('php://input');
        // Log::info("Incoming webhook message: " . $rawData);

        $data = json_decode($rawData, true);
        Log::info($data);
        // $message = $data['entry'][0]['changes'][0]['value']['messages'][0] ?? null;

        // if ($message && $message['type'] === 'text') {
        //     $businessPhoneNumberId = $data['entry'][0]['changes'][0]['value']['metadata']['phone_number_id'];

        //     $this->sendMessage($businessPhoneNumberId, $message);
        //     $this->markMessageRead($businessPhoneNumberId, $message['id']);
        // }

        return response()->noContent(200);
    }


    private function sendMessage($businessPhoneNumberId, $message)
    {
        $client = new Client([
            'base_uri' => 'https://graph.facebook.com/v18.0/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('GRAPH_API_TOKEN'),
            ],
        ]);

        $client->post("{$businessPhoneNumberId}/messages", [
            'json' => [
                'messaging_product' => 'whatsapp',
                'to' => $message['from'],
                'text' => ['body' => 'Echo: ' . $message['text']['body']],
                'context' => ['message_id' => $message['id']],
            ],
        ]);
    }

    private function markMessageRead($businessPhoneNumberId, $messageId)
    {
        $client = new Client([
            'base_uri' => 'https://graph.facebook.com/v18.0/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('GRAPH_API_TOKEN'),
            ],
        ]);

        $client->post("{$businessPhoneNumberId}/messages", [
            'json' => [
                'messaging_product' => 'whatsapp',
                'status' => 'read',
                'message_id' => $messageId,
            ],
        ]);
    }
}
