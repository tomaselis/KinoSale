<?php


namespace Core;
use PDO;
use PDOException;

class Database
{
    private $pdo;
    private $sql='';

    public function connect(){ //klase atsakinga uz darba su duomenu baze
        $host = '127.0.0.1';
        $db = 'Blog';
        $user = 'tomaselis';
        $password = '123P3tr4s123!';
        $pdo = null;
        try {
            $pdo = new \PDO("mysql:host=$host; dbname=$db; charset=utf8", $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            //return false;
        }
        $this->pdo = $pdo;
    }
    public function select($fields = '*') //pasirenkam ka selectinsim
    {
        $this->sql .='SELECT '.$fields;
        return $this;
    }

    public function from($table)
    {
        $this->sql .= ' FROM '.$table;
        return $this;
    }

    public function where($fieldName, $value)
    {
        $this->sql .= ' WHERE ' . $fieldName . '=' . "'$value'";
        return $this;
    }

    public function whereLike($fieldName, $value)
    {
        $this->sql .= ' WHERE ' . $fieldName . ' LIKE' . "'%$value%'";
        return $this;
    }

    public function insert($tableName, $tableFields, $values){
        $this->sql .= "INSERT INTO ".$tableName." (".$tableFields.")"." VALUES "."(".$values.")";
        return $this;
    }

    public function update($tableName, $setContent){
        $this->sql .= "UPDATE $tableName SET $setContent";
        return $this;
    }
    public function set($fieldName, $value){
        $this->sql .= ' SET '.$fieldName.' = '.$value;
        return $this;
    }
    public function andWhere($fieldName, $value){
        $this->sql .= " AND $fieldName = '$value'";
        return $this;
    }
    public function delete(){
        $this->sql .= 'DELETE ';
        return $this;
    }

    public function execute(){
        $this->connect();
        $sql = $this->sql;
        $stmt = $this->pdo->prepare($sql);
//        print_r($sql);
        $stmt->execute();
        $this->sql = '';
        return $stmt;
    }


    public function getAll(){
        $stmt = $this->execute();
        $data = [];
        while($row = $stmt->fetchObject()){
            $data[] = $row;
        }
        return $data;
//        $stmt = $this->execute();
//        $data = [];
//        while ($row = $stmt->fetchObject()){
//            $data[] = $row;
//        }
//        return $data;
    }

    public function get(){
        $stmt =$this->execute();
        return $stmt->fetchObject();

        // atsirado po penktadienio
        $this->sql = '';
        return $stmt;
    }
}