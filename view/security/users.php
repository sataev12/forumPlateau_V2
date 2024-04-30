<?php
    $utilisateurs = $result["data"]["users"];
?>  

<h1>Les utilisateurs</h1>

<?php foreach($utilisateurs as $utilisateur) { ?>
    <?= $utilisateur->getPseudonyme()?>
    <?php if($utilisateur->getBannir() == "0") { ?>
            <button><a href="index.php?ctrl=security&action=bannir&id=<?= $utilisateur->getId() ?>">Bannir</a></button><br>
    <?php } ?>
    <?php if($utilisateur->getBannir() == "1") { ?> 
        <button><a href="index.php?ctrl=security&action=debloquer&id=<?= $utilisateur->getId() ?>">Debloquer</a></button><br>
    <?php } ?>
    
<?php } ?>

    