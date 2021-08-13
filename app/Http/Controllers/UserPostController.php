<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

use App\Notifications\PostNotification;
use App\Events\PostEvent;

class UserPostController extends Controller
{
    public function index(Request $request, User $user)
    {
        $post_filter = isset($request->post) ? $request->post : '';
        $categoryId_filter = isset($request->category_id) ? $request->category_id : '';
        $tagId_filter = isset($request->tag_id) ? $request->tag_id : '';
        
        $posts = $user->posts()->with(['category', 'post_tag'])
            ->where('name', 'LIKE', '%'.$post_filter.'%')
            ->where(function($q) use ($categoryId_filter, $tagId_filter) {
                if ($categoryId_filter) {
                    if ($tagId_filter) {
                        $q->where('category_id', $categoryId_filter)
                            ->whereHas('post_tag', function($query) use ($tagId_filter) {
                                if ($tagId_filter) {
                                    $query->whereId($tagId_filter);
                                }
                            });
                    } else {
                        $q->where('category_id', $categoryId_filter);
                    }
                }
            })
            ->searchAndPaginate();
            
        $categories = Category::pluck('name', 'id');
        
        return view('users.posts.index', compact('user', 'posts', 'categories', 'post_filter', 
            'categoryId_filter', 'tagId_filter'));
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
        
        // Se le manda notificacion al admin de los post creados
        event(new PostEvent($post));

        if ($request->has('tag_ids')) {
            $post->post_tag()->attach($request->tag_ids);
        }

        $message = ['type' => 'success', 'text' => 'Foro creado correctamente'];
        Session::flash('message', $message);

        return redirect()->back()->withInput();
    }

    public function show(User $user, Post $post)
    {
        return view('users.posts.show', compact('user', 'post'));
    }

    public function edit(User $user, Post $post)
    {
        $categories = Category::pluck('name', 'id');
        $post->load('post_tag');

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
        
        // Se eliminan las etiquetas
        $post->post_tag()->detach();

        $post->update($request->all());

        // Se agregan las nuevas etiquetas
        $post->post_tag()->attach($request->tag_ids);

        $message = ['type' => 'success', 'text' => 'Foro actualizado correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function destroy(User $user, Post $post)
    {
        $post->post_tag()->detach();
        $post->delete();

        $message = ['type' => 'success', 'text' => 'Foro eliminado correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }
}
