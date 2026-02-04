<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\LogAktivitas;

class AlatController extends Controller
{
    public function index()
{
    $alat = Alat::with('kategori')->get();
    $kategori = Kategori::all();
    return view('alat.index', compact('alat','kategori'));

    LogAktivitas::create([
    'user_id' => auth()->id(),
    'aktivitas' => 'Menambahkan alat'
]);
}

public function store(Request $request)
{
    $request->validate([
        'nama_alat'=>'required',
        'kategori_id'=>'required',
        'stok'=>'required|numeric'
    ]);

    Alat::create($request->all());
    return back()->with('success','Alat ditambahkan');
}
public function list()
{
    $alat = Alat::where('stok','>',0)->get();
    return view('alat.list', compact('alat'));
}

}
