<?php

namespace App\Core;

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public Controller $controller;
    public Database $db;
    public Validator $validator;

    public function __construct($db_config)
    {
        self::$app = $this;

        $this->db= new Database($db_config);

        $this->validator =new Validator();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
