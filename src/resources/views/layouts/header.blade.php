<div>
    <h1>{{ link_to_route('post', $title = "イラストコミュニケーションサイト - めちゃわかったー")}}</h1>
    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
	@endif
    
    {{ link_to_route('user.register', $title = "アカウント登録") }}
    @can ('isLogin')
        {{ link_to_route('post.store', $title = "投稿する") }}
        {{ link_to_route('user.logout', $title = "ログアウト") }}
        {{ link_to_route('profile.show', $title = "プロフィール", $parameters = [auth()->user()->username])  }}
    @else
        {{ link_to_route('user.login', $title = "ログイン") }}
    @endcan
</div>