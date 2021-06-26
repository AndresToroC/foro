<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

class UserPostController extends Controller
{
    public function index(Request $request, User $user)
    {
        $search = '';
        if ($request->has('search')) {
            $search = $request->search;
        }

        $posts = $user->posts()->with('category')->searchAndPaginate();
        
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        
        return view('users.posts.index', compact('user', 'posts', 'search', 'categories', 'tags'));
    }

    public function create(User $user)
    {
        $categories = Category::pluck('name', 'id');

        return view('users.posts.create', compact('user', 'categories'));
    }

    public function store(Request $request, User $user)
    {
        $rules = [
            'category_id' => 'required',
            'name' => 'required|max:100',
            'content' => 'required'
        ];
        
        $request->validate($rules);
        
        if (!$request->has('is_visible')) {
            $request['is_visible'] = 0;
        }
        
        $post = new Post($request->all());
        $user->posts()->save($post);

        if ($request->has('tag_ids')) {
            $post->post_tag()->attach($request->tag_ids);
        }

        $message = ['type' => 'success', 'text' => 'Foro creado correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function show(User $user, Post $post)
    {
        return view('users.posts.show', compact('user', 'post'));
    }

    public function edit(User $user, Post $post)
    {
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');

        return view('users.posts.edit', compact('user', 'post', 'categories'));
    }

    public function update(Request $request, User $user, Post $post)
    {
        $rules = [
            'category_id' => 'required',
            'name' => 'required|max:100',
            'content' => 'required'
        ];

        $request->validate($rules);

        if (!$request->has('is_visible')) {
            $request['is_visible'] = 0;
        }
        
        $post->update($request->all());

        $message = ['type' => 'success', 'text' => 'Foro actualizado correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function destroy(User $user, Post $post)
    {
        $post->delete();

        $message = ['type' => 'success', 'text' => 'Foro eliminado correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }
}
