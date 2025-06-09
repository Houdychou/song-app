<?php

Namespace App\controllers;

class Controller {
    public function renderPhpView($view, $array=[]) {
        $templateDir = __DIR__ . '/../views/';
        extract($array);
        include $templateDir . $view;
    }
}