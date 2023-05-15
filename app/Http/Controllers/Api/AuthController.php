<?php

namespace App\Http\Controllers\Api;

use App\Core\Controller;
use App\Core\Response;
use App\Core\Request;

class AuthController extends Controller
{
    public function getUsers(Request $request, Response $response)
    {
        $users = \App\Models\User::all();
        return $response->json($users);
    }
}
