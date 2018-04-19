<div>
    <h1>Hallo Edit</h1>
    <form method="post" action="index.php">
        <label for="title">Titre</label>
        <input id="title" name="title" type="text" value="Post 1">
        <label for="body">Text</label>
        <textarea id="body" name="body">Le texte du Post 1</textarea>
        <input type="submit" value="Mettre à jour cet article">
        <input type="hidden" name="a" value="update">
        <input type="hidden" name="r" value="post">
        <input type="hidden" name="id" value="1">
    </form>
</div>