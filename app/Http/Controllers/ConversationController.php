<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\GameInformation;

use League\Csv\Writer;
use Illuminate\Support\Facades\Response;

class ConversationController extends Controller
{
    public function start(Request $request)
    {
        $username = $request->route('username');
        $gameId = $request->route('id');

        $gameInformation = GameInformation::find($gameId);
        if (!$gameInformation) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        $defenderCards = [
            $gameInformation->defender_card1->defender_card_name,
            $gameInformation->defender_card2->defender_card_name,
            $gameInformation->defender_card3->defender_card_name,
            $gameInformation->defender_card4->defender_card_name,
            $gameInformation->defender_card5->defender_card_name,
        ];

        $defenderCardsStr = implode("', '", $defenderCards);

        $request->session()->put('conversation', [
            ["role" => "system", "content" => "You are a game player. The user has five cards, '" . $defenderCardsStr . "', each containing a piece of personal information. Your task is to guide the user to choose three cards they feel comparatively comfortable having known to others out of the five. Engage in a discussion with the user about the level of resistance they feel in having the information on each card known to others, and about the user's privacy consciousness. Please refrain from bringing up topics that are not related to the game or the cards."],
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
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
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

    public function store(Request $request)
    {
        $message = Message::create($request->all());
        return response()->json($message, 201);
    }

    public function export()
    {
        $csv = Writer::createFromString('');
        $csv->insertOne(['id', 'user_name', 'game_id', 'created_at', 'sender', 'message_content']);

        $messages = Message::all();

        foreach ($messages as $message) {
            $csv->insertOne($message->toArray());
        }

        $csvStr = $csv->toString();

        return Response::make($csvStr, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=messages.csv',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}
