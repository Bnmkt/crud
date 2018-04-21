<div>
    <h1>La liste des posts</h1>
    <ol>
        <?php if (!empty($data['data']['posts'])) {
            foreach ($data['data']['posts'] as $post): ; ?>
            <li>
                <h2>
                    <a href="/index.php?a=show&r=post&id=<?= $post -> id; ?>"><?= $post -> title ?></a>
                </h2>
            </li>
            <?php endforeach;
        } ?>
    </ol>
</div>
<div>
    <a href="?a=create&r=post">Crée un post</a>
</div>
