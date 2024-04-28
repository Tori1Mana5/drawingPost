@extends('layouts.app')

@section('title', 'プロフィール登録')

@section('content')
<div class="container" id="margin_top">
    {{ link_to_route('profile.show', $title = "プロフィールに戻る", $parameters = ['userName' => $userName]) }}
    <div class="container card">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{ Form::open(['route' => ['profile.register.complete', $userName], 'files' => true]) }}
        <div class="form-row">
            <div class="col-sm-6 mt-3">
                <div class="form-floating">
                    {{ Form::textarea('text', old('text'), ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                    {{ Form::label('floatingInput', 'プロフィール', ['label' => 'floatingInput']) }}
                </div>
            </div>
            <div class="col-sm-6 mt-3">
                <div class="input-group">
                    {{ Form::label('profileIconImage', 'アイコン画像', ['class' => 'input-group-text']) }}
                    {{ Form::file('profileIconImage', ['class' => 'form-control', 'id' => 'profileIconImage']) }}
                </div>
            </div>
            <div class="col-sm-6 mt-3">
                <div class="input-group">
                    {{ Form::label('profileBackground', '背景画像', ['class' => 'input-group-text']) }}
                    {{ Form::file('profileBackground', ['class' => 'form-control', 'id' => 'profileBackground']) }}
                </div>
            </div>
            {{ Form::button('編集', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection