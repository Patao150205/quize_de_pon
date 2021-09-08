<div class="hidden sm:block bg-white">
    <div class="max-w-7xl text-center mx-auto flex">
        <div class="hidden sm:-my-px flex-grow  sm:block">
            <x-nav-link href="/" :active="request()->routeIs('dashboard')">
                ホーム
            </x-nav-link>
        </div>
        <div class="hidden  sm:-my-px flex-grow sm:block">
            <x-nav-link :href="route('category.index')" :active="request()->routeIs('dashboard')">
                クイズ一覧
            </x-nav-link>
        </div>
        {{-- <div class="hidden sm:-my-px flex-grow sm:block">
            <x-nav-link :href="route('quize_group.index')" :active="request()->routeIs('dashboard')">
                お気に入り
            </x-nav-link>
        </div>
        <div class="hidden  sm:-my-px flex-grow sm:block">
            <x-nav-link :href="route('quize_group.index')" :active="request()->routeIs('dashboard')">
                クイズの作成
            </x-nav-link>
        </div> --}}
    </div>
</div>
