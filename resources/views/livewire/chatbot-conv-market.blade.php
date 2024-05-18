<div>
    @foreach($conversations as $conversation)
        <div>
            <p>{{ $conversation->question }}</p>
            @if($conversation->answers->isNotEmpty())
                <ul>
                    @foreach($conversation->answers as $answer)
                        <li wire:click="sendResponse('{{ $conversation->id }}', '{{ $answer->id }}')">{{ $answer->response }}</li>
                    @endforeach
                </ul>
            @else
                <input type="text" wire:model="responseInput.{{ $conversation->id }}" placeholder="Enter your response">
                <button wire:click="sendResponse('{{ $conversation->id }}', null)">Submit</button>
            @endif
        </div>
    @endforeach
</div>
