@extends('layouts.app')

@section('title', 'プロフィール登録')

@section('content')
    {{ link_to_route('profile.show', $title = "プロフィールに戻る", $parameters = ['userName' => $userName]) }}
    <br>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {{ Form::open(['route' => ['profile.register.complete', $userName], 'files' => true]) }}
        <p>プロフィール: {{ Form::text('body[]', old('body.0')) }}</p>
        <p>アイコン画像: {{ Form::file('profile_image[]') }}</p>
        <p>背景画像: {{ Form::file('profile_image[]') }}</p>
        {{ Form::button('編集', ['type' => 'submit']) }}
    {{ Form::close() }}
@endsection