<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-5xl w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mx-auto bg-white border-b border-gray-200 text-center">
                    <h1 class="text-4xl font-bold mb-4">{{ $group->title }}</h1>
                    <p class="mb-8">製作者: <a class="underline hover:text-sky-500"
                            href="{{ route('user.show', ['user' => $userId]) }}">{{ $group->username }}</a>
                    </p>
                    <p class="mb-8">問題数: {{ $quizeQuantity }}</p>
                    <div class="relative max-w-md mx-auto">
                        <label style="left: 10.5rem" class="py-1 px-2 -top-4 bg-white absolute" for="info">
                            クイズの概要
                        </label>
                        <p class="w-full py-4 px-4 mb-8 border border-yellow-500" id="info" class="mb-8">
                            {{ $group->information }}</p>
                        <label for="good-btn">
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
                            <button
                                onclick="location.href='{{ route('quize_group.showQuize', ['group' => $group->group_id, 'quize' => 1]) }}'"
                                class=" py-2 px-4 text-white border border-red-400 bg-red-400 focus:border-red-500 focus:bg-red-500 animate-pulse">クイズを解く</button>

                            <p class="m-4 text-red-500">プレイ中は、音がなるから注意してね！</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        sessionStorage.setItem('correct_count', 0);
        let toggleLike;
        let handleLike;
        const group_id = {{ $group->group_id }};
        const user_id = {{ $group->user_id }};
    </script>
    <script src="{{ asset('js/like.js') }}"></script>
</x-app-layout>
