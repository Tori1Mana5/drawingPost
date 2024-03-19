@extends('layouts.app')

@section('title', 'パスワード再設定メール送信フォーム')

@section('content')
<div class="container">
    <h2>パスワード再設定メール送信フォーム</h2>
    {{ link_to_route('user.register', $title = "アカウント登録") }}
    <div class="container card">
        @if (session('flash_message'))
            <div class="form-row">
                {{ session('flash_message') }}
            </div>
        @endif
        <div class="form-row">
            {{ Form::open(['route' => 'password_reset.email.send']) }}
            <div>
                <div class="form-floating mb-3 mt-3">
                    {{ Form::text('email', old('email'), ['id' => 'floatingInput', 'class' => 'form-control', 'placeholder' => '']) }}
                    {{ Form::label('email', 'メールアドレス', ['label' => 'floatingInput']) }}
                </div>
                    @error('email')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                {{ Form::button('再設定用メールを送信', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
    {{ link_to_route('user.login', $title = "戻る") }}
</div>
@endsection