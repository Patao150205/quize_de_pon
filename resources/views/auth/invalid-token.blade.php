<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            <p>無効な認証トークンです。新規登録からもう一度やり直してください。</p>
            <br>
            <p class="text-red-500">※送信されたメールのリンクの有効期限は、1時間です。ご注意ください。</p>
            <br>
        </div>
        <div class="flex flex-col my-8 space-y-4 items-center">
            <a class="underline text-sky-400 hover:text-sky-500 transition" href="{{ route('welcome') }}">ホームに戻る</a>
            <a class="underline text-sky-400 hover:text-sky-500 transition" href="{{ route('register') }}">新規登録へ</a>
        </div>
    </x-auth-card>
</x-app-layout>
