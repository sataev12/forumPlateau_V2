<?php
    $category = $result["data"]['categorie']; 
    $topics = $result["data"]['sujets'];
?>

<h1>Liste des sujets</h1>

<?php
foreach($topics as $topic ){ ?>
    <p><a href="index.php?ctrl=message&action=listMessageBySujet&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getTitre() ?>  </p>
<?php }
