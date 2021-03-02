<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            "message" => "new user created"
        ], 201);
    }

    public function loginUser(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');


        $users = DB::table('users')
            ->where('name','=', $name )
            ->where('password', '=', $password)
            ->get();

       return $users;
    }
}
