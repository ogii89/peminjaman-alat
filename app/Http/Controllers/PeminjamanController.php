<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('user','alat')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function pinjam(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        // CEK STOK
        if ($alat->stok < 1) {
            return back()->with('error', 'Stok habis');
        }

        // SIMPAN PEMINJAMAN
        Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $alat->id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam'
        ]);

        // KURANGI STOK
        $alat->decrement('stok');
        // CATAT AKTIVITAS
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => auth()->user()->name . ' meminjam ' . $alat->nama_alat . ' (Tgl: ' . $request->tanggal_pinjam . ' - ' . $request->tanggal_kembali . ')'
        ]);
        return back()->with('success', 'Alat berhasil dipinjam');
    }
    public function milikSaya()
    {
        $peminjaman = Peminjaman::where('user_id',auth()->id())->get();
        return view('peminjaman.saya', compact('peminjaman'));
    }


    public function kembali($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // HITUNG DENDA
        $hari = now()->diffInDays($peminjaman->tanggal_pinjam);
        $denda = $hari > 7 ? ($hari - 7) * 5000 : 0;

        // UPDATE DATA
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
            'denda' => $denda
        ]);

        // TAMBAH STOK KEMBALI
        $peminjaman->alat->increment('stok');

        // CATAT AKTIVITAS
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => auth()->user()->name . ' mengembalikan ' . $peminjaman->alat->nama_alat . ' (Denda: Rp ' . number_format($denda) . ')'
        ]);

        return back()->with('success', 'Alat berhasil dikembalikan');
    }
}