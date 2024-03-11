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
			<p>作品説明: {{ Form::text('body[]', old('body.0')) }}</p>
			<p>作品: {{ Form::file('image') }}</p>
			{{ Form::button('投稿', ['type' => 'submit']) }}
		{{ Form::close() }}
	</div>
@endsection