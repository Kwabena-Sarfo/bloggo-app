<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $request->user()->posts()->create($data);

        return redirect()->route('posts.index')->with('success', 'Post published.');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted.');
    }
}