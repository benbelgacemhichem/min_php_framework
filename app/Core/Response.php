<?php

namespace App\Core;

class Response
{
    public static function setStatusCode(int $code) {
        http_response_code($code);
    }

    public function json($data = [], $status = 200, array $headers = [], $options = 0) {

        ob_clean();
        header_remove();
        header("Content-type: application/json; charset=utf-8");
        http_response_code($status);
        echo json_encode($data);
        exit();

        return json_encode($data);
    }

}