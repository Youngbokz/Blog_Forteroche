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