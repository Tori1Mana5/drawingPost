<html>
	<head>
		<meta charset="utf-8">
		<title>ホーム</title>
	</head>
	<body>
		<h2>投稿一覧</h2>
		@if (session('message'))
			<div>
				{{ session('message') }}
			</div>
		@endif
		<a href="{{ route('post.create') }}">投稿する</a>
		<div>
			@foreach($posts as $post)
			<p>アカウント名: {{ $post->id }}</p>
			<p>ユーザー名: {{ $post->username }}</p>
			<p>投稿内容: {{ $post->body }}</p>
			@endforeach
		</div>
	</body>
</html>