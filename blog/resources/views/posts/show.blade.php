@extends('layouts.app')

@section('title', $post->title)

@section('sidebar')
  <div class="card">
    <h3>Back to Posts</h3>
    <a href="{{ route('posts.index') }}" class="btn-small">← All Posts</a>
  </div>
@endsection

@section('content')
  <div class="post">
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>

    <div style="margin-top: 15px;">
      @if($post->user_id === Auth::id())
        <a href="{{ route('posts.edit', $post->id) }}" class="btn-small">Edit</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-small" onclick="return confirm('Delete this post?')">Delete</button>
        </form>
      @endif
    </div>
  </div>

  {{-- Comment Section --}}
  <div class="card" style="margin-top:20px;">
    <h3>Comments</h3>

    {{-- Add Comment --}}
    <form action="{{ route('comments.store', $post->id) }}" method="POST">
      @csrf
      <textarea name="content" rows="3" placeholder="Write a comment..." required></textarea>
      <button type="submit">Add Comment</button>
    </form>

    {{-- Show Comments --}}
    <div style="margin-top:15px;">
      @forelse($post->comments as $comment)
        <div class="post" style="padding:10px;">
          <p><strong>{{ $comment->user->name ?? 'Anonymous' }}:</strong></p>
          <p>{{ $comment->content }}</p>
        </div>
      @empty
        <p>No comments yet. Be the first!</p>
      @endforelse
    </div>
  </div>
@endsection
