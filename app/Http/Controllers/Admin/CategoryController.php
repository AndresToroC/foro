<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255|unique:categories'
        ];

        $request->validate($rules);

        Category::create($request->all());

        $message = ['type' => 'success', 'text' => 'Categoría creada correctamente'];
        Session::flash('message', $message);

        return redirect()->route('admin.categories.create');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255|unique:categories,id,'.$category->id
        ];

        $request->validate($rules);

        $category->update($request->all());

        $message = ['type' => 'success', 'text' => 'Categoría actualizada correctamente'];
        Session::flash('message', $message);

        return redirect()->route('admin.categories.edit', compact('category'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        $message = ['type' => 'success', 'text' => 'Categoría eliminada correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }
}
