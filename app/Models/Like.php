<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function posts() {
        return $this->morphedByMany(Post::class, 'model', 'model_has_likes');
    }

    public function comments() {
        return $this->morphedByMany(Comment::class, 'model', 'model_has_likes');
    }
}
