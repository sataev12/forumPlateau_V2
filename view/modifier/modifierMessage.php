<?php 
    $msgUser = $result["data"]["message"];
    // var_dump($msgUser->getSujet());
?>
<h1>Modifier message d'un utilisateur</h1>

<form action="index.php?ctrl=message&action=ajoutMessageAct&id=<?= $msgUser->getId() ?>" method="post">
    <label for="message">Message</label>
    <textarea name="texte" rows="9" cols="50"><?= $msgUser->getTexte() ?></textarea>
    
    <input type="submit" name="submit" value="Envoyer">
</form>


