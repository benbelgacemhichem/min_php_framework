<?php

use App\Core\Router;
use App\Http\Controllers\WelcomeController;

Router::get('/',[WelcomeController::class, 'index']);
Router::post('/store',[WelcomeController::class, 'store']);