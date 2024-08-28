@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
<div class="container" id="margin_top">
	@foreach ($posts as $post)
	<div class="container card mb-4 shadow-sm h-md-250 linkbox">
		<p>ユーザーID:{{ link_to_route('profile.show', $title = $post->user->username, $parameters = [$post->user->username], $attributes = ['id' => 'linkbox-link']) }}</p>
		{{ link_to_route('post.show', $title = "", $parameters = [$post->id], $attributes = ['id' => 'linkbox-wrap']) }}
		<p>ニックネーム: {{ $post->user->display_name }}</p>
		<p>投稿内容: {{ $post->body }}</p>
		<br>
		@if (!is_null($post->image))
		<div>
			<img src="{{ asset(Storage::url($post->image)) }}" class="img-fluid">
		</div>
		@endif
	</div>
	@endforeach
</div>
@endsection