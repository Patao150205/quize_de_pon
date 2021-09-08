<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-center p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-8 font-bold text-xl">クイズカテゴリ一覧</h1>
                    <ul class="mx-auto max-w-sm">
                        @foreach ($categories as $category)
                            <li onclick="location.href='/category/{{ $category->name }}'"
                                class="bg-sky-400 px-8 py-4 my-4 rounded-md hover:bg-sky-500 cursor-pointer transition duration-500">
                                {{ $category->name_jp }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
