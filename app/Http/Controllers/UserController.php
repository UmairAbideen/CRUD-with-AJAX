<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $users = User::all();
            return response()->json($users);
        }
        return view('users');
    }


    public function create(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'New User is Successfully Created.']);
    }


    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return response()->json($user);
    }


    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json(['message' => 'User information updated successfully.']);
    }


    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.']);
        } else {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }
}
