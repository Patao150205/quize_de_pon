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
                                        <th class="p-2">ユーザー</th>
                                        <th>タイトル</th>
                                        <th>カテゴリ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($favorites as $favorite)
                                        <tr class="py-2">
                                            <td class="border hover:text-sky-500">
                                                <a href="{{ route('user.show', ['user' => $favorite->user_id]) }}">
                                                    {{ $favorite->name }}
                                                </a>
                                            </td>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
</x-app-layout>
