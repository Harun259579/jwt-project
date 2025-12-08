<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
{
    $users = User::latest()->get();
    return view('backend.users.index', compact('users'));
}

public function create()
{
    return view('backend.users.create');
}

  public function store(Request $request)
{
    $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required|min:6',
        'role'=>'required',
        'is_active'=>'required'
    ]);

    $user=create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'is_active' => $request->is_active,
    ]);
    $user->assignRole($request->input('role'));

    return redirect()->route('users.index')->with('success','User Created Successfully!');
}

public function edit($id)
{
    $user = User::findOrFail($id);
    return view('backend.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => "required|email|unique:users,email,$id",
        'role' => 'required',
        'is_active' => 'required'
    ]);

    $user->update([
         'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'is_active' => $request->is_active,
    ]);

    if ($request->password) {
        $data['password'] = bcrypt($request->password);
    }
    $user->update($data);
    return redirect()->route('users.index')->with('success','User Updated!');
}
public function destroy($id)
{
    User::findOrFail($id)->delete();
    return redirect()->route('users.index')->with('success','User Deleted!');
}

}
