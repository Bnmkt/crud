<?php
include 'model.php';

function getPosts()
{
    $cx = getConnectionToDb();
    $sql = 'SELECT * FROM posts';
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