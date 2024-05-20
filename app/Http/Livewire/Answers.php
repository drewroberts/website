<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Answers extends Component
{
    public $question;
    public $selectedAnswer = null;
    public $sendResponse; // Property to hold the method from the parent

    public function sendResponse($questionId, $response)
    {
        // Call the method received from the parent component
        if ($this->sendResponse) {
            $this->sendResponse($questionId, $response);
        }
    }


    public function render()
    {
        return view('livewire.answers');
    }
}
