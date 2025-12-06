<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function index()
    {
        $admins = Admin::orderBy('created_at', 'desc')->get();
        return view('admin.index', compact('admins'));
    }

   
    public function create()
    {
        return view('admin.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email',
            'username' => 'required|string|unique:admin,username|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan!');
    }

   
    public function show(Admin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    
    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email,' . $admin->id,
            'username' => 'required|string|unique:admin,username,' . $admin->id,
            'role' => 'required|string',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        // Update password jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $admin->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diupdate!');
    }

    // Menghapus admin
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus!');
    }
}