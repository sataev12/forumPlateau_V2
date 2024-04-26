<?php 
    
    $sujets = $result["data"]["sujets"];
    foreach($sujets as $sujet) { ?>
        <tr>
            <td>
                <a href="">
                        <?= $sujet->getTitre() ?>
                </a>
            </td>
            <td>
                <form action="index.php?ctrl=sujet&action=verouillerSujet&id=<? $sujet->getId() ?>" method="post">
                    <input type="button" name="submit" value="verouller">
                    <?= $sujet->getVerouillee() ?>
                </form>
            </td>
        </tr>
            
        
   <?php } 
?>
<h1>Mes sujets</h1>

