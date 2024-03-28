@extends('layouts.app')

@section('title', '投稿画面')

@section('content')
<div class="container" id="margin_top">
<h2>投稿</h2>
	{{ link_to_route('post', $title = "一覧画面に戻る") }}
	<div class="container card">
		{{ Form::open(['route' => 'post.store.complete', 'files' => true]) }}
		<div class="col-sm-6">
			<div class="form-floating mt-3">
				{{ Form::textarea('text', old('text'), ['class' => 'form-control', 'id' => 'floatingInput', 'placeholder' => '']) }}
				{{ Form::label('text', '作品説明', ['label' => 'floatingInput']) }}
			</div>
			<div>
				@if ($errors->has('text'))
					{{ $errors->first('text') }}
				@endif
			</div>
		</div>
		<div class="col-sm-6 my-3">
			<h3>作品画像</h3>
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
		{{ Form::button('投稿', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
		{{ Form::close() }}
	</div>
</div>
@endsection