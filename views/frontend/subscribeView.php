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
            <a href="index.php?action=home">ACCUEIL</a>
            <a href="index.php?action=listPosts">ROMAN</a>
            <a href="aboutme.html">À PROPOS</a>
        </div>
        <h1>FORTEROCHE Jean Blog</h1>
        <div>
            <a href="index.php?action=login">CONNEXION</a>
            <a href="index.php?action=subscribe">INSCRIPTION</a>
        </div>
    </header>
    <div>
        <h2>INSCRIPTION</h2>
    </div>
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