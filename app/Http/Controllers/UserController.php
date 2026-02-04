<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:admin,petugas,peminjam'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt('password')
        ]);

        // CATAT AKTIVITAS
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => auth()->user()->name . ' membuat user baru: ' . $request->name . ' (Role: ' . $request->role . ')'
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,petugas,peminjam'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        // CATAT AKTIVITAS
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => auth()->user()->name . ' mengubah data user: ' . $request->name
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $userName = $user->name;
        
        $user->delete();

        // CATAT AKTIVITAS
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => auth()->user()->name . ' menghapus user: ' . $userName
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
