<x-app-layout reset="0">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-5xl w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mx-auto bg-white border-b border-gray-200 text-center">
                    <h1 class="text-4xl mb-8 font-bold">クイズ作成メニュー</h1>

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
                        <ul class="max-w-sm mx-auto">
                            <li onclick="location.href='{{ route('quize_group.create') }}'"
                                class="bg-yellow-400 font-bold text-2xl px-8 py-4 my-4 rounded-md hover:bg-yellow-500 cursor-pointer transition duration-500">
                                クイズ集＆問題の新規作成
                                <p class="text-gray-400 text-xs"></p>
                            </li>
                            <li onclick="location.href='{{ route('quize_group.edit_list') }}'"
                                class="bg-yellow-400 font-bold text-2xl px-8 py-4 my-4 rounded-md hover:bg-yellow-500 cursor-pointer transition duration-500">
                                クイズ集＆問題の編集
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <script>
        </script>
</x-app-layout>
