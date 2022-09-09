@component('mail::message')

# 昨日は{{ $count }}件のつぶやきが追加されました！

{{ $toUser->name }}さんこんにちは！

昨日は{{ $count }}件のつぶやきが追加されました！最新のつぶやきを見に行きましょう。

@component('mail::button', ['url' => route('tweet.index')])
    つぶやきを見にいく
@endcomponent

@endcomponent