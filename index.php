<?php

// error handlingas

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);   //error handling

include 'includes/functions.php';

session_start();

// kad veiktu autoloaderis turime sita parasyti autoloaderis is composser jason faile
require __DIR__ . '/vendor/autoload.php';

//naudojame kai jau sukureme helper.php kvieciame failiuka
use \App\Helper\Helper;

if (isset($_SERVER['PATH_INFO'])) {
    $path = $_SERVER['PATH_INFO'];
} else {
    $path = '/';
}

$path = explode('/', $path);


//echo '<pre>';
//print_r($path);
//echo $path;
$helper = new Helper(); //susikuriame helperio objekta kad galetume ji naudoti toliau
if (isset($path[1]) && !empty($path[1])) {

    $controller = $helper->getController($path[1]); // suformatuoja kontrolerio klases pavadinima
    //echo $controller;


    if (isset($path[2]) && !empty($path[2])) {
        $method = $path[2];
        //echo $method;
    } else {
        $method = 'index';
    }
    if (class_exists($controller)) {
        $object = new $controller;
        //$object->{$method}();
        if (method_exists($object, $method)){ //Tikriname ar metodas egzistuoja
            if (isset($path[3]) && !empty($path[3]))
            {
                $object->{$method}($path[3]); //objektas kreipiasi i metoda ir kintamaji
            }else{
                $object->{$method}();
            }
            // jeigu taip daro viskas kas vyksta if dalyje
        }else { // jeigu ne daro viskas kas aprasyta else
            $error405 = new \App\Controller\ErrorController(); //creating object by calling class ErrorController
            $error405->methodNotAllowed();  //calling method for error 405 from new object
        }

    } else{
        $error404 = new \App\Controller\ErrorController();  //creating object by calling class ErrorController
        $error404->pageNotFound(); //calling method for error 404 from new object
    }
} else {
    $object = new \App\Controller\HomeController(); // Kvieciamas objektas Home page controller
    $object->index();
}


