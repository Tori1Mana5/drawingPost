<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>アカウントの新規登録</title>
</head>
<body>
	<h2>アカウント新規登録</h2>
	{{ Form::open(['route' => 'user.complete']) }}
		{{ Form::token() }}
			ユーザID: {{ Form::text('body[]', old('body.0')) }}
			<br>
			@error('body.0')
				<div>{{ $message }}</div>
			@enderror
			ニックネーム: {{ Form::text('body[]', old('body.1')) }}
			<br>
			@error('body.1')
				<div>{{ $message }}</div>
			@enderror
			メールアドレス: {{ Form::text('body[]', old('body.2')) }}
			<br>
			@error('body.2')
				<div>{{ $message }}</div>
			@enderror
			パスワード: {{ Form::password('body[]') }}
			<br>
			@error('body.3')
				<div>{{ $message }}</div>
			@enderror
			{{ Form::button('登録', ['type' => 'submit']) }}
		{{ Form::close() }}
		{{ link_to_route('post', $title = "一覧画面に戻る") }}
</body>
</html>