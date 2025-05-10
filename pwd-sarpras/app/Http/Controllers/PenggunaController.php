<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PenggunaController extends Controller
{
    public function index()
    {
        $userCount = User::where('role', 'user')->count();
        $adminCount = User::where('role', 'admin')->count();
        $users = User::where('role', 'user')->get();
        $admins = User::where('role', 'admin')->get();

        return view('pengguna', compact('userCount', 'adminCount', 'users', 'admins'));
    }
}
