<?php

use App\Core\Application;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

require  BASE_PATH . 'app/Core/functions.php';

$db_config  = require base_path('app/config/database.php');

$app = new Application($db_config);

require base_path('routes/web.php');

$app->run();


