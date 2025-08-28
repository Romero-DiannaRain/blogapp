@extends('layouts.app')

@section('title', 'Create Post')

@section('sidebar')
  <div class="card">
    <h3>Navigation</h3>
    <a href="{{ route('posts.index') }}" class="btn-small">← Back to Posts</a>
  </div>
@endsection

@section('content')
  <div class="card">
    <h3>Create a New Post</h3>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="text" name="title" placeholder="Post title" required>
      <textarea name="content" rows="5" placeholder="Write something..." required></textarea>
      <input type="file" name="image" accept="image/*">
      <button type="submit">Publish</button>
    </form>
  </div>
@endsection
