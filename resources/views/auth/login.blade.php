<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-40 h-40" />
            </a>
        </x-slot>

        <div class="text-center border border-gray-400 my-8 p-4">
            <h2 class="text-bold text-lg text-sky-500">テストユーザー</h2>
            <p>メールアドレス: test1@test.co.jp</p>
            <p>パスワード: password</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" value="メールアドレス" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" value="パスワード" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">ログイン状態を保持する</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        パスワードを忘れた方
                    </a>
                @endif

                <x-button class="ml-3">
                    ログイン
                </x-button>
            </div>
            <a class="block text-center underline text-sm text-gray-600 pt-8 hover:text-gray-900"
                href="{{ route('register') }}">
                新規登録はこちらから
            </a>
        </form>
    </x-auth-card>
</x-app-layout>
