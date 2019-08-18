<?php
/****************************************MODEL/POSTCONTROLLER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Controller;

    // We charge classes 
    require_once('core/Autoloader.php');
    //require_once('model/PostManager.php');
    //require_once('model/CommentManager.php');
    //require_once('model/MemberManager.php');
    use \Youngbokz\Blog_Forteroche\Model\PostManager;
    use \Youngbokz\Blog_Forteroche\Model\CommentManager;
    use \Youngbokz\Blog_Forteroche\Model\MemberManager;
    use \Youngbokz\Blog_Forteroche\Core\Autoloader;
    Autoloader::register();
    
    /**
     * PostManager class
     * Allowing to create, read, edit and delete posts
     */

    class PostController  
    {
        /**
         * post
         *
         * @param  int $postId We call this function wich allowed us to show a post with its comments
         *
         * @return compact('post', 'comments')
         */
        function post()
        {           
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                $post = $postManager->getPost($_GET['id']);
        
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
                    require('views/frontend/postView.php');                     
                }                 
            }
            else 
            {
            $errorMessage = 'Cette page n\'existe pas';
            require('views/errorView.php');
            }                     
        }

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
            
            require('views/backend/adminArticlesView.php');
        }
        
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
           
            $newTitle = htmlspecialchars($_POST['title']);
            $newChapter = htmlspecialchars($_POST['chapter']);
            $newContent = $_POST['content'];

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
                    require('views/backend/adminCreateView.php');
                }
            }
            else
            {
                $errorMessage = '<div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Formulaire n\'a pas été envoyé
                            </div>';
                require('views/backend/adminCreateView.php');
            }
        }
        
        /**
         * updatePost
         *
         * @param  string $chapter
         * @param  string $title
         * @param  string $content
         * @param  int $postId
         * 
         * We call this function wich allowed us to update a post choice between edit and delete it.
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
                if(isset($_POST['edit']))
                {
                    if(!empty($chapter) && !empty($title) && !empty($content))
                    {
                        $postManager->editPost($chapter, $title, $content, $postId);
                        $succesMessage = '<div class="alert alert-success" role="alert">
                        Chapitre modifié avec succès !
                        </div>';
                        header('Location: index.php?action=adminArticle');
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

                        require('views/backend/adminEditView.php');
                    }
                }
                
                elseif(isset($_POST['delete']))
                {
                    $postManager->deletePost($postId);
                    $succesMessage = '<div class="alert alert-success" role="alert">
                                    Chapitre bien supprimé !
                                    </div>';
                                    
                    $memberNumber = $memberManager->countMembers();
                    $postNumber = $postManager->countPosts();
                    $reportedComNumber = $commentManager->countReportedComment();
                    require('views/backend/adminCreateView.php');
                } 
            }
            else
            {
                $errorMessage = 'Cette page n\'existe pas';
                require('views/errorView.php');
            }
        }
        
        
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
                    require('views/backend/adminEditView.php');
                }
                else
                {
                    require('views/backend/adminEditView.php');
                }
            }
            else
            {
                $errorMessage = 'Cette page n\'existe pas';
                require('views/errorView.php');
            }
        }
    }