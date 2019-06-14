
<!--subscribeView-->
<?php $title = 'INSCRIPTION | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
    <div>
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
    <?php
            if(isset($errorMessage))
            {
                echo $errorMessage;
            }
        ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 