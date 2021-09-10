@props(['quize', 'isLast'])

@php
$sortNum = (int) $quize->sort_num;
$nextSortNum = $sortNum + 1;
@endphp

<div id="modal" class="hidden">
    <div class="bg-gray-500 opacity-50 top-0 left-0 absolute w-screen h-screen"></div>
    <div
        class="max-w-lg px-4 w-full absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-100 bg-white rounded-lg py-8 shadow-lg flex flex-col items-center justify-center">

        <div id="correct" class="hidden py-8 justify-center align-middle">
            <h2 class="px-4 py-2 text-green-400 font-bold text-3xl">正解</h2>
            <img class="w-1/4" src="{{ asset('images/quiz_man_maru.png') }}" alt="正解の男性">
        </div>

        <div id="incorrect" class="hidden py-8 justify-center align-middle">
            <h2 class="px-4 py-2 text-red-400 font-bold text-3xl">不正解</h2>
            <img class="w-1/4" src="{{ asset('images/quiz_woman_batsu.png') }}" alt="不正解の女性">
        </div>

        {{-- 答えが入ってきます --}}
        <p id="answer" class="mb-12 underline font-bold text-2xl ">
        <p>

        <div class="relative text-center w-full">
            <label style="left: 11.5rem" class="py-1 px-2 -top-4 bg-white absolute" for="info">
                答えの解説
            </label>
            <p class="w-full py-4 px-4 mb-8 border border-yellow-500" id="info" class="mb-8">
                {{ $quize->explanation }}</p>
        </div>
        @if ($isLast !== 'true')
            <button
                onclick="location.href='{{ route('quize_group.showQuize', ['group' => $quize->quize_group_id, 'quize' => $nextSortNum]) }}'"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-6"
                style="background-image: linear-gradient(to right, #4facfe 0%,#4ad5ff 100%)">
                次へ
            </button>
        @else
            <button onclick="location.href='{{ route('quize_group.result', ['group' => $quize->quize_group_id]) }}'"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-6"
                style="background-image: linear-gradient(to right, #4facfe 0%,#4ad5ff 100%)">
                結果発表
            </button>
        @endif
    </div>
</div>
