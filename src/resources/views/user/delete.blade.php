@extends('layouts.app')

@section('title', 'アカウント削除確認')

@section('content')
    <div id="margin_top">
        <h2>アカウント削除確認</h2>
        <p>
            本当に削除しますか？
            {{ Form::open(['route' => 'user.delete.complete']) }}
                {{ Form::hidden('userId', Auth::id()) }}
                {{ Form::button('アカウントを削除する', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </p>
    </div>
    {{ link_to_route('user.login', $title = 'TOPへ') }}