@extends('layouts.app')

@section('title', 'Edit Post')

@section('sidebar')
  <div class="card">
    <h3>Navigation</h3>
    <a href="{{ route('posts.index') }}" class="btn-small">← Back to Posts</a>
  </div>
@endsection

@section('content')
  <div class="card">
    <h3>Edit Post</h3>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
      @csrf
      @method('PUT')
      <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
      <textarea name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
      <button type="submit">Update</button>
    </form>
  </div>
@endsection
