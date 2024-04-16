<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Liste des catégories</h1>

<?php
foreach($categories as $category ){ ?>
    <p>
        <a href="index.php?ctrl=sujet&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getNom() ?>  
        <a href="index.php?ctrl=categorie&action=supprimerCategorie&id=<?= $category->getId() ?>"> Supprimer </a> 
        <a href="index.php?ctrl=categorie&action=modifierCategorie&id=<?= $category->getId() ?>">Modifier</a> </a>
    </p>
<?php }

