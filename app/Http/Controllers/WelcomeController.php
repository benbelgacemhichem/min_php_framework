<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Request;

class WelcomeController extends Controller
{
    public function index() {
        return  $this->render('welcome');
    }
    
    public function store(Request $request) {
        dd($request->all());
    }
   
}