<?php

use App\Core\Application;
use Spatie\Ignition\Ignition;

const BASE_PATH = __DIR__ . '/../';

function base_path($path): String
{
    return BASE_PATH . $path;
}

require getLanguageFiles();
function getLanguageFiles()
{
    $lang_path = base_path('resources/lang/ar');
    $langFiles = scandir($lang_path);

    foreach($langFiles as $lang) {
        if ($lang === '.' || $lang === '..') {
            continue;
        }
        return "$lang_path/$lang";
    }
}
function translate($str): String
{
    global $lang;
    if(!empty($lang[$str])) {
        return  $lang[$str];
    }
    return $str;
}


$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

Ignition::make()->register();

$db_config  = require base_path('app/config/database.php');

$app = new Application($db_config);

require base_path('routes/web.php');
require base_path('routes/api.php');

return $app;
