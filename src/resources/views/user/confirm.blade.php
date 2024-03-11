@extends('layouts.app')

@section('title', '確認画面')

@section('content')
	<div>
        <p>この内容でアカウント登録していいですか？</p>
        ユーザID: {{ old('userName') }}
		<br>
		ニックネーム: {{ old('displayName') }}
		<br>
        メールアドレス: {{ old('email') }}
        <br>
		パスワード: セキュリティのため表示しません
		<br>
        {{ link_to_route('user.regist', $title = "修正する") }}
	</div>
@endsection