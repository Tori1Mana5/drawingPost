@extends('layouts.app')

@section('title', '投稿編集')

@section('content')
	<div>
    {{ link_to_route('post', $title = "一覧画面に戻る") }}
    <br>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{ Form::open(['route' => ['post.edit.complete', $post['id']], 'files' => true]) }}
        <div class="form-row">
            <div class="form-group">
                {{ Form::label('text', '作品説明') }}
                {{ Form::textarea('text', old('text', $post['body']), ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
            @isset ($post['image'])
                <p>
                    現在の作品
                    <br>
                    変更しない場合このままの画像になります
                </p>
                <img src="{{ asset(Storage::url($post['image'])) }}">
            @endif
            <br>
                {{ Form::label('image', '作品') }}
                {{ Form::file('image', ['class' => 'form-control']) }}
            </div>
            {{ Form::button('編集', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
@endsection