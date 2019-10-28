<?php

function url($path, $param = 0)
{
    $url =  'http://194.5.157.92/phpObjektinis/index.php/'.$path;

    if ($param !== 0){
        $url .= '/'.$param;
    }
    return $url;
}
function mediaUrl($path)
{
    $url =  'http://194.5.157.92/phpObjektinis/'.$path;
    return $url;
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


function debug($data){
    echo '<pre>';
    print_r($data);
    die();
}

function getImage($image, $width, $height){
    $image = \App\Helper\ImageHelper::generateImage($image,$width,$height);
    return $image;

}
