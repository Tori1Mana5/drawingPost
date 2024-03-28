@extends('layouts.app')

@section('title', 'パスワード再設定完了')

@section('content')
    <div id="margin_top">
        <h2>パスワードリセットが完了しました</h2>
        {{ link_to_route('user.login', $title = 'TOPへ') }}
    </div>
@endsection