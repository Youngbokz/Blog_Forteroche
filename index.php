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
            $lastPost = $postController->lastPost();

            $commentController = new CommentController();
            $lastComments = $commentController->lastComments();

            require_once('views/frontend/homeView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ADMINISTRATEUR (ADMIN) PAGE DISPLAY
        elseif($_GET['action'] == "admin")
        {
            $blogController = new BlogController();
            $reportedComNumber = $blogController->countAllReportedCom();
            $memberNumber = $blogController->countAllMember();
            $postNumber = $blogController->countAllPost();

            $memberController = new MemberController();
            $members = $memberController->lastMembersAdmin();
            
            require('views/frontend/adminView.php');

        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES USERS PAGE
        elseif($_GET['action'] == "adminUsers")
        {
            $blogController = new BlogController();
            $reportedComNumber = $blogController->countAllReportedCom();
            $memberNumber = $blogController->countAllMember();
            $postNumber = $blogController->countAllPost();

            $memberController = new MemberController();
            $members = $memberController->getMembersAdmin();

            require('views/frontend/adminUsersView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES CREATING CHAPTER PAGE
        elseif($_GET['action'] == "adminCreate")
        {
            $blogController = new BlogController();
            $reportedComNumber = $blogController->countAllReportedCom();
            $memberNumber = $blogController->countAllMember();
            $postNumber = $blogController->countAllPost();

            require('views/frontend/adminCreateView.php');
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
            $blogController = new BlogController();
            $reportedComNumber = $blogController->countAllReportedCom();
            $memberNumber = $blogController->countAllMember();
            $postNumber = $blogController->countAllPost();

            $postController = new PostController();
            $posts = $postController->listPostsAdmin();


            require('views/frontend/adminArticlesView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES EDIT PAGE
        elseif($_GET['action'] == 'goEditArticle')
        {
            
            $blogController = new BlogController();
            $reportedComNumber = $blogController->countAllReportedCom();
            $memberNumber = $blogController->countAllMember();
            $postNumber = $blogController->countAllPost();
            
            
            $postController = new PostController();
            $post = $postController->postAdmin();  

            require_once('views/frontend/adminEditView.php');
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
            $blogController = new BlogController();
            $reportedComNumber = $blogController->countAllReportedCom();
            $memberNumber = $blogController->countAllMember();
            $postNumber = $blogController->countAllPost();

            $commentController = new CommentController();
            $comments = $commentController->reportedCommentAdminList();
            

            require('views/frontend/adminComView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ROMAN PAGE DISPLAY
    
        elseif($_GET['action'] == "listPosts") // This action send us to listPostsView = Roman
        {
            $postController = new PostController();
            $posts = $postController->listPosts();

            require('views/frontend/listPostsView.php');
            
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

            $verifyUsername = $memberController->memberRegistration();
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
            throw new Exception('<i class="fas fa-exclamation-triangle"></i>    Page inexistante    <i class="fas fa-exclamation-triangle"></i>');
        }
        
    }
    else // Even in this case display home page 
    {
        $postController = new PostController();
        $lastPost = $postController->lastPost();

        $commentController = new CommentController();
        $lastComments = $commentController->lastComments();  

        require_once('views/frontend/homeView.php');
    }  
    
}
catch (Exception $e)
{
    $errorMessage = $e->getMessage();
    require('views/errorView.php');

}