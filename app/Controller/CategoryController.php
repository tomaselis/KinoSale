<?php

namespace App\Controller;

use App\Helper\FormHelper;
use App\Helper\Helper;
use App\Model\CategoriesModel;
use App\Model\PostModel;
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

            $helper = new Helper();
            $slug = $helper->makeSlug($_POST['name']);
            $categoryModel = new CategoriesModel();
            $categoryModel->setName($_POST['name']);
            $categoryModel->setDescription($_POST['description']);
            $categoryModel->setParentId($_POST['parent_id']);
            $categoryModel->setSlug($slug);
            $categoryModel->save();
        }

        public function show($slug)
        {
           $category = new CategoriesModel();
           $category->loadBySlug($slug);
           $posts = [];
           foreach($category->getPosts() as $post){
               $postObject = new PostModel();
               $postObject->load($post->post_id);
               if ($postObject->getActive() == 1) {
                   $posts[] = $postObject;
               }
           }

           $this->view->categoryName = $category->getName();
           $this->view->posts = $posts;
           $this->view->render('category/view');

        }

    public function edit($id)
    {

        $categories = CategoriesModel::getCategories();
        $options = [0 => 'Pasirinkti Kategorija'];
        foreach ($categories as $category) {
            $options[$category->id] = $category->name;
        }
        $mainCategory = new CategoriesModel();
        $mainCategory->load($id);

        $form = new FormHelper(url('category/update'), 'post', 'wrapper');
        $form->addInput(
            ['name' => 'name',
                'type' => 'text',
                'value' => $mainCategory->getName(),
            ])->
        addInput(
            ['name' => 'id',
                'type' => 'hidden',
                'value' => $mainCategory->getId(),
            ])->
        addInput(
            ['name' => 'description',
            'type' => 'text',
            'value' => $mainCategory->getDescription(),
        ])->
       select($options, 'parent_id')
            ->addButton([
                'name' => 'register',
                'type' => 'submit',
                'value' => 'register',
            ], "", "button", "");
        $this->view->form = $form->get();
        $this->view->render('category/create');
    }

        public function update()
        {
            if (currentUser()) {
//
                $categoryModel = new CategoriesModel();
                $categoryModel->setName($_POST['name']);
                $categoryModel->setDescription($_POST['description']);
                $categoryModel->setParentId($_POST['parent_id']);
                $categoryModel->setSlug(($_POST['slug']));
                $categoryModel->save();
                $helper = new Helper();
                $helper->redirect('admin/categories');
            }else{
                echo 404;
            }
        }


}
