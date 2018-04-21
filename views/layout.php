<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon blog</title>
    <style>
        label{
            display: block;
        }
    </style>
</head>
<body>
<div>
    finir système utilisateur
    ajout d'un système de commentaire
    les utilisateurs loggué peuvent ajouter des commentaires
</div>
<div><?php if(isset($_SESSION["user"])): ?>
    <?= $_SESSION["user"]->name; ?>
<?php endif; ?>
</div>
<div>
    <a href="index.php">Retour à l'index</a> -
    <?php if(isset($_SESSION["user"])): ?>
    <a href="index.php?a=disconnect&r=auth">Se déconnecter</a>
    <?php else: ?>
    <a href="index.php?a=login&r=auth">Se connecter</a> -
    <a href="index.php?a=signin&r=auth">S'inscrire</a>
    <?php endif; ?>
</div>
<?php include $data['view']; ?>
</body>
</html>