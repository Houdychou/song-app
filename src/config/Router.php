<?php

namespace App\config;

class Router
{
    // (\d+) pour les id après une url, ([a-zA-Z_-]+) pour les noms
    private $router = [
        "/" => "SongController@index",
        "/deleteSong/(\d+)" => "SongController@deleteSong",
        "/updateSong/(\d+)" => "SongController@updatePage",
        "/api/updateSong/(\d+)" => "SongController@updateSong",
        "/api/addSong" => "SongController@addSong"
    ];

    public function dispatch($requestUri)
    {
        foreach ($this->router as $route => $action) {
            if ($route === $requestUri) {
                return $this->executeAction($action);
            }

            if (preg_match("#^$route$#", $requestUri, $matches)) {
                array_shift($matches);
                return $this->executeAction($action, $matches);
            }
        }
        return false;
    }

    private function executeAction($action, $params = [])
    {
        list($controllerName, $methodName) = explode('@', $action);

        $controllerPath = __DIR__ . '/../controllers/' . $controllerName . '.php';
        if (!file_exists($controllerPath)) {
            return false;
        }

        $controllerClass = "App\\controllers\\" . $controllerName;
        if (!class_exists($controllerClass)) {
            return false;
        }

        $controller = new $controllerClass();
        if (!method_exists($controller, $methodName)) {
            return false;
        }

        if (empty($params)) {
            echo $controller->$methodName();
        } else {
            echo $controller->$methodName(...$params);
        }

        return true;
    }
}