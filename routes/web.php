<?php

use App\Core\Router;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;

Router::get('/',[WelcomeController::class, 'index']);
Router::get('/users',[AuthController::class, 'index']);
// Router::get('/users/create',[AuthController::class, 'index']);
// Router::get('users/create',[AuthController::class, 'create']);
// Router::post('users/register',[AuthController::class, 'store']);
// Router::get('/users/{id}/{username}',[AuthController::class, 'edit']);