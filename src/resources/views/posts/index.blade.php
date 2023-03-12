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
		{{ link_to_route('post.create', $title = "投稿する") }}
		<div>
			@foreach($posts as $post)
			<p>アカウント名: {{ $post->display_name }}</p>
			<p>ユーザー名: {{ $post->username }}</p>
			<p>投稿内容: {{ $post->body }}</p>
			@endforeach
		</div>
	</body>
</html>