<?php

namespace App\Helper;

class FormHelper
{
    public function __construct($action, $method, $class, $param = '')
    {
        $this->html = '<form class="'.$class.'" action="'.$action.'" method="'.$method.'"'.$param.'>';
    }

    public function addInput($attributes, $label='', $class='', $param = '')
    {
        //implementuoti Label
        $html = '';
        $html.= '<input ';
        foreach ($attributes as $key => $element){
            $html .= ' '.$key.'="'.$element.'"';
        }
        $html .= ' >';

        if($label != ''){
            $html .= '<label>'.$label.'</label>';
        }
        if($class != ''){
            $html = $this->wrapElement($class, $html);
        }
        $this->html .= $html;
        return $this;
    }

    //button


    public function addButton($attributes, $label='', $class='')
    {
        //implementuoti Label
        $html = '';
        $html.= '<button ';
        foreach ($attributes as $key => $element){
            $html .= ' '.$key.'="'.$element.'"';
        }
        $html .= '>Continue</button>';
        if($class != ''){
            $html = $this->wrapElement($class, $html);
        }
        $this->html .= $html;
        return $this;
    }
    //selectas
    public function addSelect($options, $name, $class='', $label='')
    {
        //implementuoti Label
        $html = '';
        $html.= '<select name="'.$name.'">';
        foreach ($options as $value => $option){
            $html .= '<option value="'.$value.'"';
            $html .= ' >';
            $html .= ucfirst($option);
            $html .= '</options>';
        }
        $html .= '</select>';
        if($class != ''){
            $html = $this->wrapElement($class, $html);
        }
        $this->html .= $html;
        return $this;
    }
    //textarea



        public function addTextarea($attributes, $value = '', $label = "", $class = "")
    {
        $html = '';
        if ($label != '') {
            if (isset($attributes['id'])) {
                $for = 'for="' . $attributes['id'] . '"';
            } else {
                $for = "";
            }
            $html .= '<label ' . $for . '>' . $label . '</label>';
        }

        $html .= '<textarea ';
        foreach ($attributes as $key => $element) {
            $html .= ' ' . $key . '="' . $element . '"';
        }
        $html .= ' >';
        $html .= $value;
        $html .= '</textarea>';
        if ($class != '') {
            $html = $this->wrapElement($class, $html);
        }
        $this->html .= $html;
        return $this;
    }
//        //implementuoti Label
//        $html = '';
//        $html.= '<textarea name="'.$name.'"';
//        foreach ($attributes as $key => $element){
//            $html .= ' '.$key.'="'.$element.'"';
//        }
//        $html .= ' >';
//        $html .= $value;
//        $html .= '</textarea>';
//        if($class != ''){
//            $html = $this->wrapElement($class, $html);
//        }
//        $this->html .= $html;
//        return $this;

    public function get()
    {
        $this->html .= '</form>';
        return $this->html;
    }

    public function wrapElement($class, $html)
    {
        $html = '<div class="'.$class.'">'.$html.'</div>';
        return $html;
    }
}