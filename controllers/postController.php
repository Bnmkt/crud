<?php
// https://laravel.com/docs/5.6/controllers#resource-controllers
// C'est la liste des ressources/post
function index()
{
    include 'models/post.php';
    return [
        $posts = getAllPosts(),
        'view' => 'postIndex.php',
        'data' => ['pageTitle' => 'liste des publications',
            'posts' => $posts]
    ];
}
function create()
{
    return [
        'view' => 'postCreate.php',
        'data' => []
    ];
}
function store()
{
    header('location : index.php?a=show&r=post&id=1');
}
function show($id)
{
    if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) return false;
    $id = $_GET['id'];
    include 'models/post.php';
    $post = getOnePost($id);
    return [
        'view' => 'postShow.php',
        'data' => [
            'pageTitle' => $post->title,
            'post' => $post
        ]
    ];
}
function edit($id)
{
    return [
        'view' => 'postEdit.php',
        'data' => []
    ];
}
function update($id)
{
    header("location : index.php?a=show&r=post&id=$id");
}
function destroy($id)
{
    header('location : index.php?a=index&r=post');
}
