<div class="text-lg p-4 flex justify-center flex-col-reverse">
    Hello world!
    <br/>
    The current time is {{ time() }}
    <br/>
    <button 
        wire:click="$refresh" 
        class="bg-white text-gray-900 hover:bg-yellow-200">
        refresh
    </button>
</div>
