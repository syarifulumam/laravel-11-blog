<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(6);
        return view('user.index', compact('users'));
    }
    public function edit($id){
        $user = User::FindOrFail($id);
        return view('user.edit', compact('user'));
    }
    public function update(Request $request, $user){
        $validate = $request->validate([
            'name' => ['required|min:4'],
            'email' => ['required|email|min:4'],
            'role' => ['required',new Enum(Role::class)],
        ]);

        $user = User::FindOrFail($user);
        $user->update($validate);
        return redirect()->route('user.index')->with('message','data berhasil di ubah');
    }
    public function destroy($user){
        $user = User::FindOrFail($user);
        $user->delete();
        return redirect()->route('user.index')->with('message','data berhasil di hapus');
    }
}
