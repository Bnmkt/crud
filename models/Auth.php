<?php
namespace Blog\Models;

include_once "Model.php";
class Auth extends Model{
    function createUser($name, $password, $email){
        $cx = $this->getConnectionToDb();
        $sql = 'INSERT INTO users (name, password, email) VALUES (:name, :password, :email)';
        try{
            $usr = $cx->prepare($sql);
            $usr->execute([':name'=>$name, ':password'=>$password, ':email'=>$email]);
            return $cx->lastInsertId();
        }Catch (PDOException $e ){
            return false;
        }
    }
    function connectUser($name, $password){
        $cx = $this->getConnectionToDb();
        $sql = 'SELECT id, name FROM users WHERE (name = :name OR email = :name) AND password = :password';
        try{
            $usr = $cx->prepare($sql);
            $usr->execute([':name'=>$name, ':password'=>$password]);
            return $usr->fetch();
        }Catch (PDOException $e ){
            return $e;
        }
    }
}