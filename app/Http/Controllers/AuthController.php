<?php

namespace App\Http\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::all();

        $user = User::find(2);
        
        // $user = User::where('username', 'test');


        return  $this->render('create-user', compact('users'));
    }

    public function create(Request $request)
    {
        $user = new User();

        $user->save($request->all());

        dd($user);
    }
}
