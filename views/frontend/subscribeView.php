<?php

echo'LA PAGE D\'INSCRIPTION subscribe';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSCRIPTION</title>
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
                <label for="username">Choisir un pseudo</label>
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required />

                <label for="pass">Choisir un mot de passe</label>
                <input type="password" name="pass" id="pass" placeholder="Mot de passe" required />

                <label for="re_pass">Confirmation du mot de passe</label>
                <input type="password" name="re_pass" id="re_pass" placeholder="Mot de passe" required />

                <input type="submit" value="Inscription" />
            </form>
        </section>
    </div> 
</body>
</html>