<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\OpenAI;

class ConversationController extends Controller
{
    protected $conversation = [];

    public function start(Request $request)
    {
        // Initialize the conversation and send the first message.
        $this->conversation[] = ["role" => "system", "content" => "You are a helpful assistant."];
        $this->conversation[] = ["role" => "assistant", "content" => "How can I assist you today?"];

        return response()->json($this->conversation);
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        // Add the user's message to the conversation.
        $this->conversation[] = ["role" => "user", "content" => $message];

        // Generate the assistant's response using OpenAI API.
        $assistantMessage = $this->generateResponse($message);

        // Add the assistant's response to the conversation.
        $this->conversation[] = ["role" => "assistant", "content" => $assistantMessage];

        return response()->json(["role" => "assistant", "content" => $assistantMessage]);
    }

    protected function generateResponse($message)
    {
        $openai = new OpenAI(getenv('OPENAI_API_KEY'));

        $response = $openai->chatCompletion([
            'model' => 'gpt-3.5-turbo',
            'messages' => $this->conversation
        ]);

        return $response['choices'][0]['message']['content'];
    }
}
