<?php
/****************************************MODEL/POSTCONTROLLER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Controller;

    // We charge classes 
    require_once('core/Autoloader.php');

    require_once('model/PostManager.php');
    require_once('model/CommentManager.php');
    require_once('model/MemberManager.php');
    require_once('model/SessionManager.php');
    require_once('BlogController.php');
    use \Youngbokz\Blog_Forteroche\Core\Autoloader;
    
    Autoloader::register();

    use \Youngbokz\Blog_Forteroche\Model\PostManager;
    use \Youngbokz\Blog_Forteroche\Model\CommentManager;
    use \Youngbokz\Blog_Forteroche\Model\MemberManager;
    use \Youngbokz\Blog_Forteroche\Model\SessionManager;
    use \Youngbokz\Blog_Forteroche\Controller\BlogController;
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
            //$postId = $_GET['id'];
                       
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                $post = $postManager->getPost($_GET['id']);
                //$comments = $commentManager->getComments($_GET['id']);
                $totalCommentReq = $commentManager->numberOfCommentByPost($_GET['id']);
                    $totalComment = $totalCommentReq['total'];
                    $commentPerPage = 2;
                        
                    $totalPage = ceil($totalComment / $commentPerPage);
                        
                    if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $totalPage)
                    {
                        $_GET['page'] = intval($_GET['page']);
                        $currentPage = $_GET['page'];
                    }
                    else
                    {
                        $currentPage = 1;
                    }
                    $start = ($currentPage - 1) * $commentPerPage;
            
                    $comments = $commentManager->getComments($_GET['id'], $start, $commentPerPage);

                if($post == false)
                {
                    $errorMessage = 'Ce chapitre n\'existe pas';
                    require('views/errorView.php');
                }
                else
                {
                    require_once('views/frontend/postView.php');                     
                }                 
            }
            else 
            {
            $errorMessage = 'Cette page n\'existe pas';
            require('views/errorView.php');
            }                     
        }

        //-------------------------------------------->POST / ADMIN
        /**
         * listPostsAdmin 
         * 
         * We call this function wich allowed us to show the posts with pagination
         *
         * @return $posts
         */
        function listPostsAdmin()
        {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $memberManager = new MemberManager();

            
            $memberNumber = $memberManager->countMembers();
            $postNumber = $postManager->countPosts();
            $reportedComNumber = $commentManager->countReportedComment();

            $totalPostReq = $postManager->numberPost();
            $totalPost = $totalPostReq['total'];
            $postPerPage = 4;
            
            $totalPage = ceil($totalPost / $postPerPage);
            
            if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $totalPage)
            {
                $_GET['page'] = intval($_GET['page']);
                $currentPage = $_GET['page'];
            }
            else
            {
                $currentPage = 1;
            }

            $start = ($currentPage - 1) * $postPerPage;

            $posts = $postManager->getPostsAdmin($start, $postPerPage); 
            
            require('views/frontend/adminArticlesView.php');
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
                    //header('Location: index.php?action=adminArticle');
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
            $commentManager = new CommentManager();
            $memberManager = new MemberManager();

            $chapter = $_POST['newChapter'];
            $title = htmlspecialchars($_POST['newTitle']);
            $content = $_POST['newContent'];
            $postId = $_GET['id'];
            
            if(isset($postId))
            {
                if(!empty($chapter) && !empty($title) && !empty($content))
                {
                    $postManager->editPost($chapter, $title, $content, $postId);
                    $succesMessage = '<div class="alert alert-success" role="alert">
                    Chapitre modifié avec succès !
                    </div>';
                    require('views/frontend/adminArticlesView.php');
                }
                else
                {
                    $errorMessage ='<div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    Vous devez remplir tout les champs
                    </div>';

                    $post = $postManager->getPost($postId);
                    $memberNumber = $memberManager->countMembers();
                    $postNumber = $postManager->countPosts();
                    $reportedComNumber = $commentManager->countReportedComment();

                    require('views/frontend/adminEditView.php');
                }
            }
            else
            {
                $errorMessage = 'Cette page n\'existe pas';
                require('views/errorView.php');
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
        function lastPostAndComments()
        { 
            $lastPostManager = new PostManager(); 
            $lastCommentManager = new CommentManager();

            $lastPost = $lastPostManager->getLastPost(); 
            $lastComments = $lastCommentManager->allLastComments();
            
            require_once('views/frontend/homeView.php');
        }

        //-------------------------------------------->POST
        /**
         * listPosts
         *
         * We call this function wich allowed us to show a list of posts with pagination
         * 
         * @return $posts
         */
        function listPosts()
        {       
            $postsManager = new PostManager(); 
            
            $totalPostReq = $postsManager->numberPost();
            $totalPost = $totalPostReq['total'];
            $postPerPage = 3;
            
            $totalPage = ceil($totalPost / $postPerPage);
            
            if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $totalPage)
            {
                $_GET['page'] = intval($_GET['page']);
                $currentPage = $_GET['page'];
            }
            else
            {
                $currentPage = 1;
            }

            $start = ($currentPage - 1) * $postPerPage;

            $posts = $postsManager->getPosts($start, $postPerPage); 
            
            require('views/frontend/listPostsView.php');
        }

        //-------------------------------------------->POST / ADMIN
        /**
         * postAdmin
         * 
         * @param  int $postId We call this function wich allowed us to show a post without comments
         *
         * @return $post
         */
        function postEditAdmin()
        {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $memberManager = new MemberManager();

            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                $post = $postManager->getPost($_GET['id']);
                $memberNumber = $memberManager->countMembers();
                $postNumber = $postManager->countPosts();
                $reportedComNumber = $commentManager->countReportedComment();

                if($post == false)
                {
                    $errorMessage = '<div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    Pas de chapitre à éditer !
                    </div>';
                    require('views/frontend/adminEditView.php');
                }
                else
                {
                    require('views/frontend/adminEditView.php');
                }
            }
            else
            {
                $errorMessage = 'Cette page n\'existe pas';
                require('views/errorView.php');
            }
        }
    }