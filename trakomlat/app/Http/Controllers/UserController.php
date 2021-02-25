<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User::all()->toJson();
        return response($users, 200);
    }

}
