<div class="border-white-500 border-4 p-8 rounded-lg mx-auto lg:w-1/2">
    @foreach($questionsToRender as $question)
        <div>
            <p class="
                m-4
                p-4
                shadow-[5px_5px_rgba(217,_83,_2,_0.4),_10px_10px_rgba(217,_83,_2,_0.3),_15px_15px_rgba(217,_83,_2,_0.2),_20px_20px_rgba(0,_98,_90,_0.1),_25px_25px_rgba(0,_98,_90,_0.05)]">
                {{ $question->question }}
            </p>
            @if($question->answers->isNotEmpty())
            <!-- wire:model="answers[]" ? -->
                <div class="flex flex-wrap">
                    <select id="custom-select" class="hidden">
                        @foreach($question->answers as $answer)
                            <option value="{{ $answer->id }}">{{$answer->response}}</option>
                        @endforeach
                    </select>
                    @foreach($question->answers as $answer)
                        @if($answer->response)
                            <button class="rounded text-gray-500 m-1 py-2 px-4 bg-orange-200 border border-orange-500 hover:bg-orange-500" wire:click="sendResponse('{{ $question->id }}', '{{ $answer->response }}')">{{ $answer->response }}</button>
                        @endif
                    @endforeach
                </div>
                @else
                <!-- @keydown.enter="submitResponse('{{ $question->id }}')" key-binds Enter -->
            <input 
                type="text" 
                wire:model.debounce.500ms="typedResponse" 
                wire:keydown.enter="sendTypedResponse('{{ $question->id }}')" 
                class="border rounded px-2 py-1 text-black bg-color:black border-orange-500 border-sm" 
                placeholder="Type response..."
            >
            <button 
                class="lg:hidden"
                wire:click="sendTypedResponse('{{ $question->id }}')" 
            >
                <svg fill="#000000" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_222_" d="M250.606,154.389l-150-149.996c-5.857-5.858-15.355-5.858-21.213,0.001 c-5.857,5.858-5.857,15.355,0.001,21.213l139.393,139.39L79.393,304.394c-5.857,5.858-5.857,15.355,0.001,21.213 C82.322,328.536,86.161,330,90,330s7.678-1.464,10.607-4.394l149.999-150.004c2.814-2.813,4.394-6.628,4.394-10.606 C255,161.018,253.42,157.202,250.606,154.389z"></path> </g></svg>
            </button>
            @endif
        </div>
    @endforeach
</div>