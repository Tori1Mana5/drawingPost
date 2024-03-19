@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="container">
    <h2>ログイン</h2>
    {{ link_to_route('user.register', $title = "アカウント登録") }}
    <div class="container card">
        {{ Form::open(['route' => 'user.authenticate']) }}
        <div>
            <div class="col-sm-6 mt-3">
                <div class="form-floating mb-3">
                    {{ Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                    {{ Form::label('floatingInput', 'メールアドレス', ['label' => 'floatingInput']) }}
                </div>
                @if ($errors->has('email'))
                <p>
                    {{ $errors->first('email') }}
                </p>
                @endif
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-3">
                    {{ Form::password('password', ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                    {{ Form::label('password', 'パスワード', ['label' => 'floatingInput']) }}
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
            </div>
            {{ Form::button('ログイン', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>
    {{ link_to_route('password_reset.email.form', $title = "パスワードをお忘れの方") }}
</div>
@endsection
