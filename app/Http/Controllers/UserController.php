<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Menampilkan daftar user
     */
    public function index(Request $request)
    {
        $keyword = $request->input('search');


        if ($keyword) {

            $users = User::where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->paginate(10)
                ->withQueryString();

        } else {

            $users = User::paginate(10)
                ->withQueryString();

        }


        return view('users.index', compact('users'));
    }



    /**
     * Menampilkan form tambah user
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }



    /**
     * Menyimpan user baru
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:8',

            'role_id' => 'required',

        ]);



        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'role_id' => $request->role_id,

        ]);



        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dibuat');

    }



    /**
     * Menampilkan form edit user
     */
    public function edit(User $user)
    {
        $roles = Role::all();


        return view('users.edit', compact(
            'user',
            'roles'
        ));
    }



    /**
     * Update data user
     */
    public function update(Request $request, User $user)
    {

        $request->validate([

            'name' => 'required',

            'email' => 'required|email',

            'role_id' => 'required',

        ]);



        $user->name = $request->name;

        $user->email = $request->email;

        $user->role_id = $request->role_id;



        if ($request->password) {

            $request->validate([

                'password' => 'min:8'

            ]);


            $user->password = Hash::make($request->password);

        }



        $user->save();



        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil diperbarui');

    }



    /**
     * Menghapus user
     */
    public function destroy(User $user)
    {

        $user->delete();



        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dihapus');

    }

}