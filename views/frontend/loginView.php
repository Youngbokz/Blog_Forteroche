<?php

echo'LA PAGE DE CONNEXION Login';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONNEXION</title>
</head>
<body>
    <header>
        <div> <!--Menu-->
            <a href="homeView.php">ACCUEIL</a>
            <a href="listPostsView.php">ROMAN</a>
            <a href="aboutme.html">À PROPOS</a>
        </div>
        <h1>FORTEROCHE Jean Blog</h1>
        <div>
            <a href="loginView.php">CONNEXION</a>
            <a href="subscribeView.php">INSCRIPTION</a>
        </div>
    </header>
    <div>
        <section>
            <form action="" method="post">
                <label for="login">Entrer votre nom d'utilisateur</label>
                <input type="text" name="login" id="login" placeholder="Nom d'utilisateur" required />

                <label for="pass">Entrer votre mot de passe</label>
                <input type="password" name="pass" id="pass" placeholder="Mot de passe" required />

                <input type="submit" value="se connecter" />
            </form>
        </section>
    </div> 
</body>
</html>