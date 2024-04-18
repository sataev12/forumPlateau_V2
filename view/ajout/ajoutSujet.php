<?php
    $categorie = $result["data"]['categorie'];
    //£var_dump($categorie); die; 
    $utilisateurs = $result["data"]["utilisateurs"];
?>
<h1>Ajouter le sujet</h1>
<form action="index.php?ctrl=sujet&action=ajoutSujetAct&id=<?= $categorie->getId() ?>" method="post">
    <label for="nom">
        Titre :
        <input type="text" name="nom" placeholder="titre">
    </label>
    
    <label for="utilisateur">
        Utilisateur :
        <select name="utilisateur">
            <?php foreach($utilisateurs as $utilisateur) { ?>
                <option value=" <?= $utilisateur->getId() ?>"><?= $utilisateur->getPseudonyme() ?></option>
            <?php } ?>
        </select>
    </label>
    

    <input type="submit" name="submit" value="envoyer">
</form>  