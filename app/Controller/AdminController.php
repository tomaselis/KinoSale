<?php

namespace App\Controller;

use App\Model\CategoriesModel;
use App\Model\PostModel;
use Core\Controller;
use App\Helper\Helper;
use App\Helper\FormHelper;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $helper = new Helper;
        if (currentUser() === 0) {
            $helper->redirect(url('account/login'));
        }
        $roleId = (int)currentUser()->role_id;
        if ($roleId !== 2) {
            $helper->redirect(url('account/login'));
        }
    }

    public function posts()
    {
        $posts = PostModel::getPosts();
        $this->view->posts = $posts;
        $this->view->renderAdmin('posts/admin/posts');
    }

    public function categories()
    {
        $categories = CategoriesModel::getAllCategories();
        $this->view->categories = $categories;
        $this->view->renderAdmin('category/admin/categories');

    }

    public function delete($id)
    {
        $category = new CategoriesModel();
        $category->delete($id);

        $helper = new Helper();
        $helper->redirect(url('admin/categories'));
    }

    public function edit($id)
    {
        if (currentUser()) {
            $catModelObject = new CategoriesModel();
            $catModelObject->load($id);

            $form = new FormHelper(url('admin/update'), 'post', 'wrapper');
            $form->addInput([
                'name' => 'name',
                'type' => 'text',
                'value' => $catModelObject->getName()
            ])
                ->addInput([
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => $catModelObject->getId(),
                ])
                ->addTextarea([
                    'name' => 'description'
                ], 'description', $catModelObject->getDescription())
                ->addInput([
                    'name' => 'parent_id',
                    'type' => 'text',
                    'value' => $catModelObject->getParentId(),
                ])
                ->addInput([
                    'name' => 'slug',
                    'type' => 'text',
                    'value' => $catModelObject->getSlug()
                ]);
            $form->addButton([
                'name' => 'register',
                'type' => 'submit',
                'value' => 'register',
            ], "", "button", "");
            $this->view->form = $form->get();
            $this->view->renderAdmin('category/admin/edit');
        } else {
            echo '404';
        }
    }

    public function update()
    {
        if (currentUser()) {
            $postModelObject = new CategoriesModel();
            $postModelObject->load($_POST['id']);
            $postModelObject->setName($_POST['name']);
            $postModelObject->setId($_POST['id']);
            $postModelObject->setDescription($_POST['description']);
            $postModelObject->setSlug($_POST['slug']);
            $postModelObject->save($_POST['id']);
            $helper = new Helper();
            $helper->redirect(url('admin/categories'));
        } else {
            echo '404';
        }
    }
}
