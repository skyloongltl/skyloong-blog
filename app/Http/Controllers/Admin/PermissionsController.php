<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::select('id', 'name')->paginate(20);
        $permissions->page = 20;

        return view('admin.permissions.index', compact('permissions'));
    }
}
