@extends('layouts.app')

@section('title', 'プロフィール修正')

@section('content')
    <div>
    {{ link_to_route('post', '一覧画面に戻る') }}
{{ link_to_route('profile.show', $title = "プロフィールに戻る", $parameters = ['userName' => $userName]) }}
<br>
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    {{ Form::open(['route' => ['profile.edit.complete', $userName], 'files' => true]) }}
    <div class="form-row">
        <div class="form-group">
            {{ Form::label('text', 'プロフィール') }}
            {{ Form::textarea('text', old('text', $profile['profile']), ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('displayName', 'ニックネーム') }}
            {{ Form::text('displayName', old('displayName', $profile['user']['display_name']), ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            @isset ($profile['profile_icon'])
                現在のアイコン <br>
                <img src="{{ asset(Storage::url($profile['profile_icon'])) }}">
            @endisset
        </div>
        <div class="form-group">
            {{ Form::label('profileIconImage', '変更するアイコン画像') }}
            {{ Form::file('profileIconImage', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            @isset ($profile['profile_background'])
                現在の背景 <br>
                <img src="{{ asset(Storage::url($profile['profile_background'])) }}">
            @endisset
        </div>
        <div class="form-group">
            {{ Form::label('profileBackground', '変更する背景画像') }}
            {{ Form::file('profileBackground', ['class' => 'form-control']) }}
        </div>
        {{ Form::button('編集', ['type' => 'submit',  'class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}
@endsection