<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::all();
        
        return view('log-aktivitas.index', compact('logs'));
    }
}
