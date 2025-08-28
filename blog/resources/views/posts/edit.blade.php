@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>

<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf @method('PUT')
    <p>
        <input type="text" name="title" value="{{ $post->title }}" style="width:100%;" required>
    </p>
    <p>
        <textarea name="content" rows="6" style="width:100%;" required>{{ $post->content }}</textarea>
    </p>
    <button type="submit">Update</button>
</form>

<p><a href="{{ route('posts.show', $post) }}">⬅ Back to Post</a></p>
@endsection
