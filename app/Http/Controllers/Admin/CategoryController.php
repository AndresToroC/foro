<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = '';
        if ($request->has('search')) {
            $search = $request->search;
        }

        $categories = Category::searchAndPaginate();
        
        return view('admin.categories.index', compact('categories', 'search'));
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

        return redirect()->back();
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

        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();

            $message = ['type' => 'success', 'text' => 'Categoría eliminada correctamente'];
        } catch (\Throwable $th) {
            $message = ['type' => 'danger', 'text' => 'Esta categoría no se puede eliminar ya que esta en uso'];
        }

        Session::flash('message', $message);

        return redirect()->back();
    }
}
