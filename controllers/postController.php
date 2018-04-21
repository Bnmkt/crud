<?php
// https://laravel.com/docs/5.6/controllers#resource-controllers
// C'est la liste des ressources/post
function index()
{
    include 'models/post.php';
    return [
        $posts = getPosts(),
        'view' => 'postIndex.php',
        'data' => ['pageTitle' => 'liste des publications',
            'posts' => $posts]
    ];
}
function create()
{
    return [
        'view' => 'postCreate.php',
    ];
}
function store()
{
    if(!isset($_POST["title"]) || !isset($_POST["body"])){
        header("Location: index.php?a=create&r=post");
        die();
    };
    include 'models/post.php';
    $title = $_POST["title"];
    $body = $_POST["body"];
    $id = createPost($title, $body);
    header("Location: index.php?a=show&r=post&id=$id");
}
function show()
{
    if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) return false;
    $id = $_GET['id'];
    include 'models/post.php';
    $post = getPost($id);
    return [
        'view' => 'postShow.php',
        'data' => [
            'pageTitle' => $post->title,
            'post' => $post
        ]
    ];
}
function edit()
{
    if(!isset($_GET["id"])){
        header("Location: index.php");
        exit();
    }
    $id = $_GET['id'];
    include 'models/post.php';
    $post = getPost($id);
    return [
        'view' => 'postEdit.php',
        'data' => [
            'pageTitle' => $post->title,
            'post' => $post
        ]
    ];
}
function update()
{
    if(!isset($_POST["title"]) || !isset($_POST["body"]) || !isset($_POST["id"])){
        header("Location: index.php");
        die();
    };
    include 'models/post.php';
    $id = $_POST["id"];
    $title = $_POST["title"];
    $body = $_POST["body"];
    updatePost($id, $title, $body);
    header("Location: index.php?a=show&r=post&id=$id");
}
function destroy()
{
    if(!isset($_GET["id"])){
        header("Location: index.php");
        die();
    };
    include 'models/post.php';
    $id = $_GET["id"];
    deletePost($id);
    header("Location: index.php");
}
