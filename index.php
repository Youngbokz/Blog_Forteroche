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
            require('views/frontend/subscribeView.php');
        }
        elseif($_GET['action'] == "register")
        {
            if(isset ($_POST['submit']))
            {
                // Add var 
                $username =  $_POST['username'];
                $pass =  $_POST['pass'];
                $re_pass =  $_POST['re_pass'];
                if(!empty($username) AND 
                !empty($pass) AND
                !empty($re_pass))
                {
                    if(preg_match('#^[a-zA-Z0-9_]{2,16}$#i', ($username))) // Usrname conditions minimum 2 letters
                    {
                        $verifyUsername = verify($username); // Verify if username exist or not

                        if($verifyUsername == 0) // if log doesnt exist in database
                        {
                            if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$#', ($pass))) //Password must have 1 lower and upper case and a number
                            {
                                if($pass === $re_pass)
                                {
                                    echo'tset ok';
                                }
                                else
                                {
                                    echo'<p>Mot de passe différents</p>';
                                }
                            }
                            else
                            {
                                echo'<p>Mot de passe 8 caractères minimum avec au moins 1 minuscule, 1 majuscule et 1 chiffre</p>';
                            }
                        }
                        else
                        {
                            echo'<p>Le pseudo choisi existe déja (' . $verifyUsername .') en choisir un autre</p>';
                        }
                    }
                    else
                    {
                        echo'<p>Votre pseudo doit comporter au moins 2 lettres</p>';
                    }
                }
                else
                {
                    echo'test';
                }
            }
            else
            {
                $errorMessage = '<p>Formulaire n\'a pas été envoyé</p>';
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