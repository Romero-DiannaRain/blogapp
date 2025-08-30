<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $posts = Post::when($search, function ($query, $search) {
            $query->where('title', 'like', "%$search%");
        })
            ->latest()
            ->get();

        return view('posts.index', compact('posts', 'search'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $authorRole = session()->has('faculty_id') ? 'faculty' : (session()->has('student_id') ? 'student' : null);
        $authorName = null;
        if ($authorRole === 'faculty') {
            $authorName = session('faculty_name');
        } elseif ($authorRole === 'student') {
            $authorName = session('student_name');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Post::create([
            'title'              => $request->title,
            'content'            => $request->content,
            'user_id'            => null,
            'author_student_id'  => session('student_id'),
            'author_faculty_id'  => session('faculty_id'),
            'author_name'        => $authorName,
            'author_role'        => $authorRole,
            'image'              => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorizePostAction($post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorizePostAction($post);
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'content');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $post->update($data);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $this->authorizePostAction($post, allowFacultyDelete: true);

        // Delete image file if exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }

    private function authorizePostAction(Post $post, bool $allowFacultyDelete = false): void
    {
        $currentStudentId = session('student_id');
        $currentFacultyId = session('faculty_id');

        $isOwner = ($currentStudentId && $post->author_student_id === $currentStudentId)
            || ($currentFacultyId && $post->author_faculty_id === $currentFacultyId);

        $isFaculty = (bool) $currentFacultyId;

        if ($allowFacultyDelete) {
            if (!($isOwner || $isFaculty)) {
                abort(403, 'You are not authorized to perform this action.');
            }
            return;
        }

        if (!$isOwner) {
            abort(403, 'You are not authorized to perform this action.');
        }
    }
}
//deploy