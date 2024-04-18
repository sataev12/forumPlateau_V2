<?php
    $topics = $result["data"]['sujets'];
?>

<h1>Liste des sujets</h1>

<?php
foreach($topics as $topic ){ ?>
    <p> <?= $topic->getTitre() ?> 
        <a href="index.php?ctrl=sujet&action=supprimerSujet&id=<?= $topic->getId() ?>">Supprimer</a> 
        <a href="index.php?ctrl=sujet&action=modifierSujetForm&id=<?= $topic->getId() ?>">Modifier</a>
    </p>
    
<?php }