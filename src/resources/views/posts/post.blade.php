@extends('layouts.app')

@section('title', 'ホーム')

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
		{{ Form::open(['route' => 'post.store.complete', 'files' => true]) }}
		<div class="form-row">
			<div class="form-group">
				{{ Form::label('text', '作品説明') }}
				{{ Form::textarea('text', old('text'), ['class' => 'form-control']) }}
			</div>
			<div class="form-group">
				{{ Form::label('image', '作品') }}
				{{ Form::file('image', ['class' => 'form-control']) }}
			</div>
			{{ Form::button('投稿', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
		</div>
		{{ Form::close() }}
	</div>
@endsection