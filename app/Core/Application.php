<?php

namespace App\Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;

class Application
{
    public Router $router;
    public $twig;
    public Request $request;
    public Response $response;
    public static Application $app;
    public Controller $controller;
    public Database $db;
    public Validator $validator;

    public function __construct($db_config)
    {
        self::$app = $this;
        // Twig Config
        $loader = new FilesystemLoader(base_path("resources/views"));
        $this->twig = new Environment($loader, ['debug' => true]);
        $getUri = new TwigFunction('getUri', function () {
            return Application::$app->request->path($_SERVER['REQUEST_URI']);
        });
        $asset = new TwigFunction('asset', function ($filePath) {
            return env('APP_URL' . $_SERVER['SERVER_PORT'], 'http://localhost:' . $_SERVER['SERVER_PORT']) . '/' . $filePath;
        });
        $this->twig->addFunction($getUri);
        $this->twig->addFunction($asset);

        $this->db = new Database($db_config);
        $this->validator = new Validator();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
