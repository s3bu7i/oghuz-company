<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|max:255',
            'excerpt'      => 'nullable|max:500',
            'content'      => 'required',
            'category'     => 'required|max:100',
            'author'       => 'nullable|max:100',
            'is_published' => 'boolean',
            'is_featured'  => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['is_featured']  = $request->boolean('is_featured');
        $data['author']       = $data['author'] ?? 'OghuzTech';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Post uğurla yaradıldı!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'        => 'required|max:255',
            'excerpt'      => 'nullable|max:500',
            'content'      => 'required',
            'category'     => 'required|max:100',
            'author'       => 'nullable|max:100',
            'is_published' => 'boolean',
            'is_featured'  => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['is_featured']  = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'Post uğurla yeniləndi!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post silindi!');
    }
}
