<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Helper\SearchPaginate;

class Tag extends Model
{
    use HasFactory, SearchPaginate;

    static $search_columns = ['name'];

    protected $fillable = [
        'category_id', 'name'
    ];

    public function posts() {
        return $this->belongsToMany(Post::class);
    }
}
