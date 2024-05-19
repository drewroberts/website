<div class="border-green-400 border-4 p-8 rounded-lg mx-auto lg:w-1/2">
    @foreach($questions as $question)
        <div class=>
            <p>{{ $question->question }}</p>
            @if($question->answers->isNotEmpty())
                <ul class="flex flex-row">
                    @foreach($question->answers as $answer)
                        <button class="m-3 p-3 border-white bg-slate-400">{{ $answer->response }}</button>
                    @endforeach
                </ul>
            @else
                <input type="text" wire:model="responseInput.{{ $question->id }}" class="border rounded px-2 py-1" placeholder="Enter your response">
                <button wire:click="sendResponse('{{ $question->id }}')">Submit</button>
            @endif
        </div>
    @endforeach
</div>