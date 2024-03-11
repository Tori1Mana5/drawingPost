@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    {{ Form::open(['route' => 'user.authenticate']) }}
        @error('error')
            <div>{{ $error }}</div>
        @enderror
       メールアドレス: {{ Form::text('email', old('email')) }}
       <br>
       @if ($errors->has('email'))
            <p>
                {{ $errors->first('email') }}
            </p>
        @endif
       パスワード: {{ Form::password('password') }}
       <br>
       @if ($errors->has('password'))
            <p>
                {{ $errors->first('password') }}
            </p>
        @endif

        @if (session('flash_message'))
			<div>
				{{ session('flash_message') }}
			</div>
		@endif
        {{ Form::button('ログイン', ['type' => 'submit']) }}
    {{ Form::close() }}
        {{ link_to_route('password_reset.email.form', $title = "パスワードをお忘れの方") }}
@endsection
