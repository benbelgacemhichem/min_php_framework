<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::all();
        return  $this->render('users.index', compact('users'));
    }

    public function show(Request $request)
    {
        $user = User::find($request->id);
        return  $this->render('users.details', compact('user'));
    }

    public function create()
    {
        return  $this->render('users.create');
    }
    
    public function test()
    {
        return  $this->render('test');
    }
   
    public function store(Request $request)
    {
        $user = new User();
        $user->save($request->all());
    }

    public function edit(Request $request) 
    {
        // dd($request->getRouteParams(),$request->getRouteParam('id'));
        return  $this->render('users.edit');
    }
    
    public function update(Request $request) 
    {
    }
   
    public function destroy(Request $request) 
    {
    }
}
