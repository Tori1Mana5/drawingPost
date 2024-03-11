@extends('layouts.app')

@section('title', '新パスワード入力フォーム')

@section('content')
	<div>
        <h2>新しいパスワードを設定</h2>
        {{ Form::open(['route' => 'password_reset.update']) }}
            {{ Form::hidden('reset_token', $userToken->token) }}
            <div>
                {{ Form::label('password', 'パスワード') }}
                {{ Form::password('password', ['class' => $errors->has('password') ? 'incorrect' : '']) }}
                @error('password')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
                @error('token')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                {{ Form::label('password_confirmation', 'パスワードを再入力') }}
                {{ Form::password('password_confirmation', ['class' => $errors->has('password_confirmation') ? 'incorrect' : '']) }}
            </div>
            {{ Form::button('パスワードを再設定', ['type' => 'submit']) }}
        {{ Form::close() }}
	</div>
@endsection