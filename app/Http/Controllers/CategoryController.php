<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\File;
use App\Models\CategoryPermission;

use Illuminate\Support\Facades\Auth;

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
                'categoryPermission' => null,
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

        $category = Category::create($validated);
        CategoryPermission::create([
            'user_id' => Auth::user()->id,
            'category_id' => $category->id,
            'upload' => 1,
            'download' => 1,
        ]);

        return redirect()
            ->action([CategoryController::class, 'show'], ['category' => $category->id])
            ->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $files = File::where('category_id', $id)->orderBy('name', 'asc')->get();

        $categories = Category::tree()
            ->get()
            ->toTree();

        $activeCategory = Category::find($id);

        $categoryPermission = CategoryController::hasPermission($id);

        return view(
            'categories.index',
            [
                'title' => "Kategóriák",
                'categories' => $categories,
                'files' => $files,
                'active_category' => $activeCategory,
                'categoryPermission' => $categoryPermission,
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
        $validated = $request->validate([
            'title' => 'required|min:3|unique:categories,title'
        ], [
            'title.required' => 'A név nem hagyható üresen',
            'title.min' => 'A név túl rövid',
            'title.unique' => 'Ez a kategória már létezik'
        ]);

        $category->update($validated);

        return redirect()
            ->action([CategoryController::class, 'show'], ['category' => $category->id])
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
        CategoryPermission::where('category_id', $category->id)->delete();
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }

    public static function hasPermission(int $id) {
        return CategoryPermission::where('user_id', Auth::user()->id)
            ->where('category_id', $id)
            ->first();
    }
}
