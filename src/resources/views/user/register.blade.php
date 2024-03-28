@extends('layouts.app')

@section('title', '新規登録')

@section('content')
<div class="container" id="margin_top">
    <div class="container card">
    {{ Form::open(['route' => 'user.complete']) }}
        <div class ="row g-3 align-items-center mt-2">
            <div class="col-sm-6 mt-2">
                <div class="form-floating">
                    {{ Form::text('userName', old('userName'), ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                    {{ Form::label('floatingInput', 'ユーザー名', ['label' => 'floatingInput']) }}
                </div>
            </div>
            <div class="col-sm-6">
                <span class="form-text">
                    15文字以内の半角英数字を入力してください。
                    <br>
                    ユーザーごとのIDです
                </span>
            </div>
            <div>
                @if ($errors->has('userName'))
                    <p>
                        {{ $errors->first('userName') }}
                    </p>
                @endif        
            </div>
        </div>
        <div class ="row g-3 align-items-center">
            <div class="col-sm-6">
                <div class="form-floating">
                    {{ Form::text('displayName', old('displayName'), ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                    {{ Form::label('displayName', 'ニックネーム', ['label' => 'floatingInput']) }}
                </div>
            </div>
            <div class="col-sm-6">
                <span class="form-text">
                    4文字以上50文字以内で入力してください。
                    <br>
                    アカウントのニックネームです。
                </span>
            </div>
            <div>
                @if ($errors->has('displayName'))
                    <p>
                        {{ $errors->first('displayName') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-sm-6">
                <div class="form-floating">
                    {{ Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => 'name@example.com']) }}
                    {{ Form::label('email', 'メールアドレス', ['label' => 'floatingInput']) }}
                </div>
            </div>
            <div>
                @if ($errors->has('email'))
                    <p>
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="row g-3 align-items-center">
            <div class="col-sm-6">
                <div class="form-floating">
                    {{ Form::password('password', ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                    {{ Form::label('password', 'パスワード', ['label' => 'floatingInput']) }}
                </div>
            </div>
            <div class="col-sm-6">
                <span class="form-text">
                    8文字以上で入力してください。
                </span>
            </div>
            <div>
            @if ($errors->has('password'))
                <p>
                    {{ $errors->first('password') }}
                </p>
            @endif
            </div>
        </div>
            {{ Form::button('登録', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
            {{ Form::close() }}
    </div>
</div>
@endsection