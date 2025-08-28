@extends('layouts.app')

@section('title', 'Campus Blog')

@section('sidebar')
  <div class="card">
    <h3>Create Post</h3>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="text" name="title" placeholder="Post title" required>
      <textarea name="content" rows="4" placeholder="Write something..." required></textarea>
      <input type="file" name="image" accept="image/*">
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
        @if($post->author_name)
          <p style="margin:4px 0; color:#666; font-size: 13px;">By {{ $post->author_name }} @if($post->author_role) ({{ ucfirst($post->author_role) }}) @endif</p>
        @endif
        @if($post->image)
          <div>
            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 200px;">
          </div>
        @endif
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
