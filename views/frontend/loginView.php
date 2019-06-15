<?php
session_start()
?>
<!--loginView-->
<?php $title = 'CONNEXION | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
    <div class="mainSection">
        <div class="loginContainer container ">
            <section class="row">
                <form class="form-signin" action="index.php?action=connect" method="post">
                    <h1 class="h3 mb-3 font-weight-normal">CONNEXION</h1>
                    <label for="login" class="sr-only">Entrer votre nom d'utilisateur</label>
                    <input type="text" id="login" name="login" class="form-control" placeholder="Nom d'utilisateur" required="" autofocus="">
                    <label for="pass" class="sr-only">Entrer votre mot de passe</label>
                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Mot de passe" required="">
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> se souvenir de moi
                        </label>
                    </div>
                    <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Se connecter">
                    <p class="mt-5 mb-3 text-muted">© 2018-2019</p>
                </form>
            </section>
        </div> 
    </div>

    

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 
