<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>投稿画面</title>
</head>
<body>
	<form method="POST" action="{{ route('post.confirm') }}">
		@csrf
		作品説明: <input type="text" name="body" value="{{ old('body') }}">
		@error('body')
			<div>{{ $message }}</div>
		@enderror
		<button type="submit">確認する</button>
	</form>
	<a href="{{ route('post') }}">一覧画面に戻る</a>
</body>
</html>