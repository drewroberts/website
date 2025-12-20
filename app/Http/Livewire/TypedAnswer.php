<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TypedAnswer extends Component
{
    public $question;
    public $selectedAnswer = null;

    public function sendTypedResponse()
    {
        // Call the method received from the parent component
        if ($this->sendTypedResponse) {
            $this->sendTypedResponse();
        }
    }

    public function render()
    {
        return view('livewire.typed-answer');
    }
}
