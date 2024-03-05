<!DOCTYPE html>
<html>
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
    <div>
        ユーザ名: {{ Form::text('body[]', old('body.0')) }}
        <br>
        <p>
            15文字以内の英数字を入力してください。
            <br>
            活動時に必要になるユーザーごとの名前です。
        </p>
    </div>
    <br>
    <div>
        ニックネーム: {{ Form::text('body[]', old('body.1')) }}
        <br>
        <p>
            4文字以上50文字以内で入力してください。
            <br>
            活動時のニックネームです。
        </p>
    </div>
    <br>
    <div>
        メールアドレス: {{ Form::text('body[]', old('body.2')) }}
        <br>
        パスワード: {{ Form::password('body[]') }}
    </div>
    <br>
    {{ Form::button('登録', ['type' => 'submit']) }}
{{ Form::close() }}
</body>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>アカウントの新規登録</title>
</head>
</html>
