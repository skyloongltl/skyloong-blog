<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::select('id', 'avatar', 'name', 'email')->paginate(20);
        $users->page = 20;

        return view('admin.home.index', compact('users'));
    }

    
}
