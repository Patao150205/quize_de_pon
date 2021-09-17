<x-app-layout reset="0">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-5xl w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mx-auto bg-white border-b border-gray-200 text-center">
                    <h1 class="text-4xl mb-8 font-bold">クイズ集の作成</h1>

                    <form class="my-8 mx-auto max-w-md" method="POST" action="{{ route('quize_group.store') }}">
                        @csrf
                        <div class="my-8">
                            <label class="block" for="category">カテゴリ<span
                                    class="text-red-500 ml-1">*</span></label>
                            <select required name="category_id">
                                <option value="" hidden>選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_jp }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-8">
                            <label class="block" for="title">タイトル<span
                                    class="text-red-500 ml-1">*</span></label>
                            <input required class="w-full focus:outline-none border focus:border-sky-300"
                                placeholder="タイトル" id="title" name="title" type="text">
                        </div>
                        <div class="my-8">
                            <label class="block" for="information">クイズ集の説明<span
                                    class="text-red-500 ml-1">*</span></label>
                            <textarea required name="information" placeholder="クイズ集の説明" rows="5"
                                class="w-full focus:outline-none border focus:border-sky-300" id="information"
                                name="information" type="text"></textarea>
                        </div>

                        <button type="submit"
                            class="mt-8 py-2 px-4 text-white border border-red-400 bg-red-400 focus:border-red-500 focus:bg-red-500 animate-pulse">クイズ集の保存
                            & 問題を作成する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
