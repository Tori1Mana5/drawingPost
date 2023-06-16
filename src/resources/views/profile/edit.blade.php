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
{{ link_to_route('profile.show', $title = "プロフィールに戻る", $parameters = ['user_name' => $user_name]) }}
<br>
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
{{ Form::open(['route' => ['profile.edit.complete', $user_name], 'files' => true]) }}
{{ Form::token() }}
<p>プロフィール: {{ Form::text('body[]', old('body.0')) }}</p>
@foreach ($profiles as $profile)
    @if (!is_null($profile->profile_icon))
        現在のアイコン: <img src="{{ asset(Storage::url($profile->profile_icon)) }}">
    @endif
    <p>変更するアイコン画像: {{ Form::file('profile_image[]') }}</p>
    @if (!is_null($profile->profile_background))
        現在のヘッダー: <img src="{{ asset(Storage::url($profile->profile_background)) }}">
    @endif
@endforeach
<p>変更する背景画像: {{ Form::file('profile_image[]') }}</p>
{{ Form::button('編集', ['type' => 'submit']) }}
{{ Form::close() }}
</body>
</html>
