<?php


namespace App\Controller;

use App\Model\CategoriesModel;
use App\Model\PostModel;
use Core\Controller;
use \App\Helper\Helper;
use \App\Helper\ImageHelper;
use Intervention\Image\ImageManager;

class PostController extends Controller
{

    //echo 'Content from PostController';

    public function index()
    {
        $this->view->posts = \App\Model\PostModel::getPosts();
//        debug($this->view->posts);
        $this->view->render('posts/posts');

    }

    public function show($id)
    {
        //echo 'Vienas postas';

        $postsObject = new \App\Model\PostModel();
        $postsObject->load($id);
        $this->view->post = $postsObject;

        $this->view->render('posts/post');
    }

    public function create()
    {
        if (currentUser()) {
//            $this->view->render('posts/admin/create');

            //atvaizduoti create forma

            $form = new \App\Helper\FormHelper(url('post/store'), 'post', 'wrapper');
            $form->addInput([
                'name' => 'title',
                'type' => 'text',
                'placeholder' => 'Enter your Blog Title',
            ])
                ->addTextarea([
                    'name' => 'content',
                    'placeholder' => 'Write your blog here',
                    'rows' => '10',
                    'cols' => '50',
                ])
                ->addInput([
                    'name' => 'img',
                    'type' => 'text',
                    'placeholder' => 'Please insert link for you image here',
                ])
                ->addButton([
                    'name' => 'register',
                    'type' => 'submit',
                    'value' => 'register',
                ], "", "button", "");
            $this->view->form = $form->get();
            $this->view->render('posts/admin/create');

        } else {
            echo 404;
        }
    }

    public function store()
    {
        if (currentUser()) {
            $data = $_POST;
            //print_r($_POST);
            //die();
            $postModelObject = new \App\Model\PostModel();
            $postModelObject->setTitle($_POST['title']);
            $postModelObject->setContent($_POST['content']);
            $postModelObject->setImage($_POST['img']);
            $postModelObject->setAuthorId(1);
            $postModelObject->save();
            $helper = new Helper();
            $helper->redirect('post/');
        } else {
            echo 404;
        }


        //redirectas
        //kviesime postmodel klase ir create post metoda
        //redirect i index metoda
    }

    public function edit($id)
    {
        if (currentUser()) {
            $postModelObject = new PostModel();
            $postModelObject->load($id);

            //        $this->view->render('posts/admin/edit');

            $selectedCategories = [];
            foreach ($postModelObject->getCategories() as $cat) {
                $selectedCategories[] = $cat->category_id;
            }
            $form = new \App\Helper\FormHelper(url('post/update'), 'post', 'wrapper', 'enctype="multipart/form-data"');
            $form->addInput([
                'name' => 'title',
                'type' => 'text',
                'placeholder' => 'Enter your Blog Title',
                'value' => $postModelObject->getTitle()
            ])
                ->addInput([
                    'name' => 'id',
                    'type' => 'hidden',
                    'value' => $postModelObject->getId()
                ])
                ->addTextarea([
                    'name' => 'content',
                    'placeholder' => 'Write your blog here',
                    'rows' => '10',
                    'cols' => '50',

                ], $postModelObject->getContent())
                ->addInput([
                    'name' => 'img',
                    'type' => 'file',
                    'placeholder' => 'Please insert link for you image here',
                    'value' => $postModelObject->getImage()
                ]);

            $allCategories = CategoriesModel::getCategories();
            foreach ($allCategories as $category) {
                if (in_array($category->id, $selectedCategories)) {
                    $form->addInput([
                        'name' => 'category[]',
                        'type' => 'checkbox',
                        'checked' => 'checked',
                        'value' => $category->id,
                    ], $category->name, 'cat');
                } else {
                    $form->addInput([
                        'name' => 'category[]',
                        'type' => 'checkbox',
                        'value' => $category->id,
                    ], $category->name, 'cat');
                }
            }
            $form->addButton([
                'name' => 'register',
                'type' => 'submit',
                'value' => 'register',
            ], "", "button", "");

            $this->view->form = $form->get();
            $this->view->render('posts/admin/edit');

        } else {
            echo 404;
        }
    }

    public function update()
    {
//        debug($_POST['category']);
//

            if (currentUser()) {
                // cia naudojame ImageHelper klase
                $imageName = basename($_FILES["img"]["name"]);
                $directory = ImageHelper::generateFolderPath($_FILES["img"]["name"]);
                ImageHelper::uploadImage($directory, $_FILES);

                // toliau kodas kuris jau buvo parasytas pries helper
                $response = [];
                $data = $_POST;
                $postModelObject = new \App\Model\PostModel();
                $postModelObject->load($_POST['id']);
                $postModelObject->setTitle($_POST['title']);
                $postModelObject->setContent($_POST['content']);
                $postModelObject->setAuthorId(1);
//                $imageNameWithPath = ImageHelper::getFileNameWithDirectory($_FILES["img"]["name"]);
                $postModelObject->setImage($_FILES["img"]["name"]);
//                $imageNameWithPathSize = ImageHelper::generateImage($imageNameWithPath, 300, 200);
                $postModelObject->save();
                $postModelObject->setCategories($_POST['category']);
                $response['msg'] = 'Post saved';
                $response['code'] = '200';
                echo json_encode($response);
//                $helper = new Helper();
//                $helper->redirect('post/');
            } else {
                echo 404;
            }
    }

}
//    public function delete($id)
////    {
////        if (currentUser()) {
//////    $id = (int)$_GET['id'];
////            $postModelObject = new \App\Model\PostModel();
////            $postModelObject->delete($id);
////            $helper = new Helper();
////            $helper->redirect('post/');
////        }else {
////            echo 404;
////        }
////    }

//      $postModelObject->redirect('http://194.5.157.92/phpObjektinis/index.php/post');
