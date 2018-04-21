<?php
include("controller.php");
function signin(){
    $error = isset($_SESSION["error"])?$_SESSION["error"]:"";
    unset($_SESSION["error"]);
    return [
        'view' => 'authSignin.php',
        'data'=>[
            "error"=>$error
        ]
    ];
}
function login(){
    $error = isset($_SESSION["error"])?$_SESSION["error"]:"";
    unset($_SESSION["error"]);
    return [
        'view' => 'authLogin.php',
        'data'=>[
            "error"=>$error
        ]
    ];
}
function create(){
    if(!isValid($_POST["name"]) || !isValid($_POST["pass"]) || !isValid($_POST["pass2"])){
        $_SESSION["error"] = "Un champ est manquant";
        header("Location: index.php?a=signin&r=auth");
        exit();
    }
    include("models/auth.php");
    $name = $_POST["name"];
    $pass = hash("sha256", $_POST["pass"], false);
    $pass2= hash("sha256", $_POST["pass2"], false);
    $mail = $_POST["email"];
    $connect = connectUser($name, $pass);
    if($connect && $connect !== false){
        $_SESSION["user"] = $connect;
        header("Location: index.php");
//        echo "Vous avez déjà un compte :o";
        exit();
    }
    if($pass!==$pass2){
        $_SESSION["error"] = "Les mots de passes ne sont pas identiques";
        header("Location: index.php?a=signin&r=auth");
    }
    $create = createUser($name, $pass, $mail);
    echo "olala";
    if(!$create || $create === false){
        $_SESSION["error"] = "Une personne existe déjà avec ce nom d'utilisateur";
        header("Location: index.php?a=signin&r=auth");
        exit();
    }
    header('Location: index.php');
    exit();
}
function connect(){
    if(!isValid($_POST["name"]) || !isValid($_POST["pass"])){
        $_SESSION["error"] = "Un champ est manquant";
        header("Location: index.php?a=login&r=auth");
        exit();
    }
    include("models/auth.php");
    $name = $_POST["name"];
    $pass = hash("sha256",$_POST["pass"], false);
    $connect = connectUser($name, $pass);
    if(!$connect || $connect === false){
        $_SESSION["error"] = "Nous n'avons pas pû vous connecter";
        header("Location: index.php?a=login&r=auth");
        exit();
    }
    $_SESSION["user"] = $connect;
    header('Location: index.php');
    exit();
}
function disconnect(){
    session_destroy();
    header('Location: index.php');
    exit();
}