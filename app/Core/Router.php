<?php

namespace App\Core;

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

    public function add($path, $callback) {
        $this->$routes['get'][$path] = $callback;
    }

    public static function get($path, $callback)
    {
       self::$routes['get'][$path] = $callback;
    }
    
    public function middleware($key)
    {
        dd(1);
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

        self::$routes = self::$routes[$method];

        $path = trim($path, '/');


        if ($callback === false) {
            $code = 404;
            http_response_code($code);
            echo Application::$app->twig->render("errors/{$code}.html.twig");
            die();
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
        $viewPath = str_replace(".", "/", $view);
        echo Application::$app->twig->render("$viewPath.html.twig", $params);
    }
}
