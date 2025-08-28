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
    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
      <textarea name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
      @if($post->image)
        <div>
          <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" style="max-width: 200px;">
        </div>
      @endif
      <input type="file" name="image" accept="image/*">
      <button type="submit">Update</button>
    </form>
  </div>
@endsection
