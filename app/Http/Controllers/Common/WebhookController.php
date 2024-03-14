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
        $data = json_decode($request->getContent(), true);
        Log::info($data);
        if ($request->query('hub.mode') === 'subscribe' &&
            $request->query('hub.verify_token') === config('services.whatsapp.verify_token')) {
            return response($request->query('hub.challenge'), 200);
        } else {
            return response('Unauthorized', 403);
        }
    }

    public function handleWebook(Request $request)
    {
        // Log incoming message
        \Log::info("Incoming webhook message: " . $request->getContent());

        $data = json_decode($request->getContent(), true);

        $message = $data['entry'][0]['changes'][0]['value']['messages'][0] ?? null;

        if ($message && $message['type'] === 'text') {
            $businessPhoneNumberId = $data['entry'][0]['changes'][0]['value']['metadata']['phone_number_id'];

            $this->sendMessage($businessPhoneNumberId, $message);
            $this->markMessageRead($businessPhoneNumberId, $message['id']);
        }

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
