<?php

namespace  App\Controller;

use App\Helper\FormHelper;
use App\Block\Posts\SearchResults;
use App\Model\PostModel;
use Core\Controller;

class SearchController extends Controller
{
    public function index(){
//        $this->view->render('posts/search-results');
        $form = new FormHelper(url('search/search'), 'get', 'wrapper-search');
        $form->addInput([
            'name' => 'search',
            'placeholder' => 'PVZ: Title',
            'type' => 'text',
            'id' => 'search'

        ]);
        $form->addButton([
            'value' => 'search',
            'type' => 'submit',
            'class' =>'signupbtn',
        ], "", "button", "");

        $this->view->form = $form->get();
        $this->view->render('posts/search-results');
   }

    public function search()
    {
        $keyword = $_GET['keyword'];
        $strLenght = strlen($keyword);
        $results = PostModel::getSearchResults($keyword);
        if($strLenght < 2 ){
            echo '';
        }else
        {
            $block = new SearchResults();
            echo $block->getResultsBlock($results);
        }

    }



}