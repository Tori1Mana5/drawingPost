<nav class = "navbar navbar-expand-lg bg-info fixed-top py-6 px-4">
    {{ link_to_route('post', $title = "イラストコミュニケーションサイト - めちゃわかったー", $parameters = [], $attributes = ['class' => 'navbar-brand']) }}
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @can ('isLogin')
                <li class="nav-item active">
                    {{ link_to_route('post.store', $title = "投稿する", $parameters = [], $attributes = ['class' => 'nav-link']) }}
                </li>
                <li class="nav-item active">
                    {{ link_to_route('user.logout', $title = "ログアウト", $parameters = [], $attributes = ['class' => 'nav-link']) }}
                </li>
                <li class="nav-item active">
                    {{ link_to_route('profile.show', $title = "プロフィール", $parameters = [auth()->user()->username], $attributes = ['class' => 'nav-link']) }}
                </li>
            @else
                <li class="nav-item">
                    {{ link_to_route('user.login', $title = "ログイン", $parameters = [], $attributes = ['class' => 'nav-link']) }}
                </li>
            @endcan
        </ul>
    </div>
</nav>