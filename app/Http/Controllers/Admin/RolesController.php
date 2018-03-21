<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends adminBaseController
{
    public function index()
    {
        $roles = Role::select('id', 'name')->with('permissions')->paginate(20);
        $roles->page = 20;
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        Role::insert(
          [
              'name' => $request->role_name,
              'guard_name' => $request->guard_name
          ]
        );

        return redirect()->route('admin.roles.index');
    }

    public function update(Request $request)
    {
        $role = Role::find($request->role_id);
        $role->name = $request->role_name;
        $role->save();

        $role->permissions()->detach();
        $permission_names = explode(' | ', $request->permissions);
        $permissions = Permission::select('id', 'name')->whereIn('name', $permission_names)->get();

        $names = [];
        if(!empty($permissions)) {
            foreach ($permissions as $permission)
            {
                $role->permissions()->attach($permission->id);
                $names[] = $permission->name;
            }
        }

        $diff = array_diff($permission_names, $names);

        if(!empty($diff)) {
            foreach ($diff as $name)
            {
                $id = Permission::insertGetId(
                    [
                        'name' => $name
                    ]
                );
                $role->permissions()->attach($id);
            }
        }

        return response()->json(
            [
                'code' => 0,
                'message' => '更新成功'
            ]
        );
    }


    public function destroy($id)
    {
        $role = Role::find($id);
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('admin.roles.index');
    }

    public function search(Request $request)
    {
        $roles = Role::where('id', $request->role_id)
            ->orWhere('name', 'like', "%{$request->role_name}%")
            ->paginate(20);

        $roles->page = 20;

        return view('admin.roles.index', compact('roles'));
    }
}
