<?php


namespace App\Model;

use Core\Database;

class FilmModel
{
    private $id = NULL;
    private $name;
    private $amziausgrupe;
    private $image;
    private $active;



    public function __construct()
{
    $this->db = new Database();
}


    public function getId()
    {
        return $this->id;
    }

    public function setTitle($name)
    {
        $this->title = $name;
    }

    public function getTitle()
    {
        return $this->name;
    }


    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setAmziausgrupe($amaziausgrupe)
    {
        $this->authorId = $amaziausgrupe;
    }

    public function getAmziausgrupe()
    {
        return $this->amziausgrupe;
    }

    public function getActive()
    {
        return $this->active;
    }


    public static function getFilms()
    {
        $db = new Database();
        $db->select()->from('filmai')->where('active', 1);
        return $db->getAll();
    }

    public function load($id)
    {
        $this->db = new Database();
        $this->db->select()->from('filmai')->where('id', $id);
        $filmai = $this->db->get();
        $this->id = $filmai->id;
        $this->title = $filmai->name;
        $this->image = $filmai->img;
        $this->amziausgrupe = $filmai->amziausgrupe;
        $this->active = $filmai->active;
        return $this;
    }


    public function update()
    {
        $this->db = new Database();
        $setContent = "name = '$this->name', img = '$this->image', amziausgrupe = '$this->amziausgrupe'";
        $this->db->update('filmai', $setContent)->where('id', $this->id);
        $this->db->get();
    }


    public function create()
    {
        $this->db = new Database();
        $tableFields = "name, amziausgrupe, img, ";
        $values = "'".$this->name."','".$this->amziausgrupe."','".$this->image."','".$this->active."'";
        $this->db->insert('filmai', $tableFields, $values);
        $this->db->get();
    }


    public function removeRecord($id) {
        $this->db = new Database();
        $this->db->delete()->from('filmai')->where('id', $id);
        return $this->db->get();
    }

    public function save($id = null)
    {
        if($this->id){
            $this->update();
        }else{
            $this->create();
        }
    }
        //  $this->title



    public function delete($id)
    {
        $setContent = "active = 0";
        $this->db->update('filmai', $setContent)->where('id',$id);
        $this->db->get();
    }
}

