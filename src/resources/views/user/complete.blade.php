@extends('layouts.app')

@section('title', 'アカウント登録完了画面')

@section('content')
	<div id="margin_top">
                <p>アカウント登録が完了しました。</p>
                {{ link_to_route('user.login', $title = "ログイン画面") }}
	</div>
@endsection