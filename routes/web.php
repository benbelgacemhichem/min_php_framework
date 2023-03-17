<?php

use App\Core\Router;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;

Router::get('/',[WelcomeController::class, 'index']);
Router::get('/register',[AuthController::class, 'index']);
Router::post('/register',[AuthController::class, 'store']);
Router::get('/users',[AuthController::class, 'getUsers']);