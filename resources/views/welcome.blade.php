<x-app-layout>
    <div style="background: url('{{ asset('images/cloud-pattern-520x520.png') }}')" class="w-screen h-screen">
        <div class="mx-auto py-8 text-center max-w-6xl">
            <h1 class="mx-auto max-w-sm text-5xl text-left w-full mb-8">
                <p>クイズで</p>
                <p class="font-bold text-red-500 text-right text-6xl">ぽん！！</p>
                <div class="flex justify-between">
                    <img class="w-32 h-48 animate-bounce" src="{{ asset('images/hirameki_woman.png') }}" alt="ひらめいた男性">
                    <img class="w-32 h-48 animate-bounce" src="{{ asset('images/hirameki_man.png') }}" alt="ひらめいた男性">
                </div>
            </h1>
            <div class="mx-auto max-w-sm flex flex-col space-y-8">
                <button onclick="location.href='{{ route('category.index') }}'"
                    class="transition transform animate-pulse hover:scale-150 py-2 hover:text-black rounded-full border-4 border-red-500 ">
                    ぽんぽんする！！
                </button>
                <button onclick="location.href='{{ route('quize_group.menu') }}'"
                    class="transition transform hover:scale-150 py-2 hover:text-black rounded-full border-4 hover:border-yellow-200 bg">
                    クイズの作成
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
