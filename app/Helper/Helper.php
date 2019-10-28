<?php


namespace App\Helper; //namespace turi apsirasyti virtulau path

class Helper
{
    public function instanceMaker($controller)
    {
    }

    public function getController($path)
    {
        $controller = strtolower($path);
        $controller = ucfirst($controller);
        $controller = '\App\Controller\\'.$controller . 'Controller';
        return $controller;
    }

    public function redirect($url, $statusCode = 303)
    {
//        header('Location: ' . $url, true, $statusCode);
//        die();
    }
}