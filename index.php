<?php
/****************************************INDEX.PHP****************************************/

//REQUIRING CLASSES
require_once('controller/BlogController.php');
require_once('controller/CommentController.php');
require_once('controller/MemberController.php');
require_once('controller/PostController.php');

use \Youngbokz\Blog_Forteroche\Controller\BlogController;
use \Youngbokz\Blog_Forteroche\Controller\CommentController;
use \Youngbokz\Blog_Forteroche\Controller\MemberController;
use \Youngbokz\Blog_Forteroche\Controller\PostController;

try 
{
    if(isset($_GET['action']))
    { 
        /* ---------------------------------------- */
        /* =============BLOG FREE ACCES============ */
        /*----------------------------------------- */
        
        //HOME PAGE DISPLAY

        if($_GET['action'] == "home")
        {
            $postController = new PostController();
            $postController->lastPostAndComments();
        }
        
        //ROMAN PAGE DISPLAY
    
        elseif($_GET['action'] == "listPosts") // This action send us to listPostsView = Roman
        {
            $postController = new PostController();
            $postController->listPosts();         
        }

        //SINGLE POST DISPLAY

        elseif($_GET['action'] == 'post')
        {   
            $postController = new PostController();
            $postController->post();        
        }

        //ABOUT ME PAGE DISPLAY
        elseif($_GET['action'] == 'aboutme')
        {
            require('views/frontend/aboutme.php');
        }
        /* ---------------------------------------- */
        /* =============BLOG CONNECTION============ */
        /*----------------------------------------- */

        // LOGIN PAGE DISPLAY

        elseif($_GET['action'] == "login") 
        {
            require('views/frontend/loginView.php');
        }

        //LOGIN  

        elseif($_GET['action'] == 'connect')
        {
            $memberController = new MemberController();
            $verifyLogin = $memberController->verifyConnection();
        }

        // SUBSCRIBE PAGE DISPLAY

        elseif($_GET['action'] == "subscribe") // This action send us to loginView 
        { 
            require('views/frontend/subscribeView.php');
        }

        //SUBSCRIBE  

        elseif($_GET['action'] == "register")
        {
            $memberController = new MemberController();
            $memberController->memberRegistration();
        }

        //DISCONNECT PAGE DISPLAY

        elseif($_GET['action'] == "disconnect")
        {
            require('views/frontend/disconnectView.php');
        }

        /* ---------------------------------------- */
        /* =============BLOG MEMBERS ACCES============ */
        /*----------------------------------------- */

        //REPORT A COMMENT POSTVIEW 

        elseif($_GET['action'] == "reportComment")
        {
            $commentController = new CommentController();
            $commentController->commentStatus();
        }

        //SEND A COMMENT

        elseif($_GET['action'] == "sendComment")
        {
            $commentController = new CommentController();
            $comment = $commentController->newComment();
            
        }

        /* ---------------------------------------- */
        /* =============BLOG ADMIN ACCES=========== */
        /*----------------------------------------- */
      
        //ADMIN DASHBOARD
        elseif($_GET['action'] == "admin")
        {
            $blogController = new BlogController();
            $blogController->adminDashboard();
        }
        
        //ADMIN: MEMBERS PAGE
        elseif($_GET['action'] == "adminUsers")
        {
            $memberController = new MemberController();
            $memberController->getMembersAdmin();
        }
        
        //ADMIN SEES CREATING CHAPTER PAGE
        elseif($_GET['action'] == "adminCreate")
        {
            $blogController = new BlogController();
            $requirePage = 'views/frontend/adminCreateView.php';
            $blogController->sideNavAdminData($requirePage);
        }
        
        //ADMIN SEES LIST POSTS 
        elseif($_GET['action'] == "adminArticle")
        {
            $postController = new PostController();
            $postController->listPostsAdmin();
        }
        
        //ADMIN SEES EDIT PAGE
        elseif($_GET['action'] == 'goEditArticle')
        {
            $postController = new PostController();
            $postController->postEditAdmin();
        }
            
        //ADMIN EDIT A POST
        elseif($_GET['action'] == "editPost")
        {
            $postController = new PostController();
            $postController->updatePost();
        }
        
        //ADMIN SEES REPORTED COMENTS PAGE
        elseif($_GET['action'] == "adminCom")
        {
            $commentController = new CommentController();
            $commentController->reportedCommentAdminList();
        }
        
        //DELETE REPORTED COMMENT ADMIN

        elseif($_GET['action'] == "deleteReportedCom") 
        {
            $commentController = new CommentController();
            $commentController->eraseReportedCom(); 
        }
        
        //RESTORE REPORTED COMMENT ADMIN

        elseif($_GET['action'] == "restoreReportedCom")
        {
            $commentController = new CommentController();
            $commentController->commentStatusAdmin();
        }
        
        //ADMIN ADD A POST

        elseif($_GET['action'] == 'addpost')
        {
            $postController = new PostController();
            $postController->newPost(); 
        }
        //IF PAGE DOESN'T EXIST
        else
        {
            throw new Exception('Cette page n\'existe pas');
        }       
    }
    else //HOME PAGE DISPLAY
    {
        $postController = new PostController();
        $postController->lastPostAndComments();
    }    
}//ERROR PAGE DISPLAY
catch (Exception $e)
{
    $errorMessage = $e->getMessage();
    require('views/errorView.php');

}