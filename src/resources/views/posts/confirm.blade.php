<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>確認画面</title>
</head>
<body>
	<p>この内容で投稿していいですか？<p>
	<form method="POST" action="{{ route('post.store') }}">
		@csrf
		作品説明: <input type="text" name="body" value="{{ $body }}" readonly>
		@error('body')
			<div>{{ $message }}</div>
		@enderror
		<br>
		<button type="submit" name="back" value="back">修正する</button>
		<button type="submit">登録</button>
	</form>
</body>
</html>