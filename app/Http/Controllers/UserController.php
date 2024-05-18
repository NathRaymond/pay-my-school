<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::orderBy('created_date', 'DESC')->get();
        return view('admin.user.view', $data);
    }
    public function store(Request $request)
    {
        return view('admin.user.create');
    }
}
