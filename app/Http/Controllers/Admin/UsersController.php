<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    use HasRolesAndPermissions;

    /*
     *
     */
    public function index()
    {

//        $user = User::find(3);
//        dd(Gate::allows('admin'));
//        dd($user->roles);
        $users = User::paginate(15);

        return view('admin.settings.users.index', [
            'users' => $users,
        ]);
    }

    /*
     *
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.settings.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $permissions = $request->input('permissions');
        $role = $request->input('role');
//        dd($role);
//        $role = Role::all();
//        $role->givePermissionsTo($rolee);
        $user->permissions()->detach();
        $user->roles()->detach();
        $user->roles()->attach($role);

        if ($permissions) {
            foreach ($permissions as $permission) {
                $user->givePermissionsTo($permission);
            }
        }
        $user->update();


//        dd($permission);
//        $user->refreshPermissions($permission);
//        $user->update();

//        dd($user);

        return back();
    }
}
