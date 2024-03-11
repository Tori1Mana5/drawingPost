@extends('layouts.app')

@section('title', '新規登録')

@section('content')
	<div>
    {{ Form::open(['route' => 'user.complete']) }}
        <div>
            ユーザ名: {{ Form::text('userName', old('userName')) }}
            <br>
            <p>
                15文字以内の半角英数字を入力してください。
                <br>
                ユーザーごとのIDです
            </p>
            @if ($errors->has('userName'))
                <p>
                    {{ $errors->first('userName') }}
                </p>
            @endif
        </div>
        <br>
        <div>
            ニックネーム: {{ Form::text('displayName', old('displayName')) }}
            <br>
            <p>
                4文字以上50文字以内で入力してください。
                <br>
                アカウントのニックネームです。
            </p>
            @if ($errors->has('displayName'))
                <p>
                    {{ $errors->first('displayName') }}
                </p>
            @endif
        </div>
        <br>
        <div>
            メールアドレス: {{ Form::text('email', old('email')) }}
            <br>
            @if ($errors->has('email'))
                <p>
                    {{ $errors->first('email') }}
                </p>
            @endif
            パスワード: {{ Form::password('password') }}
            @if ($errors->has('password'))
                <p>
                    {{ $errors->first('password') }}
                </p>
            @endif
        </div>
        <br>
        {{ Form::button('登録', ['type' => 'submit']) }}
    {{ Form::close() }}
	</div>
@endsection