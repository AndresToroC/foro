<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Models\Category;
use App\Models\Tag;

class CategoryTagController extends Controller
{
    public function index(Request $request, Category $category)
    {
        $search = '';
        if ($request->has('search')) {
            $search = $request->search;
        }

        $tags = $category->tags()->searchAndPaginate();

        return view('admin.categories.tags.index', compact('category', 'tags', 'search'));
    }

    public function create(Category $category)
    {
        return view('admin.categories.tags.create', compact('category'));
    }

    public function store(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:25|unique:tags,name,NULL,id,category_id,'.$category->id
        ];
        
        $request->validate($rules);

        $tag = new Tag($request->all());
        $category->tags()->save($tag);

        $message = ['type' => 'success', 'text' => 'Etiqueta creada correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function show(Category $category, Tag $tag)
    {
        return view('admin.categories.tags.show', compact('category', 'tag'));
    }

    public function edit(Category $category, Tag $tag)
    {
        return view('admin.categories.tags.edit', compact('category', 'tag'));
    }

    public function update(Request $request, Category $category, Tag $tag)
    {
        $rules = [
            'name' => 'required|max:25|unique:tags,name,NULL,id,category_id,'.$category->id
        ];

        $request->validate($rules);

        $tag->update($request->all());

        $message = ['type' => 'success', 'text' => 'Etiqueta actualizada correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function destroy(Category $category, Tag $tag)
    {
        $tag->delete();

        $message = ['type' => 'success', 'text' => 'Etiqueta eliminada correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }
}
