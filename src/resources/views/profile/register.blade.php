@extends('layouts.app')

@section('title', 'プロフィール登録')

@section('content')
<div>
    {{ link_to_route('profile.show', $title = "プロフィールに戻る", $parameters = ['userName' => $userName]) }}
    <br>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    {{ Form::open(['route' => ['profile.register.complete', $userName], 'files' => true]) }}
    <div class="form-row">
        <div class="col-sm-6">
            <div class="form-floating">
                {{ Form::textarea('text', old('text'), ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                {{ Form::label('floatingInput', 'プロフィール', ['label' => 'floatingInput']) }}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-floating">
                {{ Form::label('profileIconImage', 'アイコン画像') }}
                {{ Form::file('profileIconImage', ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-floating">
                {{ Form::label('profileBackground', '背景画像') }}
                {{ Form::file('profileBackground', ['class' => 'form-control']) }}
            </div>
        </div>
        {{ Form::button('編集', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}
</div>
@endsection