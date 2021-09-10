<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->get();

        if ($user->isEmpty()) {
            abort('404');
        }

        return view('user.show', ['user' => $user[0]]);
    }
}
