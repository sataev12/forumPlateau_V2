<h1>Ajouter un sujet</h1>
<form  class="form-sujet" action="index.php?ctrl=sujet&action=ajoutSujet" method="post">
    <label for="titre">
        Ajouter un titre
        <input type="text" name="titre" placeholder="titre">
    </label>
    <label for="dateCreation">
        La date de creation
        <input type="number" name="AnneSortFr" placeholder="Date de création">
    </label>

    
    
    <input type="submit" name="submit" value="envoyer">
</form>