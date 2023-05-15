<?php

use App\Core\Router;
use App\Http\Controllers\Api\AuthController;

Router::get('/api/users', [AuthController::class, 'getUsers']);
