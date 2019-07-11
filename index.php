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
            $homeLast = $postController->lastPost();

            $lastPost = $homeLast['lastPost'];
            $lastComments = $homeLast['lastComments'];
        
            require('views/frontend/homeView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ADMINISTRATEUR (ADMIN) PAGE DISPLAY
        elseif($_GET['action'] == "admin")
        {
            $blogController = new BlogController();
            $count = $blogController->countAll();

            $memberNumber = $count['memberNumber'];
            $postNumber = $count['postNumber'];
            $reportedComNumber = $count['reportedComNumber'];
            
            $memberController = new MemberController();
            $members = $memberController->lastMembersAdmin();
            require('views/frontend/adminView.php');

        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES USERS PAGE
        elseif($_GET['action'] == "adminUsers")
        {
            $blogController = new BlogController();
            $count = $blogController->countAll();

            $memberNumber = $count['memberNumber'];
            $postNumber = $count['postNumber'];
            $reportedComNumber = $count['reportedComNumber'];

            $memberController = new MemberController();
            $members = $memberController->getMembersAdmin();
            require('views/frontend/adminUsersView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES CREATING CHAPTER PAGE
        elseif($_GET['action'] == "adminCreate")
        {
            $blogController = new BlogController();
            $count = $blogController->countAll();

            $memberNumber = $count['memberNumber'];
            $postNumber = $count['postNumber'];
            $reportedComNumber = $count['reportedComNumber'];

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
            $count = $blogController->countAll();

            $memberNumber = $count['memberNumber'];
            $postNumber = $count['postNumber'];
            $reportedComNumber = $count['reportedComNumber'];

            $postManager = new PostController();
            $posts = $postManager->listPostsAdmin();


            require('views/frontend/adminArticlesView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES EDIT PAGE
        elseif($_GET['action'] == 'goEditArticle')
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                $blogController = new BlogController();
                $count = $blogController->countAll();

                $memberNumber = $count['memberNumber'];
                $postNumber = $count['postNumber'];
                $reportedComNumber = $count['reportedComNumber'];

                $postManager = new PostController();
                $post = $postManager->postAdmin($_GET['id']);

                require('views/frontend/adminEditView.php');
            }
            else 
            {
                echo 'Erreur : aucun identifiant de post envoyé'; // Error message
            }
        }
        
        //--------------------------------------------------------------------------------------->
        //ADMIN EDIT A POST
        elseif($_GET['action'] == "editPost")
        {
            $postManager = new PostManager();
            $chapter = $_POST['newChapter'];
            $title = htmlspecialchars($_POST['newTitle']);
            $content = $_POST['newContent'];
            $postId = $_GET['id'];
            
            if(isset($postId) AND $postId >0)
            {
                if(isset($_POST['edit']))
                {   
                    if(!empty($chapter) AND !empty($title) AND !empty($content))
                    {
                        $postManager->updatePost($chapter, $title, $content, $postId);
                    }
                    else
                    {
                        echo'Erreur d\'envoie veuillez réessayer';
                    }
                }
                elseif(isset($_POST['delete']))
                {
                    $postManager->erasePost($postId);
                }
            }
            
            
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES REPORTED COMENTS PAGE
        elseif($_GET['action'] == "adminCom")
        {
            $blogController = new BlogController();
            $count = $blogController->countAll();

            $memberNumber = $count['memberNumber'];
            $postNumber = $count['postNumber'];
            $reportedComNumber = $count['reportedComNumber'];

            $commentManager = new CommentController();
            $comments = $commentManager->reportedCommentAdminList();
            

            require('views/frontend/adminComView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ROMAN PAGE DISPLAY
    
        elseif($_GET['action'] == "listPosts") // This action send us to listPostsView = Roman
        {
            $postManager = new PostController();
            $posts = $postManager->listPosts();

            require_once('views/frontend/listPostsView.php');
            
        }
        //--------------------------------------------------------------------------------------->
        //SE CONNECTER (LOGIN) PAGE DISPLAY

        elseif($_GET['action'] == "login") // This action send us to loginView 
        {
            $errorMessage="";
            $succesMessage="";
            require('views/frontend/loginView.php');
        }
        //--------------------------------------------------------------------------------------->
        //DELETE REPORTED COMMENT ADMIN

        elseif($_GET['action'] == "deleteReportedCom") // This action send us to loginView 
        {
            if(isset($_GET['id']) AND $_GET['id'] > 0)
            {
                
                    $commentId = $_GET['id'];
                    $commentManager = new CommentManager();
                    $deleteReported = $commentManager->eraseRepotedCom($commentId); 
                
            }
        }
        //--------------------------------------------------------------------------------------->
        //S'INSCRIRE (SUBSCRIBE) PAGE DISPLAY

        elseif($_GET['action'] == "subscribe") // This action send us to loginView 
        {
            $errorMessage="";
            
            require('views/frontend/subscribeView.php');
        }
        //--------------------------------------------------------------------------------------->
        //REPORT A COMMENT POSTVIEW PAGE

        elseif($_GET['action'] == "reportComment")
        {
            if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0)
            {
                $reported = 1;
                $commentId = $_GET['id'];
                $postId = $_GET['postId'];
                $commentManager = new CommentManager();
                $updateReported = $commentManager->commentStatus($reported, $commentId, $postId);
                
                header('Location: index.php?action=post&id=' . $postId);
            }
        }
        //--------------------------------------------------------------------------------------->
        //RESTORE REPORTED COMMENT ADMIN

        elseif($_GET['action'] == "restoreReportedCom")
        {
            
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                $reported = 0;
                $commentId = $_GET['id'];
                $commentManager = new CommentManager();
                $updateReportedCom = $commentManager->commentStatusAdmin($reported, $commentId);
                $succesMessage = 
                header('Location: index.php?action=adminCom');
            }
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
                $errorMessage=[];

                $memberManager = new MemberManager();

                if(!empty($username) AND 
                !empty($pass) AND
                !empty($re_pass))
                {
                    if(preg_match('#^[a-zA-Z0-9_]{2,16}$#i', ($username))) // Usrname conditions minimum 2 letters
                    {
                        $verifyUsername = $memberManager->verify($username); // Verify if username exist or not

                        if($verifyUsername == 0) // if log doesnt exist in database
                        {
                            if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$#', ($pass))) //Password must have 1 lower and upper case and a number
                            {
                                if($pass === $re_pass)
                                {
                                    $memberManager->subscribe($username, $pass);
                                    $succesMessage = '<div class="alert alert-success" role="alert">
                                    Vous êtes enregistré(e), vous pouvez vous connecter!
                                    </div>';
                                    $errorMessage="";
                                    require('views/frontend/loginView.php');
                                }
                                else
                                {
                                    $errorMessage['differentPass'] = '<div class="alert alert-warning" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Mot de passe différents
                                    </div>';
                                    
                                }
                            }
                            else
                            {
                                $errorMessage['password'] = '<div class="alert alert-warning" role="alert">
                                <i class="fas fa-exclamation-triangle"></i>
                                Mot de passe 8 caractères minimum avec au moins 1 minuscule, 1 majuscule et 1 chiffre
                                </div>';
                                
                            }
                        }
                        else
                        {
                            $errorMessage['existingLog'] = '<div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            Ce pseudo existe déjà, choisir un autre ou vous connectez
                            </div>';
                            
                        }
                    }
                    else
                    {
                        $errorMessage['log'] = '<div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        Votre pseudo doit comporter au moins 2 lettres
                        </div>';
                        
                    }
                }
                else
                {
                    $errorMessage['inputs'] = '<div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    Veuillez renseigner tout les champs !
                    </div>';
                    
                }
            }
            else
            {
                $errorMessage['submit'] = '<div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                Formulaire n\'a pas été envoyé
                </div>';
                
            }
            
            if(!empty($errorMessage))
            {
                $_SESSION['errorMessage'] = $errorMessage;
                
                require('views/frontend/subscribeView.php');
            }
        }
        //--------------------------------------------------------------------------------------->
        //A POST DISPLAY

        elseif($_GET['action'] == 'post')
        {
            $postManager = new PostController();
            $postManager->post($_GET['id']);
            require_once('views/frontend/postView.php');
        }
        
        //--------------------------------------------------------------------------------------->
        //SUBMIT IN LOGIN PAGE 

        elseif($_GET['action'] == 'connect')
        {
            $blogController = new BlogController();
            $memberController = new MemberController();
            if(isset($_POST['submit']))
            {
                // Add var
                $loginConnex = htmlspecialchars($_POST['login']);
                $passConnex = htmlspecialchars($_POST['pass']);

                if(!empty($loginConnex) AND !empty($passConnex))
                {
                    
                    $verifyLogin = $blogController->verifyConnection($loginConnex, $passConnex);

                     // Check if password in match with the one in database
                    if($verifyLogin)
                    {
                        session_start();
                        $result = $memberController->member($loginConnex);
                        $_SESSION['login'] = $result['log'];
                        $_SESSION['id'] = $result['id'];
                        $_SESSION['registration_date'] = $result['registration_date_fr'];

                        header('location: index.php?action=home');
                    }
                    else
                    {
                        
                        $errorMessage = '<div class="alert alert-warning" role="alert">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Mauvais mot de passe ou pseudo inconnue
                                        </div>';
                                        
                        $succesMessage="";
                        require('views/frontend/loginView.php');
                    }
                }
                else
                {
                    $errorMessage = '<div class="alert alert-warning" role="alert">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Veuillez renseignez tout les champs
                                        </div>';
                                       
                    $succesMessage="";
                    require('views/frontend/loginView.php');
                }
            }
            else
            {
                $errorMessage = '<p>Formulaire n\'a pas été envoyé</p>';
                $succesMessage="";
                require('views/frontend/loginView.php');
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
            $commentController = new CommentController();
            $commentController->newComment();
            require_once('views/frontend/postView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN ADD A POST
        elseif($_GET['action'] == 'addpost')
        {
            if(isset($_POST['submit']))
            {
                // Add var
                $newTitle = htmlspecialchars($_POST['title']);
                $newChapter = htmlspecialchars($_POST['chapter']);
                $newContent = $_POST['content'];
                if(!empty($newTitle) && !empty($newChapter) && !empty($newContent))
                {
                    newPost($newTitle, $newChapter, $newContent);
                    require('index.php?action=listPosts');
                }
                else
                {
                    throw new Exception('<p>Veuillez renseigner les différents champs</p>');
                }
            }
            else
            {
                throw new Exception('Formulaire n\'a pas été envoyé');
            }
        }
        else
        {
            throw new Exception('<i class="fas fa-exclamation-triangle"></i>    Page inexistante    <i class="fas fa-exclamation-triangle"></i>');
        }
        
    }
    else // Even in this case display home page 
    {
        
        $postController = new PostController();
        $homeLast = $postController->lastPost();

        $lastPost = $homeLast['lastPost'];
        $lastComments = $homeLast['lastComments'];
        
        require('views/frontend/homeView.php');
        
    }  
    
}
catch (Exception $e)
{
    $errorMessage = $e->getMessage();
require('views/errorView.php');

}