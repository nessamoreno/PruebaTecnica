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
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = $this->userRepo->all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role_id' => 'required|exists:roles,id',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $this->userRepo->create($validated);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function show(string $id)
    {
        $user = $this->userRepo->find($id);
        $fullName = $user->name; // no tiene apellidos, ajusté a tu modelo
        $letterCount = LetterCountHelper::countLetters($fullName);

        return view('users.show', compact('user', 'letterCount'));
    }

    public function edit(string $id)
    {
        $roles = Role::all();
        $user = $this->userRepo->find($id);
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$id}",
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($request->password) {
            $validated['password'] = Hash::make($request->password);
        }

        $this->userRepo->update($id, $validated);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $this->userRepo->delete($id);
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
    
    /*public function index()
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
    }*/
}
