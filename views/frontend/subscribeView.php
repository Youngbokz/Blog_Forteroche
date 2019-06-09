<?php

echo'LA PAGE D\'INSCRIPTION subscribe';

?>
<!--subscribeView-->
<?php $title = 'INSCRIPTION | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
    <div>
        <h2>INSCRIPTION</h2>
    </div>
    <div class="subscribeContainer">
        <section>
            <form action="index.php?action=subscribeNewMember" method="post">
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
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 