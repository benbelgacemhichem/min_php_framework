<?php

use App\Core\Application;
use Spatie\Ignition\Ignition;

const BASE_PATH = __DIR__ . '/../';

function base_path($path): String
{
    return BASE_PATH . $path;
}

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

Ignition::make()->register();

$db_config  = require base_path('app/config/database.php');

require base_path('app/core/Translation.php');

$app = new Application($db_config);

require base_path('routes/web.php');
require base_path('routes/api.php');

return $app;
