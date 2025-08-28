<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $authorName = null;
        if (Auth::check()) {
            $authorName = Auth::user()->name;
        } elseif (session()->has('student_name')) {
            $authorName = session('student_name');
        } elseif (session()->has('faculty_name')) {
            $authorName = session('faculty_name');
        }

        Comment::create([
            'content'    => $request->content,
            'user_id'    => Auth::id(),
            'post_id'    => $post->id,
            'author_name' => $authorName,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added!');
    }
}
