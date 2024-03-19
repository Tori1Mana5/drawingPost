@extends('layouts.app')

@section('title', '投稿編集')

@section('content')
<div class="container">
<h2>投稿編集</h2>
    {{ link_to_route('post', $title = "一覧画面に戻る") }}
	<div class="container card">
        {{ Form::open(['route' => ['post.edit.complete', $post['id']], 'files' => true]) }}
        <div class="mt-3">
            <div class="col-sm-6">
                <div class="form-floating">
                    {{ Form::textarea('text', old('text', $post['body']), ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
                    {{ Form::label('text', '作品説明', ['label' => 'floatingInput']) }}
                </div>
                <div>
                    @if ($errors->has('text'))
                            {{ $errors->first('text') }}
                    @endif
                </div>
            </div>
            <div class="my-3">
                <div class="form-floating">
                    @isset ($post['image'])
                    <h3>現在の作品</h3>
                    変更しない場合このままの画像になります
                    <br>
                    <img src="{{ asset(Storage::url($post['image'])) }}">
                    @endif
                </div>
                <div class="col-sm-6 my-3">
                    <div class="input-group">
                        {{ Form::label('inputGroupFile01', 'upload', ['class' => 'input-group-text']) }}
                        {{ Form::file('image', ['class' => 'form-control', 'id' => 'inputGroupFile01']) }}
                    </div>
                    <div>
                    @if ($errors->has('image'))
                        {{ $errors->first('image') }}
                    @endif
                </div>
                </div>
            </div>
        </div>
        {{ Form::button('編集', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
</div>
@endsection