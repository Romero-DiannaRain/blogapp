@extends('layouts.app')

@section('content')
<h1>Create Post</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <p>
        <input type="text" name="title" placeholder="Title" style="width:100%;" required>
    </p>
    <p>
        <textarea name="content" placeholder="Write your post..." rows="6" style="width:100%;" required></textarea>
    </p>
    <button type="submit">Publish</button>
</form>

<p><a href="{{ route('posts.index') }}">⬅ Back to Posts</a></p>
@endsection
