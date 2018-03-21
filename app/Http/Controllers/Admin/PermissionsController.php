<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends adminBaseController
{
    public function index()
    {
        $permissions = Permission::select('id', 'name', 'guard_name')->paginate(20);
        $permissions->page = 20;

        return view('admin.permissions.index', compact('permissions'));
    }

    public function destroy(Request $request, $id)
    {
        $permission = Permission::where('id', $id)->delete();

        return redirect()->route('admin.permissions.index');
    }

    public function update(Request $request)
    {
        if(empty($request->permission_id) ||
            empty($request->permission_name) ||
            empty($request->guard_name)) {
            return response()->json(
                [
                    'code' => 1,
                    'message' => '不能为空值'
                ]
            );
        }

        $permission = Permission::find($request->permission_id);
        $permission->name = $request->permission_name;
        $permission->guard_name = $request->guard_name;
        $permission->save();

        return response()->json(
            [
                'code' => 0,
                'message' => '更新成功'
            ]
        );
    }

    public function store(Request $request, Permission $permission)
    {
        if(empty($request->permission_name) || empty($request->guard_name)) {
            return response()->json(
                [
                    'code' => 1,
                    'message' => '不能为空'
                ]
            );
        }

        $permission->name = $request->permission_name;
        $permission->guard_name = $request->guard_name;
        $permission->save();

        return redirect()->route('admin.permissions.index');
    }
}
