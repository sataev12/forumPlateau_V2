<?php
    $sujets = $result["data"]["sujets"];
    $categories = $result["data"]["categories"];
    $utilisateurs = $result["data"]["utilisateurs"];
?>
<h1>Modifier le sujet</h1>
<form action="index.php?ctrl=sujet&action=modifierSujet&id=<?= $sujets->getId() ?>" method="post">

    <label for="Nom">Titre :</label>
    <input type="text" name="titre" value="<?= $sujets->getTitre() ?>">

    <input type="submit" name="submit" value="modifie">
</form>   