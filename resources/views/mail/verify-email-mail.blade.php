<h1>クイズでぽん！！Eメール認証のお願い</h1>
<p>{{ $user->name }}さんこんにちは！クイズでぽん!!管理者のぱたおです。</p>
<p>下のリンクをクリックしていただき、本会員登録を完了することができます！</p>
<a
    href="{{ route('verify_email.verify', ['email_verify_id' => $user->id, 'token' => $user->token]) }}">メールアドレス認証をする</a>
