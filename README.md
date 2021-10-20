# ***クイズでぽん！！***

## 概要

手持ち無沙汰で暇な時、そんな時のための投稿型のクイズアプリ！ユーザー同士問題を出し合うことができます！
___
## イメージ
![イメージ1](https://user-images.githubusercontent.com/79029696/135967485-4b06d42a-039e-42e4-b7d3-94dba7540cd5.png)
![イメージ2](https://user-images.githubusercontent.com/79029696/135967489-827672a5-edb9-43be-8816-8da7bfcf73b3.png)
![イメージ3](https://user-images.githubusercontent.com/79029696/135967483-fadd8195-531d-49aa-a805-72e007640320.png)
___

## URL＆テストアカウント

***[クイズでぽん!! ホーム](https://quize.patapatao.com)***
### テストユーザー  

    email: test1@test.co.jp
    password: password
___

## 主な使用技術・ライブラリ

    PHP
    PHPUnit
    Laravel
    Tailwind CSS
    JavaScript
    Ajax(axios)
    SendGrid
    Docker
    DockerCompose
    MariaDB
___
## 機能一覧

    ユーザー登録機能(Email確認メール送信)

    Email・パスワード認証
    
    パスワードリセット(リセット用Email送信)

    プロフィール作成・閲覧

    クイズジャンル分割表示

    クイズ回答
    (音が出ます笑,ログインしないで遊べます！)

    クイズ作成・編集

    お気に入り機能

    いいね機能

___

## 開発環境
    PHPUnit(リクエストごとに、レンダリングやデータベースの更新処理などのテストを実装)
    Docker

## 本番環境
    自宅サーバー
    Docker

自宅サーバー構成の詳細(`README.md`)はこちら-> ***[patao_serverリポジトリ](https://github.com/Patao150205/patao_server)***
___

## 苦労したこと・こだわったポイント
    laravelは、web開発に必要なものが全て詰まった、ごちゃごちゃしたフレームワークだなと感じてしまいました。  
    なので、全体間をざっと掴むのにも苦労しました。  
    また、私自身、MVCフレームワークでの開発が始めただったのもあると思います。

    ビューの名前を一部変更し、すべての変更すべき箇所を変更できていなかったりしたので、  
    テストの必要性を感じ、テストを書いてみました。

    いいねボタンやお気に入り登録ボタンなど、ページの遷移が伴う必要のない処理に関しては、  
    Ajaxを使用し、ユーザの使い心地の向上を目指しました。

    UIに関しても今まで作ってきたアプリは、色使いが下手で、ごちゃごちゃしたような感じになってしまっていたので、  
    使う色を少なめに、色の強弱を中心に構成させました。
___
[製作者の Twitter](https://twitter.com/Patao_program)
