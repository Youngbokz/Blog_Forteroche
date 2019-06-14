
<!--loginView-->
<?php $title = 'CONNEXION | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
    <div class="mainSection">
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
    </div>

    <form class="form-signin">
  <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted">© 2017-2019</p>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 
