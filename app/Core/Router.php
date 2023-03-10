<?php

namespace App\Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Router
{
    public Request $request;
    public Response $response;
    protected static array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public static function get($path, $callback)
    {
        self::$routes['get'][$path] = $callback;
    }

    public static function post($path, $callback)
    {
        self::$routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = ($this->request->method());
        $callback = self::$routes[$method][$path] ?? false;
        if ($callback === false) {
            abort(404);
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        $loader = new FilesystemLoader(base_path("resources/views"));
        $twig = new Environment($loader);
        echo $twig->render("$view.twig", $params);
    }
}
