<?php


namespace App\Model;

use Core\Database;

class PostModel
{
    private $id = NULL; //=NULL tada apacioje reiktu apsirasyti kad nelygus NULL
    private $title;
    private $content;
    private $image;
    private $authorId;
    private $db;



    public function __construct()
{
    $this->db = new Database();
}


    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public static function getPosts()
    {
        $db = new Database();
        $db->select()->from('post')->where('active', 1);
        return $db->getAll();
    }

    public function load($id)
    {
        $this->db = new Database();
        $this->db->select()->from('post')->where('id', $id);
        $post = $this->db->get();
        $this->id = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->authorId = $post->author_id;
        $this->image = $post->img;
    }


    public function update()
    {
        $this->db = new Database();
        $setContent = "title = '$this->title', content = '$this->content', img = '$this->image', author_id = '1' ";
        $this->db->update('post', $setContent)->where('id', $this->id);
        $this->db->get();
    }


    public function create()
    {
        $this->db = new Database();
        $tableFields = "title, content, img, author_id";
        $values = "'".$this->title."','".$this->content."','".$this->image."','".$this->authorId."'";
        $this->db->insert('post', $tableFields, $values);
        $this->db->get();
//        $tableFields = "title, content, img, author_id";
//        $values = "'".$this->title."','".$this->content."','".$this->image."','".$this->authorId."'";
//        $this->db = new Database();
//        $this->db->insert('post', $tableFields, $values);
//        return $this->db->get();
    }


    public function removeRecord($id) {
        $this->db = new Database();
        $this->db->delete()->from('post')->where('id', $id);
        return $this->db->get();
    }

    public function save($id = null)
    {
        if($id !== null){
            $this->id = $id;
            $this->update();
        }else{
            $this->create();
        }
    }
        //  $this->title



    public function delete($id)
    {
        $setContent = "active = 0";
        $this->db->update('post', $setContent)->where('id',$id);
        $this->db->get();
    }
}

