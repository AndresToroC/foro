<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;

use Session;

class LikeController extends Controller
{
    public function store(Request $request, User $user) {
        $model = $request->model;
        $model_id = $request->model_id;
        $type = $request->type;
        
        $like = Like::whereName($type)->first();
        
        if ($like) {
            if ($model == 'post') {
                $post = Post::whereId($model_id)->first();

                DB::table('model_has_likes')->whereModelIdAndModelTypeAndUserId($post->id, 'App\Models\Post', $user->id)
                    ->delete();
                    
                $post->likes()->save($like, ['user_id' => $user->id]);
            } 
            
            if ($model == 'comment') {
                $comment = Comment::whereId($model_id)->first();

                DB::table('model_has_likes')->whereModelIdAndModelTypeAndUserId($comment->id, 'App\Models\Comment', $user->id)
                    ->delete();
                
                $comment->likes()->save($like, ['user_id' => $user->id]);    
            }

            $message = ['type' => 'success', 'text' => 'Se agrego con exito'];
        } else {
            $message = ['type' => 'danger', 'text' => 'Ah ocurrido un error'];
        }
        
        Session::flash('message', $message);

        return redirect()->back();
    }
}
