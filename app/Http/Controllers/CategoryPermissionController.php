<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPermission;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class CategoryPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryPermission  $categoryPermission
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryPermission $categoryPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryPermission  $categoryPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryPermission $categoryPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryPermission  $categoryPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryPermission $categoryPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryPermission  $categoryPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryPermission $categoryPermission)
    {
        //
    }

    public static function addUserPermissions(User $user)
    {
        foreach (Category::all() as $cat) {
            CategoryPermission::updateOrCreate([
                'user_id' => $user->id,
                'category_id' => $cat->id,
            ],[
                'upload' => 1,
                'download' => 1,
            ]);
        }
    }

    public static function syncUserPermissions(User $user, array $upload, array $download)
    {
        foreach (Category::all() as $cat) {
            $u = in_array($cat->id, $upload) ? 1 : 0;
            $d = in_array($cat->id, $download) ? 1 : 0;

            CategoryPermission::updateOrCreate([
                'user_id' => $user->id,
                'category_id' => $cat->id,
            ],[
                'upload' => $u,
                'download' => $d,
            ]);
        }
    }
}
