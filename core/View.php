<?php

namespace Core;

class View
{

    public function render($template){ //posts/admin/create
        //include '/var/www/tomas.sabaliauskis.lt/public_html/phpObjektinis/views/'.$template.'.php';
        $path = __DIR__;
        $path = str_replace('core', '', $path);
        include $path.'views/page/header.php';
        include $path.'views/'.$template.'.php';
        include $path.'views/page/footer.php';
    }

    public function renderAdmin($template)
    {
        $path = __DIR__;
        $path = str_replace('core', '', $path);
        include $path.'views/admin/header.php';
        include $path.'views/'.$template.'.php';
        include $path.'views/page/footer.php';
    }
}