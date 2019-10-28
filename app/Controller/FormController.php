<?php


namespace App\Controller;

use \App\Helper\FormHelper;


Class FormController
{
    public function login()
    {
        $login = new FormHelper('post', 'http://194.5.157.92/phpObjektinis/index.php/account/login', 'wrapper');
        $login->inputName('email')->inputType('email')->inputPlaceholder('email@email.com')->formEnd();
        echo $login;
    }
}
