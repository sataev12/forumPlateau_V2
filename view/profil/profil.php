<?php 
   ?> <h1>Mes sujets</h1> <?php
    $sujets = $result["data"]["sujets"];
    foreach($sujets as $sujet) { ?>
        <tr>
            <td>
                <a href="">
                        <?= $sujet->getTitre() ?>
                </a>
            </td>
            <td>
                    <?php if($sujet->getVerouillee() !== 1) { ?>
                        <button><a href="index.php?ctrl=sujet&action=verouillerSujet&id=<?= $sujet->getId() ?>">Verouiller</a></button>
                    <?php } else {
                        echo "Sujet verouillée";
                    ?>    
                        <button><a href="index.php?ctrl=sujet&action=deverouillerSujet&id=<?= $sujet->getId() ?>">Deverouiller</a></button>
                    <?php } ?>
                    
                    <!-- Possibiliter modifier et supprimer si vous êtes un auteur de sujet -->
                    <button><a href="index.php?ctrl=sujet&action=modifierSujetForm&id=<?= $sujet->getId() ?>">Modifier</a></button>
                    <button><a href="index.php?ctrl=sujet&action=supprimerSujet&id=<?= $sujet->getId() ?>">Supprimer</a></button>
            </td>
        </tr>
   <?php }  
?>
    <h1>Mes messages</h1>
    <?php 
        $messages = $result["data"]["message"];

        foreach($messages as $message) { ?>
            <?= $message->getTexte(); ?> 
            <!-- Possibiliter modifier et supprimer si vous êtes un auteur de sujet -->
            <button><a href="index.php?ctrl=message&action=modifierMsgByUserForm&id=<?= $message->getId() ?>">Modifier</a></button>
            <button><a href="index.php?ctrl=message&action=supprimerMessage&id=<?= $message->getId() ?>">Supprimer</a></button><br>
    <?php } ?>
    


