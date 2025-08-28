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
        @if ($post->author_name)
            <p style="margin:4px 0; color:#666; font-size: 13px;">By {{ $post->author_name }} @if ($post->author_role)
                    ({{ ucfirst($post->author_role) }})
                @endif
            </p>
        @endif
        @if ($post->image)
            <div>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 400px;">
            </div>
        @endif
        <p>{{ $post->content }}</p>

        <div style="margin-top: 15px;">
            @php
                $canEdit =
                    (session('student_id') && $post->author_student_id === session('student_id')) ||
                    (session('faculty_id') && $post->author_faculty_id === session('faculty_id'));
                $canDelete = $canEdit || session()->has('faculty_id');
            @endphp
            @if ($canEdit)
                <a href="{{ route('posts.edit', $post->id) }}" class="btn-small">Edit</a>
            @endif
            @if ($canDelete)
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
        <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
            @csrf
            <textarea name="content" rows="3" placeholder="Write a comment..." required></textarea>
            <button type="submit">Add Comment</button>
        </form>

        {{-- Show Comments --}}
        <div style="margin-top:15px;">
            @forelse($post->comments as $comment)
                <div class="post" style="padding:10px;">
                    <p>
                        <strong>
                            {{ $comment->author_name ?? ($comment->user ? $comment->user->name : 'Anonymous') }}:
                        </strong>
                    </p>
                    <p>{{ $comment->content }}</p>
                </div>
            @empty
                <p>No comments yet. Be the first!</p>
            @endforelse
        </div>
    </div>
@endsection
