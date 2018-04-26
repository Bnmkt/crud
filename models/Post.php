<?php
namespace Blog\Models;

include_once 'Model.php';
class Post extends Model{

    function getPosts()
    {
        $cx = $this->getConnectionToDb();
        $sql = 'SELECT u.name AS username, p.id, p.title, p.body, p.featured, p.date FROM posts AS p JOIN users u WHERE user_id = u.id ORDER BY id DESC';
        $pst = $cx->query($sql);
        return $pst->fetchAll();
    }

    function getFeaturedPosts()
    {
        $cx = $this->getConnectionToDb();
        $sql = 'SELECT u.name AS username, p.id, p.title, p.body, p.featured, p.date FROM posts AS p JOIN users u WHERE user_id = u.id AND p.featured = 1 ORDER BY id DESC LIMIT 3';
        $pst = $cx->query($sql);
        return $pst->fetchAll();
    }

    function getPost($id)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'SELECT u.name AS username, p.id, p.title, p.body, p.featured, p.date FROM posts AS p JOIN users u ON user_id = u.id WHERE p.id = :id ORDER BY id DESC';
        $pst = $cx->prepare($sql);
        $pst->execute([':id' => $id]);
        return $pst->fetch();
    }

    function createPost($title, $body, $user_id)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'INSERT INTO posts (`title`, `body`, `date`, `user_id`) VALUES (:title, :body, NOW(), :uid)';
        $pst = $cx->prepare($sql);
        $pst->execute([':title'=>$title, ':body'=>$body, ':uid'=>$user_id]);
        return $cx->lastInsertId();
    }
    function updatePost($id, $title, $body)
    {
        $cx = $this->getConnectionToDb();
        $sql = 'UPDATE posts SET title = :title, body = :body WHERE id = :id';
        $pst = $cx->prepare($sql);
        $pst->execute([':title'=>$title, ':body'=>$body, ':id'=>$id]);
        return true;
    }
    function deletePost($id){
        $cx = $this->getConnectionToDb();
        $sql = 'DELETE FROM posts WHERE id=:id';
        $pst = $cx->prepare($sql);
        $pst->execute([':id'=>$id]);
        return true;
    }
}