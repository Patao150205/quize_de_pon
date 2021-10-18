<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div
        class="@if (request()->routeIs(['quize_group.menu', 'quize_group.create', 'quize_group.edit', 'quize_group.edit_list', 'quize.create', 'quize.edit']))
        bg-yellow-200
        @else
        bg-sky-200
    @endif px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex  justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a class="flex" href="/">
                            <x-application-logo class="mr-4" />
                            <h1 class=" self-center"> クイズでぽん！！</h1>
                        </a>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name ?? '' }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            @if (is_null(Auth::id()))
                                <x-dropdown-link onclick="location.href='{{ route('login') }}'">
                                    ログイン
                                </x-dropdown-link>
                                <x-dropdown-link onclick="location.href='{{ route('register') }}'">
                                    新規登録
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link
                                    onclick="location.href='{{ route('user.show', ['user' => Auth::id()]) }}'">
                                    <div class="font-medium text-base text-gray-800">
                                        {{ Auth::user()->name ?? '' }}</div>
                                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? '' }}
                                    </div>
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        ログアウト
                                    </x-dropdown-link>
                                </form>
                            @endif
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="/" :active="request()->routeIs('welcome')">
                ホーム
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('category.index') }}"
                :active="request()->routeIs('category.index')">
                クイズ一覧
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('like.favoriteIndex') }}"
                :active="request()->routeIs('like.favoriteIndex')">
                お気に入り
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('quize_group.menu') }}"
                :active="request()->routeIs('quize_group.menu')">
                クイズの作成
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">


            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                @if (is_null(Auth::id()))
                    <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        ログイン
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        新規登録
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('user.show', ['user' => Auth::id()])"
                        :active="request()->routeIs('user.show', ['user' => Auth::id()])">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name ?? '' }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? '' }}</div>
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            ログアウト
                        </x-responsive-nav-link>
                    </form>
                @endif
            </div>
        </div>
    </div>
</nav>
