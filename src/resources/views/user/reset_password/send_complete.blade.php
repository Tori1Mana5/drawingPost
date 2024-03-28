@extends('layouts.app')

@section('title', 'パスワードリセットメール送信完了')

@section('content')
    <div id="margin_top">
        <h2>パスワードリセットメールを送信しました。</h2>
    </div>
    {{ link_to_route('user.login', $title = "ログイン画面") }}
@endsection