<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $user_name }}</title>
</head>
<body>
    @can ('isLogin')
		{{ link_to_route('post.create', $title = "投稿する") }}
        @can ('edit-profile', $user_name)
            {{ link_to_route('profile.edit', $title = "プロフィール編集", $parameters = ['user_name' => auth()->user()->username]) }}
        @elsecan ('register-profile', $user_name)
            {{ link_to_route('profile.register', $title = "プロフィール登録", $parameters = ['user_name' => auth()->user()->username])  }}
        @endcan
        {{ link_to_route('user.logout', $title = "ログアウト") }}
    @else
		{{ link_to_route('user.login', $title = "ログイン") }}
	@endcan
    {{ link_to_route('post', $title = "一覧画面に戻る") }}
    <div>
        <h2>
            プロフィール
        </h2>
        @if (!is_null($profile))
            <h3>
                {{ $profile['user']['username'] }}
            </h3>
            <p>
                {{ $profile['profile'] }}
            </p>
        @endif
    </div>
    <hr>
    <div>
        @foreach ($posts as $post)
        <p>
            アカウント名: {{ link_to_route('profile.show', $title = $post->user->username, $parameters = [$post->user->username]) }}
        </p>
		<p>
            ユーザー名: {{ $post->user->display_name }}
        </p>
		<p>
            投稿内容: {{ $post->body }}
        </p>
		@if (!is_null($post->image))
                <img src="{{ asset(Storage::url($post->image)) }}">
		@endif
		@endforeach
    </div>
</body>
</html>
