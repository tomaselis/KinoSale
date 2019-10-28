<?php

namespace App\Controller;

use Core\Controller;
use App\Model\UsersModel;
use App\Helper\Helper;
use App\Helper\InputHelper;


class AccountController extends Controller
{
    public function index()
    {
        echo 'ok';
    }

    public function registration()
    {
        //load registration form
        $form = new \App\Helper\FormHelper(url('account/create'), 'post', 'wrapper');
        $form->addInput([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Name',
        ], '', '', 'Register')
            ->addInput([
                'name' => 'email',
                'type' => 'email',
                'placeholder' => 'email@email.com',
            ])
            ->addInput([
                'name' => 'password',
                'type' => 'password',
                'placeholder' => 'Type in password',
            ])
            ->addInput([
                'name' => 'password2',
                'type' => 'password',
                'placeholder' => 'Repeat password',
            ])
//            ->addSelect([
//                1 => 'admin',
//                2 => 'master admin',
//                3 => 'user'], 'city')
            ->addButton([
                'name' => 'register',
                'type' => 'submit',
                'value' => 'register',
            ], "", "button", "");
        $this->view->form = $form->get();
        $this->view->render('account/registration');
    }

    public function login()
    {
        $form = new \App\Helper\FormHelper(url('account/auth'), 'post', 'wrapper');
        $form->addInput([
            'name' => 'email',
            'placeholder' => 'email@email.lt',
            'type' => 'text',
        ], '', '', 'Login')
            ->addInput([
                'name' => 'password',
                'placeholder' => 'Password',
                'type' => 'password',
            ])

            //type="submit"  value="login"
            ->addButton([
                'value' => 'login',
                'type' => 'submit',
                'class' =>'signupbtn',
            ], "", "button", "");
        $this->view->form = $form->get();
        $this->view->render('account/login');
    }

    public function create()
    {
        if (inputHelper::checkEmail($_POST['email'])) {
            if (InputHelper::PasswordMatch($_POST['password'], $_POST['password2'])) {
                $accountModelObject = new \App\Model\UsersModel();
                $accountModelObject->setName($_POST['name']);
                $accountModelObject->setEmail($_POST['email']);
                $pass = \App\Helper\InputHelper::passwordGenerator($_POST['password']);
                $accountModelObject->setPassword($pass);
                $accountModelObject->setRoleId(1);
                $accountModelObject->setActive(1);
                $accountModelObject->save();
                $helper = new Helper();
                $helper->redirect('');
            }
        }
    }

    public function auth()
    {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $password = InputHelper::passwordGenerator($password);
        $user = \App\Model\UsersModel::verification($email, $password);

//print_r($user);
//print_r($_SESSION);
        if (!empty($user)) {
            // vyks dalykai prisiloginus
            $_SESSION['user'] = $user;
//            UsersModel::resetLoginNumber($user->id);
            $helper = new Helper();
            $helper->redirect(url('post'));
        } else {
            //echo 'Could not log in';
            if(!InputHelper::uniqueEmail($email)){
                $user = new UsersModel();
                $user->loadByEmail($email);

                if ($user->getTriesToLogin() > 4){
                    $user->delete();
                    //send Email - namu darbas
                }else {
                    $triesToLogin = $user->getTriesToLogin() + 1;
                    $user->setTriesToLogin($triesToLogin);
                    $user->save($user->getId());
                }
            }
            //Neteisingas prisijungimas
            //redirect i admin
        }
    }

    public function logout()
    {
        session_destroy();
        $helper = new Helper();
        $helper->redirect('post/');
    }

}

//
//->addTextarea([
//    'placeholder' => 'Insert post...',
//    'rows' => '20',
//], 'content', '')