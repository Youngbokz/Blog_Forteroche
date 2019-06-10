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