<?php

namespace App\Http\Controllers;

use Monolog\Handler\WhatFailureGroupHandler;
use Itspire\MonologLoki\Handler\LokiHandler;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\HostnameProcessor;
use Monolog\Processor\IntrospectionProcessor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\MercurialProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\PsrLogMessageProcessor;
use Monolog\Processor\TagProcessor;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;

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
            ->select('id','name')
            ->where('name','=', $name)
            ->where('password', '=', $password)
            ->get()->toJson();

       return $users;
    }


    public function testLog()
    {

        Log::channel('single')->info('test additional info');

    }
}
