<?php
    $messages = $result["data"]['messages'];
    $sujet = $result["data"]["sujet"];
    
?>

<h1>Liste des messages du sujet <?= $sujet->getTitre() ?></h1>
<?php
foreach($messages as $message ){ ?>
    <p><?= $message->getTexte() ?> </p>
<?php } ?>

<h2>Ajouter un message</h2>

<form action="index.php?ctrl=message&action=ajoutMessage&id=<?= $sujet->getId() ?>" method="post">
    <label for="message">Message</label>
    <textarea name="texte" rows="9" cols="50" ></textarea>
    
    <input type="submit" name="submit" value="Envoyer">
</form>
