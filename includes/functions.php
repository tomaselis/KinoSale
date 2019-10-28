<?php

function url($path, $param = 0)
{
    return 'http://194.5.157.92/phpObjektinis/index.php/'.$path;
}

function currentUser()
{
    if (isset($_SESSION['user'])){
        return $_SESSION['user'];
    }
    else {
        return 0;
    }
}