@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
	<div>
		@foreach ($posts as $post)
			<p>ユーザー名: {{ link_to_route('profile.show', $title = $post->user->username, $parameters = [$post->user->username]) }}</p>
			<p>ニックネーム: {{ $post->user->display_name }}</p>
			<p>投稿内容: {{ $post->body }}</p>
				@can ('update-post', $post)
					<p>{{ link_to_route('post.edit', $title = "内容を編集", $parameters = [$post->id]) }}</p>
				@endcan
			<br>
			@if (!is_null($post->image))
				<img src="{{ asset(Storage::url($post->image)) }}">
			@endif
		@endforeach
	</div>
@endsection