<html>
	<head>
		<meta charset="utf-8">
		<title>ホーム</title>
	</head>
	<body>
		<h2>投稿一覧</h2>
		@if (session('success'))
			<div>
				{{ session('success') }}
			</div>
		@endif
		@can ('isLogin')
			{{ link_to_route('post.create', $title = "投稿する") }}
			{{ link_to_route('user.logout', $title = "ログアウト") }}
            {{ link_to_route('profile.show', $title = "プロフィール", $parameters = [auth()->user()->username])  }}
		@else
			{{ link_to_route('user.login', $title = "ログイン") }}
		@endcan
		<div>
			@foreach ($posts as $post)
			<p>アカウント名: {{ link_to_route('profile.show', $title = $post->user->username, $parameters = [$post->user->username]) }}</p>
			<p>ユーザー名: {{ $post->user->display_name }}</p>
			<p>投稿内容: {{ $post->body }}</p>
			@if (!is_null($post->image))
				<img src="{{ asset(Storage::url($post->image)) }}">
			@endif
			@endforeach
		</div>
	</body>
</html>