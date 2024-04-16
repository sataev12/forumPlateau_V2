<?php
    $messages = $result["data"]['messages'];
?>

<h1>Liste des messages</h1>

<?php
foreach($messages as $message ){ ?>
    <p><?= $message->getTexte() ?></p>
<?php }
