<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends adminBaseController
{
    public function index()
    {
        $users = User::select('id', 'avatar', 'name', 'email')->with('roles')->paginate(20);
        $users->page = 20;

        return view('admin.home.index', compact('users'));
    }

    
}
