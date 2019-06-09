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
        elseif($_GET['action'] == "subscribe")
        {
            require('views/frontend/subscribeView.php');
        }
        elseif($_GET['action'] == "subscribeNewMember") // This action send us to loginView 
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
                        $verifyUsername = verify($username);

                        if($username == 0)
                        {
                            // Check out passwords
                            if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$#', ($pass)))
                            {   // Check if passwords are the same
                                if(($pass) == ($re_pass))
                                {   
                                    subscribe($log, $pass); // so we finaly add the member in database
                                            echo '<font color="green">Vous êtes enregistré(e)</font>';   
                                }//--------------------- END OF compare passwords
                                else
                                {
                                    $errorMessage ='<font color="red">Mots de passe non similaires</font>';
                                }//--------------------- END OF else compare password
                            }//--------------------- END OF if password 
                            else
                            {
                                $errorMessage = '<font color="red">Mot de passe 8 caractères minimum avec au moins 1 minuscule, 1 majuscule et 1 chiffre</font>';
                            }//--------------------- END OF else password post
                        }//--------------------- END OF if username exist
                        else
                        {
                            $errorMessage= '<font color="purple">Pseudo déjà utilisé !</font> 
                                    <p>Prendre un autre pseudo ou <a href="connexion.php">Connectez-Vous !</a></p>
                                    <p><a href="index.php">Revenir à la page d\'accueil</a></p>';
                        }//--------------------- END OF else username exist
                    }//--------------------- END OF if username post
                    else
                    {
                        $errorMessage = '<font color="red">Votre pseudo doit contenir 3 caractères minimum de lettre miniscules ou/et majuscules ou/et chiffres ou/et _</font>';
                    }//--------------------- END OF else username post
                }//--------------------- END OF if !empty
                else
                {
                    $errorMessage = '<font color="red">Veuillez renseigner tout les champs</font>';
                }//--------------------- END OF else !empty              
            }//--------------------- END OF if submit
            else
            {
                $errorMessage = '<p>L\'envoie des données n\'a pas fonctionné. Veuillez réessayer</p>';
            }//--------------------- END OF else submit
        }//--------------------- END OF if subscribe

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