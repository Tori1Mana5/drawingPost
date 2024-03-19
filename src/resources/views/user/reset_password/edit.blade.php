@extends('layouts.app')

@section('title', '新パスワード入力フォーム')

@section('content')
<div class="container">
    <h2>新しいパスワードを設定</h2>
    <div class="container card">
        {{ Form::open(['route' => 'password_reset.update']) }}
        {{ Form::hidden('reset_token', $userToken->token) }}
        <div class="col-sm-6 g-3 mt-3">
            <div class="form-floating">
                {{ Form::password('password', ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                {{ Form::label('floatingInput', 'パスワード', ['label' => 'floatingInput']) }}
            </div>
        </div>
        <div>
            @error('password')
                <p>
                    {{ $message }}
                </p>
            @enderror
            @error('token')
                <p>
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="col-sm-6 g-3 mt-3">
            <div class="form-floating">
                {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                {{ Form::label('password_confirmation', 'パスワードを再入力', ['label' => 'floatingInput']) }}
            </div>
        </div>
        <div class="mt-3">
            {{ Form::button('パスワードを再設定', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection