<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール編集</title>
</head>
<body>
    <h2>
        プロフィール
    </h2>
    {{ link_to_route('post', '一覧画面に戻る') }}
    <br>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {{ Form::open(['route' => ['profile.complete', $user_name], 'files' => true]) }}
        {{ Form::token() }}
        <p>プロフィール: {{ Form::text('body[]', old('body.0')) }}</p>
        <p>アイコン画像: {{ Form::file('profile_image[]') }}</p>
        <p>背景画像: {{ Form::file('profile_image[]') }}</p>
        {{ Form::button('編集', ['type' => 'submit']) }}
    {{ Form::close() }}
</body>
</html>