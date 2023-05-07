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
		@if (Auth::check())
			{{ link_to_route('post.create', $title = "投稿する") }}
			{{ link_to_route('user.logout', $title = "ログアウト") }}
		@endif
		@if (!Auth::check())
			{{ link_to_route('user.login', $title = "ログイン") }}
		@endif
		<div>
			@foreach($posts as $post)
			<p>アカウント名: {{ $post->user->username }}</p>
			<p>ユーザー名: {{ $post->user->display_name }}</p>
			<p>投稿内容: {{ $post->body }}</p>
			@endforeach
		</div>
	</body>
</html>