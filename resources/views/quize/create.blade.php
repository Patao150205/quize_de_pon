<x-app-layout reset="0">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-5xl w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  max-w-md mx-auto bg-white border-b border-gray-200 text-center">
                    <h1 class="text-4xl mb-8 font-bold">問題の作成</h1>
                    <div class="flex flex-col-reverse md:flex-row justify-between">
                        <button onclick="addAccordion()"
                            class="border text-yellow-400 border-yellow-400 px-8 py-2 my-2 rounded-md hover:border-yellow-500 hover:text-yellow-500 cursor-pointer transition duration-500">問題を減らす</button>
                        <button
                            class="bg-yellow-400 px-8 py-2 my-2 rounded-md hover:bg-yellow-500 cursor-pointer transition duration-500">問題を追加する</button>
                    </div>
                    <form class="my-8 mx-auto" method="POST" action="{{ route('quize_group.store') }}">
                        @csrf
                        <ul id="list">
                            <x-quize.accordion></x-quize.accordion>
                        </ul>
                        <button type="submit"
                            class="mt-8 py-2 px-4 text-white border border-red-400 bg-red-400 focus:border-red-500 focus:bg-red-500 animate-pulse">クイズが完成</button>
                        <p class="text-red-500">※問題数が0の場合は、公開されません。</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let addAccordion;
        let removeAccordion;
    </script>
    <script src="{{ asset('js/accordion.js') }}"></script>
</x-app-layout>
