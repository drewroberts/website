<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Conversation;

class ChatbotConvMarket extends Component
{
    public $conversations;

    public $responseInput = [];

    public function mount()
    {
        $this->conversations = Conversation::with('answers')->get();
    }

    public function sendResponse($id)
    {
        $conversation = Conversation::findOrFail($id);
        $response = isset($this->responseInput[$id]) ? $this->responseInput[$id] : '';

        // Store the user's response in the database
        $conversation->responses()->create(['response' => $response]);
        
        // Clear response input after submission
        unset($this->responseInput[$id]);
    }

    public function render()
    {
        return view('livewire.chatbot-conv-market');
    }

}