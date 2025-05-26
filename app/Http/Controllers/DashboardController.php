<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahAdmin = User::where('role', 'admin')->count();
        $jumlahUser = User::where('role', 'user')->count();
        $jumlahBarang = Barang::count();
        $pendingPeminjaman = Peminjaman::where('status', 'pending')->count();

        return view('dashboard', compact(
            'jumlahAdmin',
            'jumlahUser',
            'jumlahBarang',
            'pendingPeminjaman'
        ));
    }
}
