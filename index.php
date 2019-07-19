<?php
/****************************************INDEX.PHP****************************************/

// We charge classes 
require_once('controller/BlogController.php');
require_once('controller/CommentController.php');
require_once('controller/MemberController.php');
require_once('controller/PostController.php');

use \Youngbokz\Blog_Forteroche\Controller\BlogController;
use \Youngbokz\Blog_Forteroche\Controller\CommentController;
use \Youngbokz\Blog_Forteroche\Controller\MemberController;
use \Youngbokz\Blog_Forteroche\Controller\PostController;

try //
{
    if(isset($_GET['action']))
    { // We check if there's action in URL. Both case we send to home page
        
        //--------------------------------------------------------------------------------------->
        //ACCUEIL (HOME) PAGE DISPLAY

        if($_GET['action'] == "home")
        {
            $postController = new PostController();
            $postController->lastPostAndComments();
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN DASHBOARD
        elseif($_GET['action'] == "admin")
        {
            $blogController = new BlogController();
            $blogController->adminDashboard();
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN: MEMBERS PAGE
        elseif($_GET['action'] == "adminUsers")
        {
            $memberController = new MemberController();
            $memberController->getMembersAdmin();
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES CREATING CHAPTER PAGE
        elseif($_GET['action'] == "adminCreate")
        {
            $blogController = new BlogController();
            $requirePage = 'views/frontend/adminCreateView.php';
            $blogController->sideNavAdminData($requirePage);
        }
        //--------------------------------------------------------------------------------------->
        //ABOUT ME PAGE
        elseif($_GET['action'] == 'aboutme')
        {
            require('views/frontend/aboutme.php');
        }
        
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES LIST POSTS 
        elseif($_GET['action'] == "adminArticle")
        {
            $postController = new PostController();
            $postController->listPostsAdmin();
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES EDIT PAGE
        elseif($_GET['action'] == 'goEditArticle')
        {
            $postController = new PostController();
            $postController->postEditAdmin();
        }
        
        //--------------------------------------------------------------------------------------->
        //ADMIN EDIT A POST
        elseif($_GET['action'] == "editPost")
        {
            $postController = new PostController();
            $postController->updatePost();
            $postController->erasePost();
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES REPORTED COMENTS PAGE
        elseif($_GET['action'] == "adminCom")
        {
            $commentController = new CommentController();
            $commentController->reportedCommentAdminList();
        }
        //--------------------------------------------------------------------------------------->
        //ROMAN PAGE DISPLAY
    
        elseif($_GET['action'] == "listPosts") // This action send us to listPostsView = Roman
        {
            $postController = new PostController();
            $postController->listPosts();         
        }
        //--------------------------------------------------------------------------------------->
        //SE CONNECTER (LOGIN) PAGE DISPLAY

        elseif($_GET['action'] == "login") // This action send us to loginView 
        {
            require('views/frontend/loginView.php');
        }
        //--------------------------------------------------------------------------------------->
        //DELETE REPORTED COMMENT ADMIN

        elseif($_GET['action'] == "deleteReportedCom") // This action send us to loginView 
        {
            $commentController = new CommentController();
            $commentController->eraseReportedCom(); 
        }
        //--------------------------------------------------------------------------------------->
        //S'INSCRIRE (SUBSCRIBE) PAGE DISPLAY

        elseif($_GET['action'] == "subscribe") // This action send us to loginView 
        { 
            require('views/frontend/subscribeView.php');
        }
        //--------------------------------------------------------------------------------------->
        //REPORT A COMMENT POSTVIEW PAGE

        elseif($_GET['action'] == "reportComment")
        {
            $commentController = new CommentController();
            $commentController->commentStatus();
        }
        //--------------------------------------------------------------------------------------->
        //RESTORE REPORTED COMMENT ADMIN

        elseif($_GET['action'] == "restoreReportedCom")
        {
            $commentController = new CommentController();
            $commentController->commentStatusAdmin();
        }
        //--------------------------------------------------------------------------------------->
        //SUBMIT IN SUBSCRIBE PAGE 

        elseif($_GET['action'] == "register")
        {
            $memberController = new MemberController();
            $memberController->memberRegistration();
        }
        //--------------------------------------------------------------------------------------->
        //A POST DISPLAY

        elseif($_GET['action'] == 'post')
        {   
            $postController = new PostController();
            $postController->post();        
        }
        
        //--------------------------------------------------------------------------------------->
        //SUBMIT IN LOGIN PAGE 

        elseif($_GET['action'] == 'connect')
        {
            $memberController = new MemberController();
            $verifyLogin = $memberController->verifyConnection();
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
            $commentController = new CommentController();
            $comment = $commentController->newComment();
            
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN ADD A POST
        elseif($_GET['action'] == 'addpost')
        {
            $postController = new PostController();
            $postController->newPost();
            
        }
        else
        {
            throw new Exception('Cette page n\'existe pas');
        }
        
    }
    else // Even in this case display home page 
    {
        $postController = new PostController();
        $postController->lastPostAndComments();
    }    
}
catch (Exception $e)
{
    $errorMessage = $e->getMessage();
    require('views/errorView.php');

}