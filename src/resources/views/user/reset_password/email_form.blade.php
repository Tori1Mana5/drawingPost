<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定メール送信フォーム</title>
</head>
<body>
    <div>
        <h2>パスワード再設定メール送信フォーム</h2>
        @if (session('flash_message'))
			<div>
				{{ session('flash_message') }}
			</div>
		@endif
        {{ link_to_route('post', $title = "一覧画面に戻る")}}
        {{ link_to_route('user.register', $title = "アカウント登録") }}

        {{ Form::open(['route' => 'password_reset.email.send']) }}
            <div>
                {{ Form::label('email', 'メールアドレス') }}
                {{ Form::text('email', old('email'), ['id' => 'email']) }}
                @error('email')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{ Form::button('再設定用メールを送信', ['type' => 'submit']) }}
        {{ Form::close() }}

        {{ link_to_route('user.login', $title = "戻る") }}
    </div>
</body>
</html>