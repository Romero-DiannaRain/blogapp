@extends('layouts.app')

@section('content')
<h1>Blog Posts</h1>

<form method="GET" action="{{ route('posts.index') }}">
    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by username">
    <button type="submit">Search</button>
</form>

<p><a href="{{ route('posts.create') }}">➕ Create New Post</a></p>

@foreach ($posts as $post)
    <div style="border:1px solid #ddd; margin:10px 0; padding:10px;">
        <h3>
            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
        </h3>
        <p><em>By: {{ $post->user->name ?? 'Anonymous' }}</em></p>
    </div>
@endforeach
@endsection
