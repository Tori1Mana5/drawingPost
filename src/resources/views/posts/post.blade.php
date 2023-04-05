<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>投稿画面</title>
</head>
<body>
作品説明: 
	{{ Form::open(['route' => 'post.confirm']) }}
		{{ Form::token() }}
		{{ Form::text('body[]', old('body.0')) }}
		@error('body.0')
			<div>{{ $message }}</div>
		@enderror
		{{ Form::button('確認する', ['type' => 'submit']) }}
	{{ Form::close() }}
	{{ link_to_route('post', $title = "一覧画面に戻る") }}
</body>
</html>