<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alat;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $alatCount = Alat::count();
        $peminjamanCount = Peminjaman::count();

        return view('dashboard', compact('userCount', 'alatCount', 'peminjamanCount'));
    }
}
