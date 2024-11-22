@extends('layouts.app')

@section('title', $userName)

@section('content')

<div class="container" id="margin_top">
    @if (!is_null($profile['profile_background']))
        <img src="{{ asset(Storage::url($profile['profile_background'])) }}" class="img-fluid">
    @endif
    <h2>
        プロフィール
    </h2>
    <div class="row justify-content-center">
        <div class="col-4">
            @if (!is_null($profile))
                <p>
                    @ {{ $profile['user']['username'] }}
                </p>
                @if (!is_null($profile['profile_icon']))
                    <img src="{{ asset(Storage::url($profile['profile_icon'])) }}">
                @else
                    <div></div>
                @endif
                <div class="">
                    <h3>
                        {{ $profile['user']['display_name'] }}
                    </h3>
                </div>
                @if (Auth::user()->username !== $profile['user']['username'])
                    <div class="">
                        <button>フォロー</button>
                    </div>
                @endif
                <p>
                    {{ $profile['profile'] }}
                </p>
            @endif
            @can ('edit-profile', $userName)
                {{ link_to_route('profile.edit', $title = "プロフィール編集", $parameters = ['userName' => auth()->user()->username]) }}
            @elsecan ('register-profile', $userName)
                {{ link_to_route('profile.register', $title = "プロフィール登録", $parameters = ['userName' => auth()->user()->username])  }}
            @endcan
        </div>
        <div class="col-8">
            @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ $post->user->display_name }}
                    </h3>
                    <p class="card-subtitle">
                        {{ link_to_route('profile.show', $title = $post->user->username, $parameters = [$post->user->username]) }}
                    </p>
                    <p class="card-text">
                        {{ $post->body }}
                    </p>
                    @can ('update-post', $post)
                        <p>{{ link_to_route('post.edit', $title = "内容を編集", $parameters = [$post->id], $attributes = ['clss' => 'card-link']) }}</p>
                    @endcan
                    @if (!is_null($post->image))
                            <img src="{{ asset(Storage::url($post->image)) }}" class="img-fluid">
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection