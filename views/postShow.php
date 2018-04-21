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
    <div>
        <?php if(isset($_SESSION["user"])): ?>
        Commentaires :
        <form action="index.php" method="post">
            <p>Créer un commentaire&nbsp;:</p>
            <label for="content"></label><textarea name="content" id="content" cols="30" rows="10"></textarea>
            <input type="hidden" name="a" value="create">
            <input type="hidden" name="r" value="comment">
            <input type="hidden" name="userid" value="<?= $_SESSION["user"]->id ?>">
            <input type="hidden" name="postid" value="<?= $_GET["id"] ?>">
            <input type="submit" name="submit" value="envoyer">
        </form>
        <?php endif; ?>
        <?php if (!empty($data['data']['comments'])) {
            foreach ($data['data']['comments'] as $comment): ; ?>
                <div>
                    <h2>commentaire très instructif de <?= $comment->username ?></h2>
                    <p>
                        le <?= $comment->date ?>
                        <?php if(isset($_SESSION["user"]) && $_SESSION["user"]->id===$comment->userId): ?>
                        - <a href="index.php?a=edit&r=comment&id=<?= $comment->id ?>">Modifier</a>
                        - <a href="index.php?a=destroy&r=comment&id=<?= $comment->id ?>">Supprimer</a>
                        <?php endif; ?>
                    </p>
                    <p><?= $comment->content ?></p>
                </div>
            <?php endforeach;
        } ?>
    </div>
</div>