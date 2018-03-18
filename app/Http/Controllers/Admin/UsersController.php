<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function destroy(User $user)
    {
        Reply::where('user_id', $user->id)->delete();
        if($user->delete()) {
            $users = User::select('id', 'avatar', 'name', 'email')->paginate(20);
            return redirect()->route('admin.home.index', compact('users'));
        }
    }
}
