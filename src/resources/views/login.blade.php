@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
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
@endsection
