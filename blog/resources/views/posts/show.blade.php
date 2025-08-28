@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}</h1>
<p><strong>By:</strong> {{ $post->user->name ?? 'Anonymous' }}</p>

<div style="margin:15px 0; padding:10px; border:1px solid #ddd;">
    {!! nl2br(e($post->content)) !!}
</div>

{{-- Edit/Delete (skip auth check if no login system yet) --}}
<a href="{{ route('posts.edit', $post) }}">✏ Edit</a> |
<form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
    @csrf @method('DELETE')
    <button type="submit" onclick="return confirm('Delete this post?')">🗑 Delete</button>
</form>

<hr>
<h3>Comments</h3>

@foreach ($post->comments as $comment)
    <div style="margin-bottom:8px; padding:5px; border-bottom:1px solid #eee;">
        <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>: {{ $comment->content }}
    </div>
@endforeach

<form action="{{ route('comments.store', $post) }}" method="POST">
    @csrf
    <textarea name="content" placeholder="Write a comment..." rows="3" style="width:100%;" required></textarea><br>
    <button type="submit">Comment</button>
</form>

<p><a href="{{ route('posts.index') }}">⬅ Back to Posts</a></p>
@endsection
