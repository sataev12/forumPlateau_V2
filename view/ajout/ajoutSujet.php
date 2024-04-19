<?php
    $categorie = $result["data"]['categorie'];
    // var_dump($utilisateurs); die; 
?>
<h1>Ajouter le sujet</h1>
<form action="index.php?ctrl=sujet&action=ajoutSujetAct&id=<?= $categorie->getId() ?>" method="post">
    <label for="nom">
        Titre :
        <input type="text" name="nom" placeholder="titre">
    </label>
    

    <input type="submit" name="submit" value="envoyer">
</form>  