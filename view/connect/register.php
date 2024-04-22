<h1>S'inscrire</h1>
    <form action="index.php?ctrl=security&action=register" method="post">
        <!-- Index.php?ctrl="le controlleur que je cible , action et ensuite la methode qu'on cible -->
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudonyme" id="pseudonyme"><br>

        <label for="email">Mail</label>
        <input type="email" name="email" id="email"><br>

        <label for="motDePasse">Mot de passe</label>
        <input type="password" name="motDePasse" id="motDePasse"><br>

        <label for="motDePasse2">Confirmation du mot de passe</label>
        <input type="password" name="motDePasse2" id="motDePasse2"><br>

        <input type="submit" name="submit" value="S'enregistrer">
    </form>