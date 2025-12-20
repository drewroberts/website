<div class="p-8 pr-12 rounded-lg mx-auto lg:w-1/2 lg:h-[20rem] overflow-hidden overflow-y-scroll custom-scrollbar">
    
    @foreach($questionsToRender as $question)
        <div :wire:key="$question->id" >

            <livewire:question :question="$question"  :wire:key="$question->id">
        
            @if($question->answers->isNotEmpty())
                <livewire:typing-dots :key="'typing-dots-' . $question->id" >
            
                <!-- selectable-answers -->
                <div class="flex flex-wrap overflow-hidden transition-all duration-300 ease-in-out lg:m-w-10rem">
               
                    @if(!isset($selectedAnswer[$question->id]))
                    <select id="custom-select" class="hidden">
                        @foreach($question->answers as $answer)
                            <option value="{{ $answer->id }}">{{$answer->response}}</option>
                        @endforeach
                    </select>
                    
                    <div class="flex flex-row w-full">
                        <img class="animation-pop-in self-start max-w-[3rem]" src="{{ asset('img/chatIcon.svg') }}" alt="chatbot icon">
                        <div class="flex flex-row ml-4 flex-wrap ">
                        @foreach($question->answers as $answer)
                            @if($answer->response)
                                <button class="
                                    animation-pop-in-lazy
                                    rounded 
                                    text-black
                                    text-lg
                                    font-bold
                                    m-1 py-2 px-4 
                                    bg-corange 
                                    border 
                                    border-orange-500 
                                    hover:bg-orange-500" 
                                    wire:click="sendResponse('{{ $question->id }}', '{{ $answer->response }}')">
                                    {{ $answer->response }}
                                </button>
                            @endif
                        @endforeach
                        </div>
                    </div>
                    @endif 

                    @if(isset($selectedAnswer[$question->id]))
                        <div class="border border-gray-200 p-4 mt-4 " wire:poll>
                            {{ $selectedAnswer[$question->id] }}
                        </div>
                    @endif
                
                </div>
            
            @else
                <!-- typed-answer-->
                <div class="flex flex-row m-4">

                    @if(!isset($selectedAnswer[$question->id]))
                    <input 
                        type="text" 
                        wire:model.debounce.500ms="typedResponse" 
                        wire:keydown.enter="sendTypedResponse('{{ $question->id }}')" 
                        class="
                            text-white
                            font-lg
                            rounded p-2 text-white bg-transparent 
                            focus:outline-none
                            focus:outline-corange"
                        placeholder="Type response..."
                    >
                    <!-- mobile-friendly -->
                    <button 
                        class="lg:hidden"
                        wire:click="sendTypedResponse('{{ $question->id }}')" 
                    >
                        <svg fill="#000000" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_222_" d="M250.606,154.389l-150-149.996c-5.857-5.858-15.355-5.858-21.213,0.001 c-5.857,5.858-5.857,15.355,0.001,21.213l139.393,139.39L79.393,304.394c-5.857,5.858-5.857,15.355,0.001,21.213 C82.322,328.536,86.161,330,90,330s7.678-1.464,10.607-4.394l149.999-150.004c2.814-2.813,4.394-6.628,4.394-10.606 C255,161.018,253.42,157.202,250.606,154.389z"></path> </g></svg>
                    </button>
                    @endif 

                    @if(isset($selectedAnswer[$question->id]))
                        <div class="border border-gray-200 p-4 mt-4" wire:poll>
                            {{ $selectedAnswer[$question->id] }}
                        </div>
                    @endif
                
                </div>
            @endif
        
        </div>

    @endforeach

    @if($chatDone === true))
        <div class="flex flex-row ">
            <img class="max-w-[3rem]" src="{{ asset('img/chatIcon.svg') }}" alt="chatbot icon">
            <p class="
                m-4
                p-4
                animation-appear
                shadow-[5px_5px_rgba(217,_83,_2,_0.4),_10px_10px_rgba(217,_83,_2,_0.3),_15px_15px_rgba(217,_83,_2,_0.2),_20px_20px_rgba(0,_98,_90,_0.1),_25px_25px_rgba(0,_98,_90,_0.05)]">
                Thank you for your time, I appriciate it.
            </p>
        </div>
    @endif


</div>