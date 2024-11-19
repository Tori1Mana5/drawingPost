@extends('layouts.app')

@section('title', $posts->user->username . 'さんの投稿 - ' . $posts->body)

@section('content')
<div class="container card" id="margin_top">
    <p>ユーザーID: {{ link_to_route('profile.show', $title = $posts->user->username, $parameters = [$posts->user->username]) }}</p>
    <p>ニックネーム: {{ $posts->user->display_name }}</p>
    <p>投稿内容: {{ $posts->body }}</p>
        @can ('update-post', $posts)
            <p>{{ link_to_route('post.edit', $title = "内容を編集", $parameters = [$posts->id]) }}</p>
        @endcan
    <br>
    @if (!is_null($posts->image))
    <diV>
        <img src="{{ asset(Storage::url($posts->image)) }}" class="img-fluid">
    </diV>
    @endif
</div>
@endsection