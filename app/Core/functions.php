<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function env($value)
{
    return $_ENV[$value];
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("resources/views/errors/{$code}.php");

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}
