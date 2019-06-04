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
        elseif($_GET['action'] == "listPosts")
        {
            listPosts();
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
    require('view/errorView.php');
}