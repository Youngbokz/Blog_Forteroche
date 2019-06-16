<?php
require('controller/frontend.php');
try //
{
    if(isset($_GET['action']))
    { // We check if there's action in URL. Both case we send to home page
        //--------------------------------------------------------------------------------------->
        //ADMINISTRATEUR (ADMIN) PAGE DISPLAY
        if($_GET['action'] == "admin")
        {
            require('views/frontend/adminView.php');
        }

        //--------------------------------------------------------------------------------------->
        //ACCUEIL (HOME) PAGE DISPLAY

        if($_GET['action'] == "home")
        {
            lastPost();
        }
        //--------------------------------------------------------------------------------------->
        //ROMAN PAGE DISPLAY
    
        elseif($_GET['action'] == "listPosts") // This action send us to listPostsView = Roman
        {
            listPosts();
        }
        //--------------------------------------------------------------------------------------->
        //SE CONNECTER (LOGIN) PAGE DISPLAY

        elseif($_GET['action'] == "login") // This action send us to loginView 
        {
            require('views/frontend/loginView.php');
        }
        //--------------------------------------------------------------------------------------->
        //S'INSCRIRE (SUBSCRIBE) PAGE DISPLAY

        elseif($_GET['action'] == "subscribe") // This action send us to loginView 
        {
            require('views/frontend/subscribeView.php');
        }
        //--------------------------------------------------------------------------------------->
        //SUBMIT IN SUBSCRIBE PAGE 

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
                                    subscribe($username, $pass);
                                    echo '<font color="green">Vous êtes enregistré(e), vous pouvez vous connecter!</font>';
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
                echo'<p>Formulaire n\'a pas été envoyé</p>';
            }
        }
        //--------------------------------------------------------------------------------------->
        //A POST DISPLAY

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
        //--------------------------------------------------------------------------------------->
        //SUBMIT IN LOGIN PAGE 

        elseif($_GET['action'] == 'connect')
        {
            if(isset($_POST['submit']))
            {
                // Add var
                $loginConnex = htmlspecialchars($_POST['login']);
                $passConnex = htmlspecialchars($_POST['pass']);

                if(!empty($loginConnex) AND !empty($passConnex))
                {
                    $verifyLogin = verifyConnection($loginConnex, $passConnex);

                     // Check if password in match with the one in database
                    if($verifyLogin == 1)
                    {
                        session_start();
                        $result = member($loginConnex);
                        $_SESSION['login'] = $result['log'];
                        $_SESSION['id'] = $result['id'];
                        $_SESSION['registration_date'] = $result['registration_date_fr'];

                        echo 'Coucou ' . $result['log'] . '! ';
                        echo'<font color="green">Vous êtes bien connecté !</font>';
                        header('location: index.php?action=home');
                    }
                    else
                    {
                        echo'Mauvais mot de passe ou pseudo inconnue';
                    }
                }
                else
                {
                    echo'Veuillez renseignez tout les champs';
                }
            }
            else
            {
                echo'<p>Formulaire n\'a pas été envoyé</p>';
            }
        }
        //--------------------------------------------------------------------------------------->
        //DISCONNECT PAGE DISPLAY

        elseif($_GET['action'] == "disconnect")
        {
            require('views/frontend/disconnectView.php');
        }
        //--------------------------------------------------------------------------------------->
        //A POST PAGE SEND A COMMENT

        elseif($_GET['action'] == "sendComment")
        {
            if(isset($_POST['submit']))
            {
                // add var
                $login = htmlspecialchars($_POST['login']);
                $newMessage = htmlspecialchars($_POST['story']);
                $post_Id = $_GET['id'];
                

                if(isset($post_Id) AND $post_Id > 0)
                {
                    if(!empty($login) AND !empty($newMessage))
                    {

                        newComment($post_Id, $login, $newMessage);
                    }
                    else
                    {
                        echo'<p>Veuillez renseigner votre identifiant et un message à envoyer</p>';
                    }
                }
                else
                {
                    echo'<p>Aucun identifiant de chapitre envoyé</p>';
                }
            }
            else
            {
                echo'<p>Formulaire n\'a pas été envoyé</p>';
            }
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN ADD A POST
        if(isset($_GET['addpost']))
        {

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