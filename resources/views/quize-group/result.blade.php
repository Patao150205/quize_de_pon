<x-app-layout reset="0">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-5xl w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mx-auto bg-white border-b border-gray-200 text-center">
                    <h1 class="text-4xl mb-8 font-bold">クイズ成績</h1>
                    <h2 class="text-2xl mb-4">{{ $group->title }}</h2>
                    <p id="result-count" class="mb-8 text-lg"></p>
                    <div class="relative max-w-md mx-auto">
                        <label for="good-count">
                            いいね
                        </label>
                        <p id="good-btn" class="mb-8 mt-2">
                            <span @if (is_null($userId))
                                onclick="location.href='{{ route('login') }}'"
                                @endif
                                id="heart" data-control="0" onclick="toggleLike(this)"
                                class="@if ($isGood)
                                text-red-500
                            @endif fas fa-heart mr-3 cursor-pointer"></span><span
                                id="good-count">{{ $goodCount }}</span>
                        </p>

                        <div class="flex flex-col">
                            @if ($isFavorite)
                                <button id="favorite-btn" data-control="1" onclick="toggleLike(this)"
                                    class="bg-gray-200 mb-8 border border-sky-400 py-2 px-4">お気に入りを解除</button>
                            @else
                                <button @if (is_null($userId))
                                    onclick="location.href='{{ route('login') }}'"
                            @endif
                            id="favorite-btn" data-control="1" onclick="toggleLike(this)"
                            class="mb-8 border border-sky-400 py-2 px-4">お気に入りに追加</button>
                            @endif
                            <button onclick="location.href='{{ route('category.index') }}'"
                                class="py-2 px-4 text-white border border-red-400 bg-red-400 focus:border-red-500 focus:bg-red-500 animate-pulse">クイズカテゴリ一覧へ</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        const correctCount = sessionStorage.getItem('correct_count');

        if ({{ $count }} == correctCount) {
            const music = new Audio('{{ asset('audio/perfect-result.mp3') }}');
            music.play();
        } else {
            const music = new Audio('{{ asset('audio/result.mp3') }}');
            music.play();
        }

        const resultCount = document.getElementById('result-count');
        resultCount.innerText = `正答数: ${correctCount} / {{ $count }}`;
        let toggleLike;
        let handleLike;
        const group_id = {{ $group->id }};
        const user_id = {{ $group->user_id }};
    </script>
    <script src="{{ asset('js/like.js') }}"></script>
</x-app-layout>
