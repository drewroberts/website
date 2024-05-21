<div class="flex flex-wrap overflow-hidden transition-all duration-300 ease-in-out">
    <select id="custom-select" class="hidden">
        @foreach($question->answers as $answer)
            <option value="{{ $answer->id }}">{{$answer->response}}</option>
        @endforeach
    </select>
    <div class="flex flex-row w-full">
        <img class="animation-pop-in max-w-[3rem]" src="{{ asset('img/chatIcon.svg') }}" alt="chatbot icon">
        <div class="flex flex-row ml-4">
        @foreach($question->answers as $answer)
            @if($answer->response)
                <button class="
                    animation-pop-in-lazy
                    rounded 
                    text-gray-500 
                    m-1 py-2 px-4 
                    bg-orange-200 
                    border 
                    border-orange-500 
                    hover:bg-orange-500" 
                    wire:click="sendResponse('{{ $question->id }}', '{{ $answer->response }}')">
                    {{ $answer->response }}
                </button>
            @endif
        @endforeach
        </div>
        <div>
            @if($selectedAnswer)
                <div class="border border-gray-200 p-4 mt-4" wire:poll>
                    {{ $selectedAnswer }}
                </div>
            @endif
        </div>
    </div>
</div>