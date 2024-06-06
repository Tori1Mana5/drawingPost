@extends('layouts.app')

@section('title', 'プロフィール修正')

@section('content')
<div class="container" id="margin_top">
    <h2>プロフィール修正</h2>
    {{ link_to_route('post', '一覧画面に戻る') }}
    {{ link_to_route('profile.show', $title = "プロフィールに戻る", $parameters = ['userName' => $userName]) }}
    {{ link_to_route('user.delete.confirm', $title = "アカウントを削除") }}
    <div class="container card">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{ Form::open(['route' => ['profile.edit.complete', $userName], 'files' => true]) }}
        <div class="my-3">
            <div class="col-sm-6">
                <div class="form-floating">
                    {{ Form::textarea('text', old('text', $profile['profile']), ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                    {{ Form::label('text', 'プロフィール', ['label' => 'floatingInput']) }}
                </div>
            </div>
            <div class="col-sm-6 mt-3">
                <div class="form-floating">
                    {{ Form::text('displayName', old('displayName', $profile['user']['display_name']), ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                    {{ Form::label('displayName', 'ニックネーム', ['label' => 'floatingInput']) }}
                </div>
            </div>
            <div class="col-sm-6 mt-3">
                <div class="form-floating">
                    @isset ($profile['profile_icon'])
                        <h3>現在のアイコン</h3>
                        <img src="{{ asset(Storage::url($profile['profile_icon'])) }}">
                    @endisset
                </div>
            </div>
            <div class="col-sm-6 mt-3">
                <div class="input-group">
                    {{ Form::label('profileIconImage', 'upload', ['class' => 'input-group-text']) }}
                    {{ Form::file('profileIconImage', ['class' => 'form-control', 'id' => 'profileIconImage']) }}
                </div>
            </div>
            <div class="col-sm-6 mt-3">
                <div class="form-floating">
                    @isset ($profile['profile_background'])
                        <h3>現在の背景</h3>
                        <img src="{{ asset(Storage::url($profile['profile_background'])) }}">
                    @endisset
                </div>
            </div>
            <div class="col-sm-6 mt-3">
                <h3>背景画像</h3>
                <div class="input-group">
                    {{ Form::label('profileBackground', 'upload', ['class' => 'input-group-text']) }}
                    {{ Form::file('profileBackground', ['class' => 'form-control', 'id' => 'profileBackground']) }}
                </div>
            </div>
        </div>
            {{ Form::button('編集', ['type' => 'submit',  'class' => 'btn btn-primary']) }}
            {{ Form::close() }}
    </div>
</div>
@endsection