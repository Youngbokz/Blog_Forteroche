<?php
require('controller/frontend.php');
try //
{
    if(isset($_GET['action']))
    { // We check if there's action in URL. Both case we send to home page
        if($_GET['action'] == "home")
        {
            lastPost();
        }
        elseif($_GET['action'] == "listPosts") // This action send us to listPostsView = Roman
        {
            listPosts();
        }
        elseif($_GET['action'] == "login") // This action send us to loginView 
        {
            require('views/frontend/loginView.php');
        }
        elseif($_GET['action'] == "subscribe") // This action send us to loginView 
        {
            //Check if submit 
            if(isset($_POST['submit'])) 
            {
                //Declare all variables with security
                $username = htmlspecialchars($_POST['username']);
                $pass = htmlspecialchars($_POST['pass']);
                $re_pass = htmlspecialchars($_POST['re_pass']);
                

                //Check out if inputs are not empty 
                if(!empty($username) AND
                    !empty($pass) AND
                    !empty($re_pass))
                {
                    // Check out if login respect rules
                    if(preg_match('#^[a-zA-Z0-9_]{3,16}$#i', ($username)))
                    {   
                        // Check if login is already used in database
                        $verifyPseudo = $bdd->prepare('SELECT * FROM member WHERE pseudo = ?');
                        $verifyPseudo->execute(array($pseudo));
                        $pseudoExist = $verifyPseudo->rowCount();
                        if($pseudoExist == 0)
                        {
                            // Check out passwords
                            if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$#', ($pass)))
                            {   // Check if passwords are the same
                                if(($pass) == ($re_pass))
                                {   
                                    // Check if email is already used
                                    $verifyEmail = $bdd->prepare('SELECT * FROM member WHERE email = ?');
                                    $verifyEmail->execute(array($email));
                                    $emailExist = $verifyEmail->rowCount();
                                    if($emailExist == 0)
                                    {
                                        // Check out if it s not an email 
                                        if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i', ($email)))
                                        {
                                            $error = '<font color="red">Veuillez entrer un format email valide</font>';
                                        }//--------------------- END OF if email
                                        else // if it is we insert data into base
                                        {   
                                            // Encrypt password
                                            $pass_hache = password_hash($pass, PASSWORD_DEFAULT);
                                            // Insertion 
                                            $req = $bdd->prepare('INSERT INTO member(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
                                            $req->execute(array(
                                            'pseudo' => $pseudo,
                                            'pass' => $pass_hache,
                                            'email' => $email)); 
                                            echo '<font color="green">Vous êtes enregistré(e)</font>';   

                                            $req->closeCursor();
                                        }//--------------------- END OF else email
                                    }//--------------------- END OF if emailExist
                                    else
                                    {
                                        $error = '<font color="orange">Email déjà utilisé</font>
                                        <p>Prendre un autre email ou <a href="connexion.php">Connectez-Vous !</a></p>
                                        <p><a href="index.php">Revenir à la page d\'accueil</a></p>';
                                    }//--------------------- END OF else emailExist
                                }//--------------------- END OF if password compare
                                else
                                {
                                    $error ='<font color="red">Mots de passe non similaires</font>';
                                }//--------------------- END OF else password compare
                            }//--------------------- END OF if password
                            else
                            {
                                $error = '<font color="red">Mot de passe 8 caractères minimum avec au moins 1 minuscule, 1 majuscule et 1 chiffre</font>';
                            }//--------------------- END OF else password
                        }//--------------------- END OF if pseudoExist
                        else
                        {
                            $error= '<font color="purple">Pseudo déjà utilisé !</font> 
                                    <p>Prendre un autre pseudo ou <a href="connexion.php">Connectez-Vous !</a></p>
                                    <p><a href="index.php">Revenir à la page d\'accueil</a></p>';
                        }//--------------------- END OF else pseudoExist
                    }//--------------------- END OF if pseudo
                    else
                    {
                        $error = '<font color="red">Votre pseudo doit contenir 3 caractères minimum de lettre miniscules ou/et majuscules ou/et chiffres ou/et _</font>';
                    }//--------------------- END OF else pseudo
                    
                }//--------------------- END OF if !empty()
                else
                {
                    $error = '<font color="red">Veuillez renseigner tout les champs</font>';
                }//--------------------- END OF else empty()
            }//--------------------- END OF if submit
            else
            {
                $error = '<p><a href="index.php">Revenir à la page d\'accueil</a></p>';
            }
        }
        elseif($_GET['action'] == 'post')
        {
            if(isset($_GET['id']) && $_GET['id'] >0)
            {
                post();
            }
            else 
            {
                throw new Exception('Erreur : aucun identifiant de post envoyé'); // Error message
            }
        }
    
    }
    else // Even in this case display home page 
    {
        lastPost();
    }  
}
catch(Exception $e)
{
    $errorMessage = $e->getMessage();
    require('views/errorView.php');
}