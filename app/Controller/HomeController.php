<?php
namespace App\Controller;
use App\Helper\FormHelper;
use Core\Controller;
class HomeController extends Controller
{
    public function index()
    {
        $form = new FormHelper('account/create','post', 'wrapper');
        $form->addInput([
            'name' => 'name',
            'placeholder' => 'Name',
            'type' => 'text',
            'class' => 'input',
        ], 'Name', 'Class')
            ->addInput([
                'name' => 'age',
                'type' => 'range',
                'step' => '1',
                'min' => '1',
                'max' => '100',
            ]);
        $this->view->form =  $form->get();
        $this->view->render('page/home');
    }
}

