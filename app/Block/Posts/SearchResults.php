<?php

namespace App\Block\Posts;



class SearchResults
{
    public  function getResultsBlock($results)
    {
        $html = '';
        $html .= '<div class="post-row">';
        foreach ($results as $post){
            $html .= $this->getPostBlock($post);
        }
        $html .='</div>';
        return $html;
    }

    public function getPostBlock($post)
    {
        $html = '';
        $html .='<div class="cellone">';
        $html .= '<div class="cell">';
        $html .='<img src="http://194.5.157.92/phpObjektinis/uploads/'.$post->img.'">';
        $html .='</div>';
        $html .= '<div class="text">';
        $html .="<h2>$post->title</h2>";
        $html .='<a href="'.url('filmai/show', $post->id).'">Read more ...</a>';
        $html .='</div>';
        $html .='</div>';

        return $html;
    }
}
