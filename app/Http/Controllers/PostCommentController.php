<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Post;
use App\Models\Comment;

class PostCommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $rules = [
            'comment' => 'required'
        ];
        
        $request->validate($rules);

        $comment = new Comment($request->all());
        $post->comments()->save($comment);

        $message = ['type' => 'success', 'text' => 'Comentario agregado correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function edit(Post $post, Comment $comment)
    {
        return view('posts.comments.edit', compact('post', 'comment'));
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $rules = [
            'comment' => 'required'
        ];
        
        $request->validate($rules);

        $comment->update($request->all());

        $message = ['type' => 'success', 'text' => 'Comentario actualizaco correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->likes()->detach();
        $comment->delete();

        $message = ['type' => 'success', 'text' => 'Comentario eliminado correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }
}
