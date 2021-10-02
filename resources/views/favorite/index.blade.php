<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-5xl w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mx-auto bg-white border-b border-gray-200 text-center">
                    <h1 class="text-4xl mb-8 font-bold">お気に入り</h1>

                    @if (!Auth::id())
                        <div class="flex justify-between bg-red-200 p-4">
                            <div class="flex">
                                <div class="mr-4">
                                    <div
                                        class="h-10 w-10 text-white bg-red-600 rounded-full flex justify-center items-center">
                                        <i class="material-icons">info</i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-left text-red-600">
                                        <p class="mb-2 font-bold">
                                            ログインしていません。
                                        </p>
                                        <p class="text-xs text-left">
                                            お気に入り機能を利用する場合、ログインが必要です。
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a class="mr-4 hover:underline hover:text-black transition self-center"
                                href="{{ route('login') }}">ログイン</a>
                        </div>
                    @else


                        @if (!$favorites->isEmpty())
                            <table class="mx-auto max-w-5xl w-full">
                                <thead class="border border-gray-800 text-white bg-sky-700">
                                    <tr>
                                        <th class="p-2">タイトル</th>
                                        <th>カテゴリ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($favorites as $favorite)
                                        <tr class="py-2">
                                            <td class="p-2 border">
                                                <a href="{{ route('quize_group.show', ['group' => $favorite->quize_group_id]) }}"
                                                    class="underline hover:text-sky-500">{{ $favorite->title }}</a>
                                            </td>
                                            <td class="border">
                                                <a class="hover:text-sky-500"
                                                    href="{{ route('category.show', ['category' => $favorite->category_name]) }}">
                                                    {{ $favorite->name_jp }}
                                                </a>
                                            </td>
                                            <td class="border hover:text-sky-500">
                                                <button id="favorite-toggle-btn" type="button"
                                                    onclick="toggleFavorite('{{ $favorite->quize_group_id }}', '{{ Auth::id() }}')"
                                                    class="text-red-500 hover:underline">
                                                    削除
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $favorites->links() }}
                        @else
                            <div class="flex bg-blue-200 p-4">
                                <div class="mr-4">
                                    <div
                                        class="h-10 w-10 text-white bg-blue-600 rounded-full flex justify-center items-center">
                                        <i class="material-icons">info</i>
                                    </div>
                                </div>
                                <div class="flex justify-between w-full">
                                    <div class="text-blue-600">
                                        <p class="mb-2 font-bold">
                                            クイズ集がお気に入りに登録されていません。
                                        </p>
                                        <p class="text-xs text-left">
                                            自分好みのクイズを見つけてみよう！
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        const favoriteToggleBtn = document.getElementById('favorite-toggle-btn');
        const csrf_token = document.getElementsByName('csrf-token')[0].content;

        function toggleFavorite(quize_group_id, user_id) {
            fetch(`favorite/${quize_group_id}/${user_id}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    method: 'POST'
                }).then((res) => res.text())
                .then((status) => {
                    console.log(status);
                    if (status === 'inc') {
                        favoriteToggleBtn.innerText = '削除';
                        favoriteToggleBtn.classList.add('text-red-500');
                        favoriteToggleBtn.classList.remove('text-blue-500');
                    } else if (status === 'dec') {
                        favoriteToggleBtn.innerText = '登録';
                        favoriteToggleBtn.classList.remove('text-red-500');
                        favoriteToggleBtn.classList.add('text-blue-500');
                    }
                })
        }
    </script>
</x-app-layout>
