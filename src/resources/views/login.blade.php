<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h2>ログイン</h2>
    {{ link_to_route('post', $title = "一覧画面に戻る")}}
    {{ link_to_route('user.register', $title = "アカウント登録") }}
    {{ Form::open(['route' => 'user.authenticate']) }}
       メールアドレス: {{ Form::text('body[]', old('body.0')) }}
       <br>
       @error('body.0')
			<div>{{ $message }}</div>
		@enderror
       パスワード: {{ Form::password('body[]') }}
       <br>
       @error('body.1')
			<div>{{ $message }}</div>
		@enderror
        {{ Form::button('ログイン', ['type' => 'submit']) }}
    {{ Form::close() }}
        {{ link_to_route('password_reset.email.form', $title = "パスワードをお忘れの方") }}
</body>
</html>