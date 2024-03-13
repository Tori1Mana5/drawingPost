@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div>
    {{ Form::open(['route' => 'user.authenticate']) }}
    <div class="form-row">
        @error('error')
                <div>{{ $error }}</div>
            @enderror
            <div class="form-group">
                {{ Form::label('email', 'メールアドレス') }}
                {{ Form::text('email', old('email'), ['class' => 'form-control']) }}
            </div>
            @if ($errors->has('email'))
                <p>
                    {{ $errors->first('email') }}
                </p>
            @endif
            <div class="form-group">
                {{ Form::label('password', 'パスワード') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
            </div>
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
            {{ Form::button('ログイン', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}
    {{ link_to_route('password_reset.email.form', $title = "パスワードをお忘れの方") }}
</div>
@endsection
