<?php
/****************************************VIEWS/FRONTEND/SUBSCRIBEVIEW.PHP****************************************/
session_start()
?>
<?php $title = 'INSCRIPTION | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
    <div class="mainSection">
        <div class="subscribeContainer container ">
            <section class="row">
                <form class="form-signin" action="index.php?action=register" method="post">
                    <h1 class="h3 mb-3 font-weight-normal">INSCRIPTION</h1>
                    <label for="username" >Choisir nom d'utilisateur</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Nom d'utilisateur" required="" autofocus="">
                    <label for="pass" >Choisir mot de passe</label>
                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Mot de passe" required="">
                    <label for="re_pass" >Confirmer mot de passe</label>
                    <input type="password" id="re_pass" name="re_pass" class="form-control" placeholder="Mot de passe" required="">
                    
                    <input class="btn btn-lg btn-dark btn-block" type="submit" name="submit" value="S'inscrire">
                    <div>
                        <a href="index.php?action=login"><p>Déjà enregistré ?</p></a>
                    </div>
                    <p class="mt-5 mb-3 text-muted">© 2018-2019</p>
                </form>
            </section>
        </div> 
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 