<div class="hidden sm:block bg-white">
    <div class="max-w-7xl text-center mx-auto flex">
        <div class="hidden sm:-my-px flex-grow  sm:block">
            <x-nav-link href="/" :active="request()->routeIs('welcome')">
                ホーム
            </x-nav-link>
        </div>
        <div class="hidden  sm:-my-px flex-grow sm:block">
            <x-nav-link :href="route('category.index')"
                :active="request()->routeIs(['category.index', 'category.show', 'quize_group.showQuize', 'quize_group.show', 'user.show'])">
                クイズ一覧
            </x-nav-link>
        </div>
        <div class="hidden sm:-my-px flex-grow sm:block">
            <x-nav-link :href="route('like.favoriteIndex')" :active="request()->routeIs('like.favoriteIndex')">
                お気に入り
            </x-nav-link>
        </div>
        <div class="hidden  sm:-my-px flex-grow sm:block">
            <x-nav-link :href="route('quize_group.create')" :active="request()->routeIs('quize_group.create')">
                クイズの作成
            </x-nav-link>
        </div>
    </div>
</div>
