<?php


namespace App\Controller;
class ErrorController
{
    //susikuriame metoda kuri kviesime index faile jeigu
    public function pageNotFound()
    {
        echo 'Error 404';
    }

    public function methodNotAllowed()
    { //susikuriame metoda kuri kviesime index faile jeigu bus error
        echo 'Error 405';
    }
}