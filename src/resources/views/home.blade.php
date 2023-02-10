<html>
	<head>
		<meta charset="utf-8">
		<title>ホーム</title>
	</head>
	<body>
		<h1>ホーム画面</h1>
		<h2>フォーム</h2>
		<form action="{{ url('/home') }}" enctype='multipart/form-data' method="post">
			{{ csrf_field() }}
			<div>
				描いたものの紹介:<br>
				<input type="text" name="text">
				<br>
				描いたもの:<br>
				<input type="file" name="file" accept="image/png, image/jpeg, application/pdf">
			</div>
			<div>
				<input type="submit" value="投稿！">
			</div>
		</form>
		<br>

		<h2>投稿一覧</h2>
		@isset($text)
		<div>
			<p>{{ $text }}</p>
		</div>
		@endisset

	</body>
</html>