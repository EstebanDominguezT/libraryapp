<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required | string | max:255',
            'active' => 'required | boolean'
        ]);

        if ($validator->fails()) {
            return view('categories.create')->with('errors', $validator->errors());
        }

        $category = new Category();
        $category->description = $request->description;
        $category->active = true;
        
        if (!$category->save()) {
            return view('categories.create')->with('errors', 'Category not saved!');
        }
        
        return redirect('/categories')->with('success', 'Category saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $categories = category::find($category->id);
        if (!$categories) {
            return redirect('/categories')->with('errors', 'Category not found!');
        }

        return view('categories.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $category = category::find($category->id);
        if (!$category) {
            return redirect('/categories')->with('errors', 'Category not found!');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required | string | max:255',
            'active' => 'required | boolean'
        ]);

        if ($validator->fails()) {
            return view('categories.edit',compact('category'))->with('errors', $validator->errors());
        }

        $categories = Category::find($category->id);
        if (!$categories) {
            return redirect('categories.edit',compact('category'))->with('errors', 'Category not found!');
        }

        $categories->description = $request->description;
        $categories->active = $request->active;
        
        if (!$categories->save()) {
            return view('categories.edit')->with('errors', 'Category not saved!');
        }

        return redirect('/categories')->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = category::findOrfail($category->id);
        if (!$category) {
            return redirect('/categories')->with('errors', 'Category not found!');
        }

        if (!$category->delete()) {
            return redirect('/categories')->with('errors', 'Category not deleted!');
        }

        return redirect('/categories')->with('success', 'Category deleted!');
    }
}
