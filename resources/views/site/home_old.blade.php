@extends('site.master')
@section('content')
    <h2>Posts</h2>
    <ul>
        @foreach($posts as $post)
            <a href="/post/{{ $post->slug }}">
                <li>{{ $post->title }} - <small>{{ $post->user->firstName }} {{ $post->user->lastName }}</small></li>
            </a>
        @endforeach
    </ul>
@stop