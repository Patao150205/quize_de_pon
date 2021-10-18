<x-app-layout reset="0">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-5xl w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  max-w-md mx-auto bg-white border-b border-gray-200 text-center">
                    <h1 class="text-4xl mb-8 font-bold">問題の編集</h1>
                    <h2 class="my-2">{{ $group->title }}</h2>
                    <div class="flex flex-col-reverse md:flex-row justify-between">
                        <button onclick="removeAccordion()"
                            class="border text-yellow-400 border-yellow-400 px-8 py-2 my-2 rounded-md hover:border-yellow-500 hover:text-yellow-500 cursor-pointer transition duration-500">問題を減らす</button>
                        <button onclick="addAccordion()" id="add_btn"
                            class="bg-yellow-400 px-8 py-2 my-2 rounded-md hover:bg-yellow-500 cursor-pointer transition duration-500">問題を追加する</button>
                    </div>
                    <ul id="validation"></ul>
                    <ul id="list" class="shadow-md">
                        <x-quize.accordion></x-quize.accordion>
                        @for ($i = 1; $i <= $quizzes->count(); $i++)
                            <li id="tab{{ $i }}" class="w-full mx-auto">
                                <form id="form{{ $i }}">
                                    <div class="tab w-full overflow-hidden border-t">
                                        <input class="absolute opacity-0" id="tab-single-{{ $i }}"
                                            type="radio" name="tabs" />
                                        <label class="block p-5 leading-normal cursor-pointer"
                                            for="tab-single-{{ $i }}">第{{ $i }}問</label>
                                        <div
                                            class="tab-content overflow-scroll border-l-2 bg-gray-100 border-yellow-500 leading-normal">
                                            <div class="p-5">
                                                <div class="my-2">
                                                    <label class="block"
                                                        for="question{{ $i }}">問題<span
                                                            class="text-red-500 ml-1">*</span></label>
                                                    <textarea rows="4" required name="question{{ $i }}"
                                                        placeholder="問題文"
                                                        class="w-full focus:outline-none border focus:border-yellow-300"
                                                        id="question{{ $i }}"
                                                        name="question{{ $i }}"
                                                        type="text">{{ $quizzes[$i - 1]['question'] }}</textarea>
                                                </div>
                                                <div class="my-2">
                                                    <label class="block"
                                                        for="{{ $i }}_choice1">選択肢1<span
                                                            class="text-red-500 ml-1">*</span></label>
                                                    <input @if ($quizzes[$i - 1]['correct_choice'] === 'choice1')
                                                    checked
                                                    @endif required name="correct_choice{{ $i }}"
                                                    value="choice1" type="radio">
                                                    <input required value="{{ $quizzes[$i - 1]['choice1'] }}"
                                                        class="w-11/12 focus:outline-none border focus:border-yellow-300"
                                                        placeholder="選択肢1" id="{{ $i }}_choice1"
                                                        name="{{ $i }}_choice1" type="text">
                                                </div>
                                                <div class="my-2">
                                                    <label class="block"
                                                        for="{{ $i }}_choice2">選択肢2<span
                                                            class="text-red-500 ml-1">*</span></label>
                                                    <input @if ($quizzes[$i - 1]['correct_choice'] === 'choice2')
                                                    checked
                                                    @endif required name="correct_choice{{ $i }}"
                                                    value="choice2" type="radio">
                                                    <input required value="{{ $quizzes[$i - 1]['choice2'] }}"
                                                        class="w-11/12 focus:outline-none border focus:border-yellow-300"
                                                        placeholder="選択肢2" id="{{ $i }}_choice2"
                                                        name="{{ $i }}_choice2" type="text">
                                                </div>
                                                <div class="my-2">
                                                    <label class="block"
                                                        for="{{ $i }}_choice3">選択肢3<span
                                                            class="text-red-500 ml-1">*</span></label>
                                                    <input @if ($quizzes[$i - 1]['correct_choice'] === 'choice3')
                                                    checked
                                                    @endif required name="correct_choice{{ $i }}"
                                                    value="choice3" type="radio">
                                                    <input required value="{{ $quizzes[$i - 1]['choice4'] }}"
                                                        class="w-11/12 focus:outline-none border focus:border-yellow-300"
                                                        placeholder="選択肢3" id="{{ $i }}_choice3"
                                                        name="{{ $i }}_choice3" type="text">
                                                </div>
                                                <div class="my-2">
                                                    <label class="block"
                                                        for="{{ $i }}_choice4">選択肢4<span
                                                            class="text-red-500 ml-1">*</span></label>
                                                    <input @if ($quizzes[$i - 1]['correct_choice'] === 'choice4')
                                                    checked
                                                    @endif required name="correct_choice{{ $i }}"
                                                    value="choice4" type="radio">
                                                    <input required value="{{ $quizzes[$i - 1]['choice4'] }}"
                                                        class="w-11/12 focus:outline-none border focus:border-yellow-300"
                                                        placeholder="選択肢4" id="{{ $i }}_choice4"
                                                        name="{{ $i }}_choice4" type="text">
                                                </div>
                                                <div class="my-2">
                                                    <label class="block"
                                                        for="explanation{{ $i }}">答えの説明</label>
                                                    <textarea rows="4" required name="explanation{{ $i }}"
                                                        placeholder="答えの説明"
                                                        class="w-full focus:outline-none border focus:border-yellow-300"
                                                        id="explanation{{ $i }}"
                                                        name="explanation{{ $i }}"
                                                        type="text">{{ $quizzes[$i - 1]['explanation'] }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        @endfor
                    </ul>
                    <button id="submit_btn" onclick="handleSubmit()"
                        class="mt-8 py-2 px-4 text-white border border-red-400 bg-red-400 focus:border-red-500 focus:bg-red-500 animate-pulse">クイズが完成</button>
                    <p class="mt-4 text-red-500">※問題数が0の場合は、クイズ集は公開されません。</p>
                    <p class="mt-4 text-red-500">※再ロードすると変更内容が消えています。</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        let addAccordion;
        let removeAccordion;
        let handleSubmit;
        let accordionCount = {{ $quizzes->count() }};
        let isEdit = true;
        const user_id = {{ Auth::id() }};
        const quize_group_id = {{ $group->id }};
    </script>
    <script src="{{ asset('js/accordion.js') }}"></script>
</x-app-layout>
