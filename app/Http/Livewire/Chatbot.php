<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Log; 


class Chatbot extends Component
{
    public $questions;

    public $responseInput = [];

    public function mount()
    {
        // load questions and answers
        $this->questions = Question::with('answers')->get();
    }

    public function sendResponse($questionId)
    {
        $response = $this->responseInput[$questionId] ?? '';

        // store to 'response' table (seeded) 
        Answer::create([
            'question_id' => $questionId,
            'response' => $response
        ]);

        Log::info('Button clicked', ['question_id' => $questionId, 'response' => $response]);

        // slear input after submission
        unset($this->responseInput[$questionId]);
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}