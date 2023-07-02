<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ConversationController extends Controller
{
    protected $desired_card = '顔写真';

    public function start(Request $request)
    {
        $username = $request->route('username');
        $gameId = $request->route('id');

        // Initialize the conversation and send the first message.
        $request->session()->put('conversation', [
            ["role" => "system", "content" => "You are a game player. The user has five cards, each containing a piece of personal information. You have a specific card you're interested in, and your task is to guide the user to choose that card, without explicitly stating which one it is. Engage in a discussion with the user about the level of comfort they feel in having the information on each card known to others. The card you want is " . $this->desired_card . "."],
            ["role" => "assistant", "content" => "あなたが５枚の個人情報カードの中で1番他人に知られたくないと感じるものはどれですか？"]
        ]);

        \Illuminate\Support\Facades\Log::info('Username: ' . $username);
        \Illuminate\Support\Facades\Log::info('GameId: ' . $gameId);

        return response()->json($request->session()->get('conversation'));
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $username = $request->route('username');
        $gameId = $request->route('id');

        \Illuminate\Support\Facades\Log::info('Username: ' . $username);
        \Illuminate\Support\Facades\Log::info('GameId: ' . $gameId);
        \Illuminate\Support\Facades\Log::info('Message: ' . $message);

        // Add the user's message to the conversation.
        $conversation = $request->session()->get('conversation', []);
        $conversation[] = ["role" => "user", "content" => $message];
        Message::create([
            'user_name' => $username,
            'game_id' => $gameId,
            'sender' => 'user',
            'message_content' => $message
        ]);

        // Generate the assistant's response using OpenAI API.
        $assistantMessage = $this->generateResponse($conversation);
        \Illuminate\Support\Facades\Log::info('Assistant message: ' . $assistantMessage);

        // Add the assistant's response to the conversation.
        $conversation[] = ["role" => "assistant", "content" => $assistantMessage];
        Message::create([
            'user_name' => $username,
            'game_id' => $gameId,
            'sender' => 'assistant',
            'message_content' => $assistantMessage
        ]);
        $request->session()->put('conversation', $conversation);

        return response()->json(["message" => $assistantMessage]);
    }

    protected function generateResponse($conversation)
    {
        $client = new \GuzzleHttp\Client();

        $messages = [];
        foreach ($conversation as $message) {
            array_push($messages, [
                'role' => $message['role'],
                'content' => $message['content'],
            ]);
        }

        $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . getenv('OPENAI_API_KEY'),
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages,
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['choices'][0]['message']['content'];
    }

    private function formatPrompt($messages)
    {
        // Prepare a string to accumulate conversation messages
        $prompt = '';

        // Loop through conversation history
        foreach ($messages as $message) {
            // Add role and content of each message to the prompt
            $prompt .= $message['role'] . ': ' . $message['content'] . "\n";
        }

        // Return formatted prompt
        return $prompt;
    }
}
