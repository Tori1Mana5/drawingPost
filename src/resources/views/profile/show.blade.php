<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $userName }}</title>
</head>
<body>
    @can ('isLogin')
		{{ link_to_route('post.store', $title = "投稿する") }}
        @can ('edit-profile', $userName)
            {{ link_to_route('profile.edit', $title = "プロフィール編集", $parameters = ['userName' => auth()->user()->username]) }}
        @elsecan ('register-profile', $userName)
            {{ link_to_route('profile.register', $title = "プロフィール登録", $parameters = ['userName' => auth()->user()->username])  }}
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
            <p>
                {{ $profile['user']['username'] }}
            </p>
            <h3>
                {{ $profile['user']['display_name'] }}
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
            ユーザー名: {{ link_to_route('profile.show', $title = $post->user->username, $parameters = [$post->user->username]) }}
        </p>
		<p>
            ニックネーム: {{ $post->user->display_name }}
        </p>
		<p>
            投稿内容: {{ $post->body }}
        </p>
        @can ('update-post', $post)
            <p>{{ link_to_route('post.edit', $title = "内容を編集", $parameters = [$post->id]) }}</p>
		@endcan
		@if (!is_null($post->image))
                <img src="{{ asset(Storage::url($post->image)) }}">
		@endif
		@endforeach
    </div>
</body>
</html>
