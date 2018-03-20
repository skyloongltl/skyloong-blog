<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
    }

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

        if(!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->user_name;
        $user->email = $request->email;
        $res = $user->save();

        if(!$res) {
            return response()->json(
                [
                    'code' => 4,
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
        $users = User::select('id', 'avatar', 'name', 'email')
            ->where('id', $request->user_id)
            ->orWhere('name', 'like', "%{$request->user_name}%")
            ->orWhere('email', $request->email)
            ->paginate(20);

        $users->page = 20;

        return view('admin.home.index', compact('users'));
        //return redirect()->route('admin.home.index', compact('users'));//并不行
    }
}
