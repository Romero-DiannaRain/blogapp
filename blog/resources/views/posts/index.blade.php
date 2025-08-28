@extends('layouts.app')

@section('title', 'Campus Blog')

@section('sidebar')
  <div class="card">
    <h3>Create Post</h3>
    <form action="{{ route('posts.store') }}" method="POST">
      @csrf
      <input type="text" name="title" placeholder="Post title" required>
      <textarea name="content" rows="4" placeholder="Write something..." required></textarea>
      <button type="submit">Post</button>
    </form>
  </div>
@endsection

@section('content')
  <div class="search-box">
    <form action="{{ route('posts.index') }}" method="GET">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts by title...">
    </form>
  </div>

  <div id="feed">
    @forelse($posts as $post)
      <div class="post">
        <h3>{{ $post->title }}</h3>
        <p>{{ Str::limit($post->content, 150) }}</p>
        <a href="{{ route('posts.show', $post->id) }}" class="btn-small">Read More</a>
      </div>
    @empty
      <div class="post">
        <h3>No posts yet</h3>
        <p>Be the first to create a post!</p>
      </div>
    @endforelse
  </div>
@endsection
