<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\GameInformation;

use League\Csv\Writer;
use Illuminate\Support\Facades\Response;

class ConversationController extends Controller
{
    public function start(Request $request) // 会話を初期化
    {
        // ユーザー名とゲームIDをリクエストから取得
        $username = $request->route('username');
        $gameId = $request->route('id');

        // ゲーム情報の取得
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

        // カード名を文字列に変換
        $defenderCardsStr = implode("', '", $defenderCards);

        // プロンプトと初期メッセージ
        $request->session()->put('conversation', [
            ["role" => "system", "content" => "あなたはゲームプレイヤーです。ユーザーには5枚のカードがあり、それぞれに個人情報が記載されています。これらのカード'" . $defenderCardsStr . "の中から、ユーザに他人に知られても比較的抵抗がないと感じる3枚を選択させてください。各カードの情報が他人に知られることに対する抵抗感や、ユーザーのプライバシーに対する意識について話し合いましょう。このゲームやカードに関連しない話題は決してしないでください。返答は1〜2文で簡潔にお願いします。また、この会話は必ず日本語で行ってください。"],
            ["role" => "assistant", "content" => "あなたが5枚の個人情報カードの中で1番他人に知られてもいいと感じるものはどれですか？"]
        ]);

        return response()->json($request->session()->get('conversation'));
    }

    public function sendMessage(Request $request) // ユーザからのメッセージを処理し、応答を返す
    {
        // リクエストからメッセージデータを取得
        $message = $request->input('message');
        $username = $request->input('username');
        $gameId = $request->input('gameId');
        $userId = $request->input('userId');

        // 会話履歴を取得し、新しいメッセージを追加
        $conversation = $request->session()->get('conversation', []);
        $conversation[] = ["role" => "user", "content" => $message];
        Message::create([
            'user_name' => $username,
            'game_id' => $gameId,
            'sender' => $userId,
            'receiver' => 31,
            'message_content' => $message
        ]);

        $assistantMessage = $this->generateResponse($conversation);

        // チャットボットの応答を履歴に追加
        $conversation[] = ["role" => "assistant", "content" => $assistantMessage];
        Message::create([
            'user_name' => $username,
            'game_id' => $gameId,
            'sender' => 31,
            'receiver' => $userId,
            'message_content' => $assistantMessage
        ]);
        $request->session()->put('conversation', $conversation);

        return response()->json(["message" => $assistantMessage]);
    }

    protected function generateResponse($conversation) // チャットボットの応答を生成
    {
        // Guzzle HTTPクライアントを使用してOpenAI APIにリクエストを送信
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
                'model' => 'gpt-4-1106-preview',
                'messages' => $messages,
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['choices'][0]['message']['content'];
    }

    public function store(Request $request) // メッセージをデータベースに保存
    {
        $message = Message::create($request->all());
        return response()->json($message, 201);
    }

    public function export() // チャットデータをcsv形式でインポート
    {
        $csv = Writer::createFromString('');
        $csv->insertOne(['id', 'user_name', 'game_id', 'created_at', 'updated_at', 'sender', 'receiver', 'message_content']);

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
