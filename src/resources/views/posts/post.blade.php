<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>投稿画面</title>
</head>
<body>
	<form method="POST" action="{{ route('post.store') }}">
		@csrf
		作品説明: <input type="text" name="body">
		<input type="submit" value="登録">
	</form>
</body>
</html>