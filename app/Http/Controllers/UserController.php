<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryPermission;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('name', 'ASC')->paginate(5);

        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        CategoryPermissionController::addUserPermissions($user);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Felhasználó sikeresen létrehozva');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $categories = Category::all();
        $userCategoryPermissions = CategoryPermission::where('user_id', $id)->get();

        $preparedCategoryPermissions = [];
        foreach ($userCategoryPermissions as $key => $userCategoryPermission) {
            $preparedCategoryPermissions[$userCategoryPermission->category_id] = [
                'upload' => $userCategoryPermission->upload,
                'download' => $userCategoryPermission->download,
            ];
        }

        return view('users.edit', compact(
            'user',
            'roles',
            'userRole',
            'categories',
            'preparedCategoryPermissions'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'uploadPermissions' =>'required',
            'downloadPermissions' =>'required',
        ], [
            'name.required' => 'Név küldése kötelezō',
            'email.required' => 'Email cím küldése kötelezō',
            'email.email' => 'Nem megfelelō email formátum',
            'email.unique' => 'Ezzel az email címmel már létezik felhasználó',
            'roles.required' => 'Rang küldése kötelezō',
            'uploadPermissions.required' => 'Feltöltési jogok küldése kötelezō',
            'downloadPermissions.required' => 'Letöltési jogok küldése kötelezō',
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        CategoryPermissionController::syncUserPermissions($user, $input['uploadPermissions'], $input['downloadPermissions']);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Sikeres frissítés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'Felhasználó sikeresen törölve');
    }
}
