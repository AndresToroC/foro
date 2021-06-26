<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class TagController extends Controller
{
    public function index(Category $category) {
        $category->load('tags');
        
        $tags = [];
        if ($category->has('tags')) {
            $tags = $category->tags;
        }

        return response()->json([
            'tags' => $tags
        ], 206);
    }
}
