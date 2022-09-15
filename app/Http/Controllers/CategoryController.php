<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(
            'permission:category-list|category-create|category-edit|category-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware(
            'permission:category-create',
            ['only' => ['create', 'store']]
        );
        $this->middleware(
            'permission:category-edit',
            ['only' => ['edit', 'update']]
        );
        $this->middleware(
            'permission:category-delete',
            ['only' => ['destroy']]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::tree()
            ->get()
            ->toTree();

        return view(
            'categories.index',
            [
                'title' => "Kategóriák",
                'categories' => $categories,
                'files' => [],
                'active_category' => null,
            ]
        );
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
        $validated = $request->validate([
            'title' => 'required|min:3|unique:categories,title',
            'parent_id' => 'nullable'
        ], [
            'title.required' => 'A név nem hagyható üresen',
            'title.min' => 'A név túl rövid',
            'title.unique' => 'Ez a kategória már létezik'
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $files = File::where('category_id', $id)->get();

        $categories = Category::tree()
            ->get()
            ->toTree();

        return view(
            'categories.index',
            [
                'title' => "Kategóriák",
                'categories' => $categories,
                'files' => $files,
                'active_category' => $id,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        request()->validate([
            'title' => 'required|min:3|unique:categories,title',
            'parent_id' => 'nullable'
        ], [
            'title.required' => 'A név nem hagyható üresen',
            'title.min' => 'A név túl rövid',
            'title.unique' => 'Ez a kategória már létezik'
        ]);

        $category->update($request->all());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
