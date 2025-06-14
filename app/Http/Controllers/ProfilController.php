<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

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
    public function show($slug)
    {
        [$id, $nameSlug] = explode('-', $slug, 2);

        $user = \App\Models\User::findOrFail($id);

        if (Str::slug($user->name) !== $nameSlug) {
            abort(404); // atau redirect ke URL yang benar
        }

        if (Auth::id() !== $user->id) {
            abort(403);
        }

        return view('profil.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('profil.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'jenis_kelamin' => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'instansi' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $slug = Str::slug($request->name);

        if ($request->hasFile('foto')) {
            if (!is_null($user->foto) && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $filePath = $request->file('foto')->store('users', 'public');
            $user->foto = $filePath;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password' => Hash::make($request->password),
            'instansi' => $request->instansi,
            'no_hp' => $request->no_hp,
            'slug' => $slug
        ]);

        return redirect()->route('profil.show', $user->slug)->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = auth()->user();
        if (!is_null($user->foto) && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }
        $user->delete();
        return redirect()->route('home')->with('success', 'Profil berhasil dihapus');
    }
}
