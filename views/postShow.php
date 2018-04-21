<div>
    <h1>
        <?= $data["data"]["post"] -> title; ?>
    </h1>
    <p><a href="index.php?a=edit&r=post&id=<?= $data["data"]["post"]->id ?>">Modifier le post</a> - <a href="index.php?a=destroy&r=post&id=<?= $data["data"]["post"]->id ?>">Supprimer le post</a></p>
    <div>
        <p>
            <?= $data["data"]["post"] -> body; ?>
        </p>
    </div>
</div>