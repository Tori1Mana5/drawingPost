<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>アカウントの新規登録</title>
</head>
<body>
	<h2>アカウント新規登録</h2>
    {{ link_to_route('post', $title = "一覧画面に戻る") }}
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
	{{ Form::open(['route' => 'user.complete']) }}
		{{ Form::token() }}
			ユーザID: {{ Form::text('body[]', old('body.0')) }}
			<br>
			ニックネーム: {{ Form::text('body[]', old('body.1')) }}
			<br>
			メールアドレス: {{ Form::text('body[]', old('body.2')) }}
			<br>
			パスワード: {{ Form::password('body[]') }}
			<br>
			{{ Form::button('登録', ['type' => 'submit']) }}
		{{ Form::close() }}
</body>
</html>
