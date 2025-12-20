<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Support\Facades\Log; 


class Chatbot extends Component
{
    public $questions;
   
    public $lastAnsweredQuestionId = 1;
   
    public $typedResponse = "";
   
    public $chatDone = false;
    
    public function mount()
    {
        $this->questions = Question::with('answers')->get()->unique('question');
        Log::info("AllQ: ". $this->questions->toJson());

        $firstQuestion = $this->questions->first(); // handles non-1-id as a first q. edge-case
        if ($firstQuestion) {
            $this->lastAnsweredQuestionId = $firstQuestion->id;
        }
    }
    
    public $selectedAnswer = [];

    public function updateAnswer($questionId, $response) 
    {
        $this->selectedAnswer[$questionId] = $response;
    }

    public function saveResponse($questionId, $response)
    {
        Response::create([

            'question_id' => $questionId,

            'response' => $response
        ]);
    }

    public function sendTypedResponse($questionId)
    {
        Log::info("Selected answer for question $questionId is $this->typedResponse");

        $this->saveResponse($questionId, $this->typedResponse);

        $this->updateAnswer($questionId, $this->typedResponse);

        $this->typedResponse = "";

        $this->lastAnsweredQuestionId = $questionId + 1;
    }

    public function sendResponse($questionId, $response)
    {
        Log::info("Selected answer for question $questionId is $response");

        $this->saveResponse($questionId, $response);

        $this->updateAnswer($questionId, $response);

        $this->lastAnsweredQuestionId = $questionId + 1;

    }
    
    public function render()
    {   
        if ($this->lastAnsweredQuestionId == $this->questions->max('id') + 1) {

            $questionsToRender = collect();

            $this->chatDone = true;
        }

        $questionsToRender = $this->questions->filter(function ($question) {

            return $question->id <= $this->lastAnsweredQuestionId;

        });

        return view('livewire.chatbot', [
            'questionsToRender' => $questionsToRender
        ]);
    }

}
