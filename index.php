<?php
/****************************************INDEX.PHP****************************************/
require_once('controller/frontend.php');
require_once('controller/backend.php');

try //
{
    if(isset($_GET['action']))
    { // We check if there's action in URL. Both case we send to home page
        
        //--------------------------------------------------------------------------------------->
        //ACCUEIL (HOME) PAGE DISPLAY

        if($_GET['action'] == "home")
        {
            $homeLast = lastPost();

            $lastPost = $homeLast['lastPost'];
            $lastComments = $homeLast['lastComments'];
        
            require('views/frontend/homeView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ADMINISTRATEUR (ADMIN) PAGE DISPLAY
        elseif($_GET['action'] == "admin")
        {
            $count = countAll();

            $memberNumber = $count['memberNumber'];
            $postNumber = $count['postNumber'];
            $reportedComNumber = $count['reportedComNumber'];
            
            $members = lastMembersAdmin();
            require('views/frontend/adminView.php');

        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES USERS PAGE
        elseif($_GET['action'] == "adminUsers")
        {
            $count = countAll();

            $memberNumber = $count['memberNumber'];
            $postNumber = $count['postNumber'];
            $reportedComNumber = $count['reportedComNumber'];

            $members = getMembersAdmin();
            require('views/frontend/adminUsersView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES CREATING CHAPTER PAGE
        elseif($_GET['action'] == "adminCreate")
        {
            $count = countAll();

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
            $count = countAll();

            $memberNumber = $count['memberNumber'];
            $postNumber = $count['postNumber'];
            $reportedComNumber = $count['reportedComNumber'];
            $posts = listPostsAdmin();

            require('views/frontend/adminArticlesView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES EDIT PAGE
        elseif($_GET['action'] == 'goEditArticle')
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                $count = countAll();

                $memberNumber = $count['memberNumber'];
                $postNumber = $count['postNumber'];
                $reportedComNumber = $count['reportedComNumber'];

                $post = postAdmin($_GET['id']);

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
            $chapter = htmlspecialchars($_POST['newChapter']);
            $title = htmlspecialchars($_POST['newTitle']);
            $content = htmlspecialchars($_POST['newContent']);
            $postId = $_GET['id'];
            
            if(isset($postId) AND $postId >0)
            {
                if(isset($_POST['edit']))
                {   
                    if(!empty($chapter) AND !empty($title) AND !empty($content))
                    {
                        updatePost($chapter, $title, $content, $postId);
                    }
                    else
                    {
                        echo'Erreur d\'envoie veuillez réessayer';
                    }
                }
                elseif(isset($_POST['delete']))
                {
                    erasePost($postId);
                }
            }
            
            
        }
        //--------------------------------------------------------------------------------------->
        //ADMIN SEES REPORTED COMENTS PAGE
        elseif($_GET['action'] == "adminCom")
        {
            $count = countAll();

            $memberNumber = $count['memberNumber'];
            $postNumber = $count['postNumber'];
            $reportedComNumber = $count['reportedComNumber'];

            $comments = reportedCommentAdminList();

            require('views/frontend/adminComView.php');
        }
        //--------------------------------------------------------------------------------------->
        //ROMAN PAGE DISPLAY
    
        elseif($_GET['action'] == "listPosts") // This action send us to listPostsView = Roman
        {
            $posts = listPosts();

            require_once('views/frontend/listPostsView.php');
            
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
            if(isset($_GET['id']) AND $_GET['id'] > 0)
            {
                
                    $commentId = $_GET['id'];

                    $deleteReported = eraseRepotedCom($commentId); 
                
            }
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
            if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0)
            {
                $reported = 1;
                $commentId = $_GET['id'];
                $postId = $_GET['postId'];
                $updateReported = commentStatus($reported, $commentId, $postId);
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
                
                $updateReportedCom = commentStatusAdmin($reported, $commentId);
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
            $postId = $_GET['id'];
            if(isset($postId) && $postId >0)
            {
                $thePost = post($postId);

                $post = $thePost['post'];
                $comments = $thePost['comments'];

                require('views/frontend/postView.php');
            }
            else 
            {
                $errorMessage = '<div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Ce chapitre n\'existe pas
                                </div>';
                require('views/frontend/postView.php'); // Error message
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
                    if($verifyLogin)
                    {
                        session_start();
                        $result = member($loginConnex);
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
                        
                        require('views/frontend/loginView.php');
                    }
                }
                else
                {
                    $errorMessage = '<div class="alert alert-warning" role="alert">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Veuillez renseignez tout les champs
                                        </div>';
                        
                        require('views/frontend/loginView.php');
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
        elseif($_GET['action'] == 'addpost')
        {
            if(isset($_POST['submit']))
            {
                // Add var
                $newTitle = htmlspecialchars($_POST['title']);
                $newChapter = htmlspecialchars($_POST['chapter']);
                $newContent = nl2br(htmlspecialchars($_POST['content']));
                if(!empty($newTitle) && !empty($newChapter) && !empty($newContent))
                {
                    newPost($newTitle, $newChapter, $newContent);
                    header('Location: index.php?action=listPosts');
                }
                else
                {
                    echo'<p>Formulaire n\'a pas été envoyé</p>';
                }
            }
            else
            {
                echo'<p>Formulaire n\'a pas été envoyé</p>';
            }
        }
        else
        {
            echo'<div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-triangle"></i>PAGE INEXISTANTE<i class="fas fa-exclamation-triangle"></i><br/>
            
          </div><a class="btn btn-primary" href="index.php?action=home" role="button">REVENIR SUR JEAN FORTEROCHE | BLOG </a>
          ';
        }
        
    }
    else // Even in this case display home page 
    {
        
        $homeLast = lastPost();

        $lastPost = $homeLast['lastPost'];
        $lastComments = $homeLast['lastComments'];
        
        require('views/frontend/homeView.php');
        
    }  
}
catch(Exception $e)
{
    $errorMessage = $e->getMessage();
    require('views/errorView.php');
}