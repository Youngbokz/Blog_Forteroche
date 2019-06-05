<?php

echo'LA PAGE DE CONNEXION Login';

?>
<!--loginView-->
<?php $title = 'CONNEXION'; ?>
<?php ob_start(); ?>
<body>
    <header id="main_menu">
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
        <h2>CONNEXION</h2>
    </div>
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

<footer>
    Mentions légales et autres
</footer>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 
