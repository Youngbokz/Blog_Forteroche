
<!--subscribeView-->
<?php $title = 'INSCRIPTION | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
    <div class="mainSection">
        <div>
            <h2>INSCRIPTION</h2>
        </div>
        <div>
            <section>
                <form action="index.php?action=register" method="post">
                    <label for="username">Choisir un pseudo</label>
                    <input type="text" name="username" id="username" placeholder="Nom d'utilisateur"  />

                    <label for="pass">Choisir un mot de passe</label>
                    <input type="password" name="pass" id="pass" placeholder="Mot de passe"  />

                    <label for="re_pass">Confirmation du mot de passe</label>
                    <input type="password" name="re_pass" id="re_pass" placeholder="Mot de passe"  />

                    <input type="submit" name="submit" value="Inscription" />
                </form>
            </section>
        </div> 
    <div>
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
                    
                    <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="S'inscrire">
                    <p class="mt-5 mb-3 text-muted">© 2018-2019</p>
                </form>
            </section>
        </div> 
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 