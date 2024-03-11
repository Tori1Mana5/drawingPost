<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>アカウント登録完了画面</title>
</head>
<body>
    <p>アカウント登録が完了しました。</p>
    {{ link_to_route('user.login', $title = "ログイン画面") }}
</body>
</html>

@extends('layouts.app')

@section('title', 'アカウント登録完了画面')

@section('content')
	<div>
        <p>アカウント登録が完了しました。</p>
        {{ link_to_route('user.login', $title = "ログイン画面") }}
	</div>
@endsection