<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Helpers\LetterCountHelper;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    
    public function show(string $id)
    {
        $user = User::with('role')->findOrFail($id);
        $fullName = $user->name . ' ' . $user->apellidos;
        $letterCount = LetterCountHelper::countLetters($fullName);
        return view('users.show', compact('user', 'letterCount'));
    }

    
    public function edit(string $id)
    {
        $roles = Role::all();
        $user = User::with('role')->findOrFail($id);
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$id}", // usamos $id directamente
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $user = User::with('role')->findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');  
    }
}
