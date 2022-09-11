<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::tree()->whereDepth('>=',1)->get()->toTree();

        return view(
            'categories.index', [
            'title' => "Kategóriák",
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::tree()->get()->toTree();

        return view('categories.create', [
            'title' => "Kategória létrehozása",
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3',
            'parent_id' => 'required'
        ], [
            'title.required' => 'Title field is required.',
            'parent_id.required' => 'Parent is required.',
        ]);

        Category::create([
            'title' => $validatedData["title"],
            'parent_id' => $validatedData["parent_id"]
        ]);

        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $categories = Category::tree()->get()->toTree();
        $children = Category::find($id)->descendants()->depthFirst()->get()->toTree();

        return view(
            'categories.show', [
            'title' => "Kategóra - {$category->title}",
            'category' => $category,
            'categories' => $categories,
            'children' => $children,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3',
            'parent_id' => 'required'
        ], [
            'title.required' => 'Title field is required.',
            'parent_id.required' => 'Parent is required.',
        ]);

        $category = Category::find($id);

        $category->title = $validatedData["title"];
        $category->parent_id = $validatedData["parent_id"];

        $category->save();

        return back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/categories');
    }
}
