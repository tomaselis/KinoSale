<?php

namespace App\Controller;

use App\Helper\FormHelper;
use App\Model\CategoriesModel;
use Core\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        echo 'ok';
    }

    public function create()
    {
        $categories = CategoriesModel::getCategories();
        $options = [0 => 'Pasirinkti parent kategorija'];
        foreach($categories as $category){
          $options[$category->id] = $category->name;
        }
        $form = new FormHelper(url('category/store'), 'post', 'wrapper');
        $form->addInput([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Category Name'
        ])
            ->addInput([
                'name' => 'description',
                'type' => 'text',
                'placeholder' => 'Description'
        ])
            ->addSelect($options, 'parent_id')
            ->addButton([
                'name' => 'register',
                'type' => 'submit',
                'value' => 'register',
            ], "", "button", "");
        $this->view->form = $form->get();
        $this->view->render('category/create');
    }


        public function store()
        {
            $categoryModel = new CategoriesModel();
            $categoryModel->setName($_POST['name']);
            $categoryModel->setDescription($_POST['description']);
            $categoryModel->setParentId($_POST['parent_id']);
            $categoryModel->setSlug($_POST['name']);
            $categoryModel->save();
        }
}
