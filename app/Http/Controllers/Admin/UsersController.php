<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends adminBaseController
{

    public function update(Request $request)
    {
        $user = User::find($request->user_id);

        if(!preg_match('/^[\w\x{4e00}-\x{9fa5}]+$/u', $request->user_name)){
            return response()->json(
              [
                  'code' => 1,
                  'message' => '昵称格式错误'
              ]
            );
        }

        if($request->password !== $request->repassword){
            return response()->json(
                [
                    'code' => 2,
                    'message' => '密码确认失败'
                ]
            );
        }

        if(!preg_match('/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/u', $request->email)) {
            return response()->json(
                [
                    'code' => 3,
                    'message' => '邮箱验证失败'
                ]
            );
        }

        $roles = Role::all();

        $name = [];
        foreach ($roles as  $role)
        {
            if($role->name === $request->role) {
                $name[$role->name] = $role->id;
            }
        }

        if(empty($name)){
            return response()->json(
                [
                    'code' => 4,
                    'message' => '没有这个角色'
                ]
            );
        }

        if(!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->user_name;
        $user->email = $request->email;
        $res = $user->save();

        $user->roles()->detach();
        $user->roles()->attach($name[$request->role]);

        if(!$res) {
            return response()->json(
                [
                    'code' => 5,
                    'message' => '更新失败'
                ]
            );
        }

        return response()->json(
            [
                'code' => 0,
                'message' => '更新成功'
            ]
        );
    }

    public function destroy(User $user)
    {
        Reply::where('user_id', $user->id)->delete();
        if($user->delete()) {
            $users = User::select('id', 'avatar', 'name', 'email')->paginate(20);
            $users->page = 20;
            return redirect()->route('admin.home.index', compact('users'));
        }
    }

    public function batchDestroy(Request $request)
    {
        $user_ids = explode('&', $request->user_id);
        $result = User::whereIn('id', $user_ids)->delete();

        if($result === 0 ){
            return response()->json(
                [
                    'message' => 'false'
                ]
            );
        }

        $resul = Reply::WhereIn('user_id', $user_ids)->delete();

        if($result === 0 ){
            return response()->json(
                [
                    'message' => 'false'
                ]
            );
        }
        return response()->json(
            [
                'message' => 'true'
            ]
        );
    }

    public function search(Request $request)
    {
        $page = 15;
        $users = User::select('id', 'avatar', 'name', 'email')
            ->where('id', $request->user_id)
            ->orWhere('name', 'like', "%{$request->user_name}%")
            ->orWhere('email', $request->email)
            ->with('roles')
            ->paginate($page);

        $users->page = $page;
        //TODO 自己写个搜索分页类．．．

        return view('admin.home.index', compact('users'));
        //return redirect()->route('admin.home.index', compact('users'));//并不行
    }
}
