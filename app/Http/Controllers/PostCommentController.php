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

        $message = ['type' => 'success', 'text' => 'Comentario agregado correctament'];
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function edit(Post $post, Comment $comment)
    {
        //
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        //
    }

    public function destroy(Post $post, Comment $comment)
    {
        //
    }
}
