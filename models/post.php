<?php
include 'model.php';

function getPosts()
{
    $cx = getConnectionToDb();
    $sql = 'SELECT * FROM blog.posts';
    $pst = $cx->query($sql);
    return $pst->fetchAll();
}

function getPost($id)
{
    $cx = getConnectionToDb();
    $sql = 'SELECT * FROM posts WHERE id = :id';
    $pst = $cx->prepare($sql);
    $pst->execute([':id' => $id]);
    return $pst->fetch();
}

function createPost($title, $body)
{
    $cx = getConnectionToDb();
    $sql = 'INSERT INTO posts (title, body) VALUES (:title, :body)';
    $pst = $cx->prepare($sql);
    $pst->execute([':title'=>$title, ':body'=>$body]);
    return $cx->lastInsertId();
}
function updatePost($id, $title, $body)
{
    $cx = getConnectionToDb();
    $sql = 'UPDATE posts SET title = :title, body = :body WHERE id = :id';
    $pst = $cx->prepare($sql);
    $pst->execute([':title'=>$title, ':body'=>$body, ':id'=>$id]);
    return true;
}
function deletePost($id){
    $cx = getConnectionToDb();
    $sql = 'DELETE FROM posts WHERE id=:id';
    $pst = $cx->prepare($sql);
    $pst->execute([':id'=>$id]);
    return true;
}