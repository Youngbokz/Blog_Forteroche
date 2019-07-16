<?php
/****************************************MODEL/POSTCONTROLLER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Controller;

    // We charge classes 
    /*require_once('model/Autoloader.php');*/

    require_once('model/PostManager.php');
    require_once('model/CommentManager.php');
    require_once('model/MemberManager.php');
    require_once('model/SessionManager.php');
    /*use \Youngbokz\Blog_Forteroche\Model\Autoloader;
    
    Autoloader::register();*/

    use \Youngbokz\Blog_Forteroche\Model\PostManager;
    use \Youngbokz\Blog_Forteroche\Model\CommentManager;
    use \Youngbokz\Blog_Forteroche\Model\MemberManager;
    use \Youngbokz\Blog_Forteroche\Model\SessionManager;
    
    /**
     * PostManager class
     * Allowing to create, read, edit and delete posts
     */

    class PostController  
    {
        //-------------------------------------------->POST with COMMENTS
        /**
         * post
         *
         * @param  int $postId We call this function wich allowed us to show a post with its comments
         *
         * @return compact('post', 'comments')
         */
        function post()
        {           
            $postId = $_GET['id'];
                       
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            
            if(isset($postId) && $postId > 0)
            {
                $post = $postManager->getPost($postId);
                $comments = $commentManager->getComments($postId);
                if($post == false)
                {
                    $errorMessage = 'Cette page n\'existe pas !';
                    require('views/errorView.php');
                }
                else
                {
                require_once('views/frontend/postView.php');                     
                }                 
            }
            else 
            {
            $errorMessage = '<div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Ce chapitre n\'existe pas
                            </div>';
            require('views/errorView.php');
            }                     
        }

        //-------------------------------------------->POST / ADMIN
        /**
         * listPostsAdmin 
         * 
         * We call this function wich allowed us to show the posts 
         *
         * @return $posts
         */
        function listPostsAdmin()
        {
            $postsManager = new PostManager(); 
            $posts = $postsManager->getPosts(); 

            return $posts;
        }
        //-------------------------------------------->ADMIN
        /**
         * newPost
         *
         * @param  string $title
         * @param  string $chapter
         * @param  string $content
         * 
         * We call this function wich allowed us to add a post 
         * 
         * @return void
         */
        function newPost()
        {
            $postManager = new PostManager();
            // Add var
            $newTitle = htmlspecialchars($_POST['title']);
            $newChapter = htmlspecialchars($_POST['chapter']);
            $newContent = $_POST['content'];

            /*$sessionManager = new SessionManager();
            $message = "Message posté avec succès";
            $color = "success";
            $sessionManager->setFlashMessage($message, $color);
            $sessionManager->showFlash(); */
            if(isset($_POST['submit']))
            {
                if(!empty($newTitle) && !empty($newChapter) && !empty($newContent))
                { 
                    $postManager->addPost($newTitle, $newChapter, $newContent);
                    header('Location: index.php?action=adminArticle');
                }
                else
                {
                    $errorMessage = '<div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Veuillez renseigner les différents champs
                            </div>';
                    require('views/frontend/adminCreateView.php');
                }
            }
            else
            {
                $errorMessage = '<div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Formulaire n\'a pas été envoyé
                            </div>';
                require('views/frontend/adminCreateView.php');
            }
        }
        
        
        
        
        //-------------------------------------------->ADMIN / POST 
        /**
         * updatePost
         *
         * @param  string $chapter
         * @param  string $title
         * @param  string $content
         * @param  int $postId
         * 
         * We call this function wich allowed us to update a post
         *
         * @return void
         */
        function updatePost()
        {
            $postManager = new PostManager(); 
            $chapter = $_POST['newChapter'];
            $title = htmlspecialchars($_POST['newTitle']);
            $content = $_POST['newContent'];
            $postId = $_GET['id'];
            
            if(isset($postId) AND $postId >0)
            {
                if(isset($_POST ['edit']))
                {
                    $postManager->editPost($chapter, $title, $content, $postId); 
                
                    header('Location: index.php?action=adminArticle');
                }
                else
                {
                    echo'Erreur d\'envoie veuillez réessayer';
                }
            }
        }
        
        //-------------------------------------------->POST / ADMIN
        /**
         * erasePost
         *
         * @param  int $postId We call this function wich allowed us to delete a post by its id
         * 
         * @return void
         */
        function erasePost() 
        {
            $postManager = new PostManager(); // Create object
            $postId = $_GET['id'];

            if(isset($postId) AND $postId >0)
            {
                if(isset($_POST['delete']))
                {
                    $postManager->deletePost($postId);
                    $succesMessage = '<div class="alert alert-success" role="alert">
                                    Chapitre bien supprimé !
                                    </div>';
                                    
                                    //header('views/frontend/adminArticlesView.php');
                    header('Location: index.php?action=goEditArticle&id=' . $postId);
                } 
            }   
        }

        //-------------------------------------------->POST
        /**
         * lastPost 
         * 
         * We call this function wich allowed us to show a post and last comments in home page
         *
         * @return compact('lastPost', 'lastComments')
         */
        function lastPost()
        { 
            $lastPostManager = new PostManager(); // Create object
            $lastPost = $lastPostManager->getLastPost(); // We call this function wich allowed us to show the last post by date
            
            return $lastPost;
        }

        //-------------------------------------------->POST
        /**
         * listPosts
         *
         * We call this function wich allowed us to show a list of posts 
         * 
         * @return $posts
         */
        function listPosts()
        {
            $postsManager = new PostManager(); 
            $posts = $postsManager->getPosts(); 

            return $posts;
        }

        //-------------------------------------------->POST / ADMIN
        /**
         * postAdmin
         * 
         * @param  int $postId We call this function wich allowed us to show a post without comments
         *
         * @return $post
         */
        function postAdmin()
        {
            $postManager = new PostManager();
            $postId = $_GET['id'];
            
                if(isset($postId) && $postId > 0)
                {                 
                        $post = $postManager->getPost($postId);
                    
                        return $post;     
        
                }
                else 
                {
                    $errorMessage = '<div class="alert alert-warning" role="alert">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Pas d\'identifiant. Pas de chapitre à éditer !
                                        </div>';
                                        require('views/frontend/adminEditView.php');
                }                 
        } 
    }