<?php


namespace Core;

use App\Model\CategoriesModel;
use Core\View;


class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
        $this->view->user = currentUser(); //is sesijos kintamuju, pagal prisiloginimo parametrus,
        $this->view->categories = CategoriesModel::getParentCategories();
    }
}