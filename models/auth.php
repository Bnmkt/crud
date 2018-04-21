<?php
include "model.php";
function createUser($name, $password, $email){
    $cx = getConnectionToDb();
    $sql = 'INSERT INTO blog.users (name, password, email) VALUES (:name, :password, :email)';
    try{
        $pst = $cx->prepare($sql);
        $pst->execute([':name'=>$name, ':password'=>$password, ':email'=>$email]);
        return $cx->lastInsertId();
    }Catch (PDOException $e ){
        return false;
    }
}
function connectUser($name, $password){
    $cx = getConnectionToDb();
    $sql = 'SELECT id, name FROM blog.users WHERE (name = :name OR email = :name) AND password = :password';
    try{
        $pst = $cx->prepare($sql);
        $pst->execute([':name'=>$name, ':password'=>$password]);
        return $pst->fetch();
    }Catch (PDOException $e ){
        return $e;
    }
}