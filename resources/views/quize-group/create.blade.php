<x-app-layout reset="0">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-5xl w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mx-auto bg-white border-b border-gray-200 text-center">
                    <h1 class="text-4xl mb-8 font-bold">クイズ作成</h1>

                    <form class="my-8 mx-auto max-w-md" method="POST" action="{{ route('quize_group.store') }}">
                        @csrf
                        <div class="my-8">
                            <label class="block" for="title">タイトル</label>
                            <input required class="w-full focus:outline-none border focus:border-sky-300"
                                placeholder="タイトル" id="title" name="title" type="text">
                        </div>
                        <div class="my-8">
                            <label class="block" for="description">クイズ集の説明</label>
                            <textarea name="description" placeholder="クイズ集の説明" rows="5"
                                class="w-full focus:outline-none border focus:border-sky-300" id="description"
                                name="description" type="text"></textarea>
                        </div>
                        <label class="block mb-4" for="1_quesion">第一問</label>
                        <div id="question1">
                            <textarea class="w-full mb-4 focus:outline-none border focus:border-sky-300" id="1_question"
                                required name="1_question" placeholder="1問目の問題"></textarea>
                            <input required type="radio" name="correct_chocie1" value="choice1">
                            <input required class="mb-2 w-11/12 focus:outline-none border focus:border-sky-300"
                                id="1_choice1" name="1_choice1" type="text" placeholder="選択肢1" />
                            <input required type="radio" name="correct_chocie1" value="choice2">
                            <input required class="w-11/12 mb-2 focus:outline-none border focus:border-sky-300"
                                id="1_choice2" name="1_choice2" type="text" placeholder="選択肢2" />
                            <input required type="radio" name="correct_chocie1" value="choice3">
                            <input required class="w-11/12 mb-2 focus:outline-none border focus:border-sky-300"
                                id="1_choice3" name="1_choice3" type="text" placeholder="選択肢3" />
                            <input required type="radio" name="correct_chocie1" value="choice4">
                            <input required class="w-11/12 mb-2 focus:outline-none border focus:border-sky-300"
                                id="1_choice4" name="1_choice4" type="text" placeholder="選択肢4" />
                        </div>
                        <button type="submit"
                            class="mt-8 py-2 px-4 text-white border border-red-400 bg-red-400 focus:border-red-500 focus:bg-red-500 animate-pulse">クイズが完成</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const test = document.getElementById('question1');
    </script>
</x-app-layout>
