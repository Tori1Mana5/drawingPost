<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>投稿画面</title>
</head>
<body>
	{{ link_to_route('post', $title = "一覧画面に戻る") }}
	<br>
	@error('body.0')
			{{ $message }}
	@enderror
	{{ Form::open(['route' => 'post.complete', 'files' => true]) }}
		{{ Form::token() }}
		<p>作品説明: {{ Form::text('body[]', old('body.0')) }}</p>
		<p>作品: {{ Form::file('image') }}</p>
		{{ Form::button('投稿', ['type' => 'submit']) }}
	{{ Form::close() }}
</body>
</html>