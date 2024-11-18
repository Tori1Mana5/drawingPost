@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
<div class="container" id="margin_top">
	<div class="row">
		@foreach ($posts as $post)
		<div class="card mb-4">
			<div class="card-body">
				<h3 class="card-title">
					{{ $post->user->display_name }}
				</h3>
				<p class="card-subtitle">
					{{ link_to_route('profile.show', $title = $post->user->username, $parameters = [$post->user->username]) }}
				</p>
				<p class="card-text">
					{{ $post->body }}
				</p>
				@if (!is_null($post->image))
				<div>
					<img src="{{ asset(Storage::url($post->image)) }}" class="img-fluid">
				</div>
				@endif
				{{ link_to_route('post.show', $title = "", $parameters = [$post->id], $attributes = ['id' => 'linkbox-wrap']) }}
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection