<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Hash;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = isset($request->search) ? $request->search : '';
        $users = User::searchAndPaginate();

        return view('admin.users.index', compact('users', 'search'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ];

        $request->validate($rules);

        $role_id = $request->role_id;
        unset($request['role_id']);
        $request['password'] = Hash::make($request->password);

        $user = User::create($request->all());
        $user->assignRole($role_id);

        $message = ['type' => 'success', 'text' => 'Usuario creado correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $role = $user->roles()->first();
        $roles = Role::pluck('name', 'id');

        return view('admin.users.edit', compact('user', 'role', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,id,'.$user->id
        ];
        
        if ($request->password) {
            $rules['password'] = 'required|confirmed';
        } else {
            unset($request['password']);
        }

        $request->validate($rules);

        $request['password'] = Hash::make($request->password);
        $role_id = $request->role_id;

        $user->roles()->detach();

        $user->update($request->all());
        $user->assignRole($role_id);

        $message = ['type' => 'success', 'text' => 'Usuario actualizado correctamente'];
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        //
    }
}
