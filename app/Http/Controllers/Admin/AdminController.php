<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('roles')->get();
        return view('admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Admin $data_admin)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.edit', compact('data_admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $data_admin)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed', // hanya jika ingin ganti password
            'role' => 'required|exists:roles,name',
        ]);

        // Update field biasa
        $data_admin->username = $request->username;

        // Update password jika diisi
        if ($request->filled('password')) {
            $data_admin->password = Hash::make($request->password);
        }

        $data_admin->save();

        // Update role
        $data_admin->syncRoles([$request->role]);

        return redirect()->route('admin_data-admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $data_admin)
    {
        $data_admin->delete();
        return redirect()->route('admin_data-admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}
