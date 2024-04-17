<?php
    $categories = $result["data"]["categories"];
    var_dump($categories->getId());
?>
<h1>Modifier la categorie</h1>
<form action="index.php?ctrl=categorie&action=modifierCategorieAct&id=<?= $categories->getId() ?>" method="post">

    <label for="Nom">Nom :</label>
    <input type="text" name="nom" value="<?= $categories->getNom() ?>"><br>

    <input type="submit" name="submit" value="modifie">
</form>    