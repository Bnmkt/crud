<?php
include_once("controller.php");
function create(){
    if(!isValid($_POST["content"]) || !isValid($_POST["userid"]) || !isValid($_POST["postid"])){
        header("Location: index.php");
        exit();
    }
    include_once("models/comment.php");
    $content = $_POST["content"];
    $user_id = $_POST["userid"];
    $post_id = $_POST["postid"];
    $create = createComments($post_id, $user_id, $content);
    if(!$create || $create === false){
        header("Location: index.php");
        exit();
    }
    header("Location: index.php?a=show&r=post&id=$post_id");
}
function edit(){
    if(!isValid($_GET["id"])){
        header("Location: index.php");
        exit();
    }
    include_once("models/comment.php");
    $id = $_GET["id"];
    $comment = getComment($id);
    return [
        'view' => 'commentEdit.php',
        'data' => ['pageTitle' => 'liste des publications',
            'comment' => $comment]

    ];
}
function update(){
    if(!isValid($_POST["id"])){
        header("Location: index.php");
        exit();
    }
    include_once("models/comment.php");
    $id = $_POST["id"];
    $postid = $_POST["postid"];
    $content = $_POST["content"];
    updateComment($id, $content);
    header("Location: index.php?a=show&r=post&id=$postid");
}
function destroy(){
    if(!isValid($_GET["id"])){
        header("Location: index.php");
        exit();
    }
    include 'models/comment.php';
    $id = $_GET["id"];
    deleteComment($id);
    header("Location: index.php");
}