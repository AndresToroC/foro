<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Helper\SearchPaginate;

class Post extends Model
{
    use HasFactory, SoftDeletes, SearchPaginate;

    static $search_columns = ['name'];

    protected $fillable = [
        'category_id', 'user_id', 'name', 'description', 'content', 'is_visible'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function post_tag() {
        return $this->belongsToMany(Tag::class);
    }
}
