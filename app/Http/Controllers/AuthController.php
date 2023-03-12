<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return  $this->render('create-user');
    }
    
    public function create(Request $request)
    {
        $user = new User();

        $user->save($request->all());

        dd($user);
    }
}
