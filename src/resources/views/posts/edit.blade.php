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
        {{ Form::token() }}
        <p>作品説明: {{ Form::text('body[]', old('body.0', $post['body'])) }}</p>
        @isset ($post['image'])
            <p>現在の作品:</p>
            <p>変更しない場合このままの画像になります</p>
            <img src="{{ asset(Storage::url($post['image'])) }}">
        @endif
        <br>
        <p>作品: {{ Form::file('image') }}</p>
        {{ Form::button('投稿', ['type' => 'submit']) }}
        {{ Form::close() }}
	</div>
@endsection