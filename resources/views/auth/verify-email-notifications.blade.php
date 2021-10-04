<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            <p>仮会員登録ありがとうございます！ クイズでぽん！！の会員限定機能を利用する前に、利用者様の登録メールアドレス宛に、届いたリンクをクリックすることにより、本会員登録を完了することができます。</p>
            <br>
            <p class="text-red-500">※送信されたメールのリンクの有効期限は、1時間です。ご注意ください。</p>
            <br>
            <p>
                ※少し待っても届かない場合、もう一度お試しいただくか、それでも届かない場合、サイト管理のTwitter(<a class="text-sky-500"
                    href="https://twitter.com/Patao_program">@Patao_program</a>)DMまでお手数ですがご連絡いただけると幸いです。
            </p>
        </div>
        <div class="flex flex-col my-8 space-y-4 items-center">
            <a class="underline text-sky-400 hover:text-sky-500 transition" href="{{ route('welcome') }}">ホームに戻る</a>
            <a class="underline text-sky-400 hover:text-sky-500 transition" href="{{ route('register') }}">新規登録へ</a>
        </div>
    </x-auth-card>
</x-app-layout>
