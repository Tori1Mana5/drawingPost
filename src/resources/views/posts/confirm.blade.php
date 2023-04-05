<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>確認画面</title>
</head>
<body>
	<p>この内容で投稿していいですか？<p>
	作品説明: {{ old('body.0') }}
	<br>
	{{ link_to_route('post.create', $title = "修正する") }}
	{{ link_to_route('post.complete', $title = "登録") }}
</body>
</html>