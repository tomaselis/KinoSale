<?php

namespace App\Model;

use Core\Database;

class UsersModel
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role_id;
    private $active;
    private $token;
    private $tries_to_login;

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getTriesToLogin()
    {
        return $this->tries_to_login;
    }

    public function setTriesToLogin($tries_to_login)
    {
        $this->tries_to_login = $tries_to_login;
    }

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRoleId()
    {
        return $this->role_id;
    }

    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function save($id = null)
    {
        if ($id !== null) {
            $this->id = $id;
        } else {
            $this->create();
        }
    }

    public function create()
    {
        $fields = 'name, email, password, role_id';
        $values = "'" . $this->name . "','" . $this->email . "','" . $this->password . "','" . $this->role_id . "'";
        $this->db->insert('users', $fields, $values);
        return $this->db->get();
    }

    public static function verification($email, $password)
    {
        $db = new Database();
        $db->select()->from('users')
            ->where('email', $email)
            ->andWhere('password', $password)
            ->andWhere('active', 1);
        return $db->get();
    }

    public function delete()
    {
        $db = new Database();
        $setContent = "active = 0";
        $db->update('user', $setContent)
            ->where('id', $this->id);
        $db->get();
    }

    public function load($id)
    {
        $this->db->select()->from('users')->where('id', $id);
        $user = $this->db->get();
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->role_id = $user->role_id;
        $this->token = $user->token;
        $this->tries_to_login = $user->tries_to_login;
        return $this;
    }
    public function loadByEmail($email)
    {
        $this->db->select('id')->from('users')->where('email', $email);
        $user = $this->db->get();
        $this->load($user->id);
    }


}