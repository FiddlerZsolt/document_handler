<?php

namespace Database\Seeders;

use App\Http\Controllers\CategoryPermissionController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateDefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user')
        ]);

        $role = Role::create(['name' => 'User']);

        $permissions = Permission::pluck('id', 'id')->all();
        CategoryPermissionController::addUserPermissions($user);

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
