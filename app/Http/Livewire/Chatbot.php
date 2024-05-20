<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Log; 


class Chatbot extends Component
{
    public $questions;
    public $lastAnsweredQuestionId = 1;
    public $typedResponse = "";
    
    public function mount()
    {
        $this->questions = Question::with('answers')->get()->unique('question');
    }

    public function sendTypedResponse($questionId)
    {
        Log::info("Selected answer for question $questionId is $this->typedResponse");
        $this->typedResponse = "";
        $this->lastAnsweredQuestionId = $questionId + 1;
    }

    public function sendResponse($questionId, $response)
    {
        Log::info("Selected answer for question $questionId is $response");
        $this->lastAnsweredQuestionId = $questionId + 1;
    }
    
    public function render()
    {   
        // Log::info('Number of questions: ' . count($this->questions));
        // Log::info("Qs status $this->lastAnsweredQuestionId");
        if ($this->lastAnsweredQuestionId === count($this->questions)+1) {
            $questionsToRender = collect();
        }

        $questionsToRender = $this->questions->filter(function ($question) {
            return $question->id <= $this->lastAnsweredQuestionId;
        });

        // Log::info("Qs $questionsToRender");

        return view('livewire.chatbot', [
            'questionsToRender' => $questionsToRender
        ]);
    }
}

    // public function sendResponse($questionId, $response)
    // {
    //     $response = $this->responseInput[$questionId] ?? '';

    //     // avoiding to add new empty answers (temp)
    //     $existingAnswers = Answer::where('question_id', $questionId)->get();
    //     foreach ($existingAnswers as $answer) {
    //         if ($response !== '') {
    //             // updates existing answer
    //             $answer->response = $response;
    //             $answer->save();
    //         }
    //     }

    //     // store to db 
    //     // Answer::create([
    //     //     'question_id' => $questionId,
    //     //     'response' => $response
    //     // ]);

    //     Log::info('Selected', ['question_id' => $questionId, 'response' => $response]);

    //     $this->lastAnsweredQuestionId = $questionId;

    //     unset($this->responseInput[$questionId]);
    // }

// }