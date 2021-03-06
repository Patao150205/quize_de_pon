<x-app-layout reset="0">
    <div class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-center p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-8 font-bold text-xl">第{{ $quize->sort_num }}問</h1>
                    <p>{{ $quize->question }}</p>
                    <ul class="my-8 mx-auto max-w-sm">
                        <li id="choice1" data-choice="choice1" onclick="selectChoice(this)"
                            class="bg-sky-300 px-8 py-4 my-4 rounded-md hover:bg-sky-400 cursor-pointer transition duration-500">
                            {{ $quize->choice1 }}</li>
                        <li id="choice2" data-choice="choice2" onclick="selectChoice(this)"
                            class="bg-sky-300 px-8 py-4 my-4 rounded-md hover:bg-sky-400 cursor-pointer transition duration-500">
                            {{ $quize->choice2 }}</li>
                        <li id="choice3" data-choice="choice3" onclick="selectChoice(this)"
                            class="bg-sky-300 px-8 py-4 my-4 rounded-md hover:bg-sky-400 cursor-pointer transition duration-500">
                            {{ $quize->choice3 }}</li>
                        <li id="choice4" data-choice="choice4" onclick="selectChoice(this)"
                            class="bg-sky-300 px-8 py-4 my-4 rounded-md hover:bg-sky-400 cursor-pointer transition duration-500">
                            {{ $quize->choice4 }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <x-quize.answer-modal :is-last="$isLast" :quize="$quize">
        </x-quize.answer-modal>
    </div>
    <script>
        const music = new Audio('{{ asset('audio/question.mp3') }}');
        music.play();

        function selectChoice(e) {
            const modal = document.getElementById('modal');
            modal.classList.remove('hidden');
            const selectedChoice = e.dataset.choice;
            // 正解
            if ('{{ $quize->correct_choice }}' === selectedChoice) {
                const correcct = document.getElementById('correct');
                correct.classList.remove('hidden');
                correct.classList.add('flex');
                sessionStorage['correct_count'] = Number(sessionStorage['correct_count']) + 1;

                const music = new Audio('{{ asset('audio/correct-answer.mp3') }}');
                music.play();
            }
            // 不正解
            else {
                const incorrect = document.getElementById('incorrect');
                incorrect.classList.remove('hidden');
                incorrect.classList.add('flex');

                const music = new Audio('{{ asset('audio/incorrect-answer.mp3') }}');
                music.play();
            }

            const correctAnswer = document.getElementById('{{ $quize->correct_choice }}').innerText;
            document.getElementById('answer').innerText = correctAnswer;
        }
    </script>
</x-app-layout>
