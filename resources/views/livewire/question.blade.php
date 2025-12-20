<div class="flex flex-row ">
    <img class="max-w-[3rem]" src="{{ asset('img/chatIcon.svg') }}" alt="chatbot icon">
    <p class="
        m-4
        p-4
        text-xl
        animation-appear
        shadow-[5px_5px_rgba(217,_83,_2,_0.4),_10px_10px_rgba(217,_83,_2,_0.3),_15px_15px_rgba(217,_83,_2,_0.2),_20px_20px_rgba(0,_98,_90,_0.1),_25px_25px_rgba(0,_98,_90,_0.05)]">
        {{ $question->question }}
    </p>
</div>
