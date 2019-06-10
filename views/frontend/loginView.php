<?php

echo'LA PAGE DE CONNEXION Login';

?>
<!--loginView-->
<?php $title = 'CONNEXION | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
    <div>
        <h2>CONNEXION</h2>
    </div>
    <div>
        <section>
            <form action="index.php?action=connect" method="post">
                <label for="login">Entrer votre nom d'utilisateur</label>
                <input type="text" name="login" id="login" placeholder="Nom d'utilisateur" />

                <label for="pass">Entrer votre mot de passe</label>
                <input type="password" name="pass" id="pass" placeholder="Mot de passe" />

                <input type="submit" name="submit" value="se connecter" />
            </form>
            <div>
                <p><a href=#>Mot de passe oublié ?</a></p>
                <p><a href="index.php?action=subscribe">S'incrire</a></p> 
            </div>
        </section>
    </div> 

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 
