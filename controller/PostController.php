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
        function post($postId)
        {
            
            $postManager = new PostManager();
            $post = $postManager->getPost($postId);
            
            $commentManager = new CommentManager();
            $comments = $commentManager->getComments($postId);
            
            return compact('post', 'comments');
                        

        
            require_once('views/frontend/postView.php');
                        
                        
                        
                    
                   /* else 
                    {
                        $errorMessage = '<div class="alert alert-danger" role="alert">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Ce chapitre n\'existe pas
                                        </div>';
                        require('views/frontend/postView.php'); // Error message
                    }  */
                    
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
        function newPost($title, $chapter, $content)
        {
            $postManager = new PostManager();
            $post = $postManager->addPost($title, $chapter, $content);
            $sessionManager = new SessionManager();
            $message = "Message posté avec succès";
            $color = "success";
            $sessionManager->setFlashMessage($message, $color);
            $sessionManager->showFlash(); 
            
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
        function updatePost($chapter, $title, $content, $postId)
        {
            $postManager = new PostManager(); 
            $postUpdate = $postManager->editPost($chapter, $title, $content, $postId); 
            
            header('Location: index.php?action=goEditArticle&id=' . $postId);
            
        }
        
        //-------------------------------------------->POST / ADMIN
        /**
         * erasePost
         *
         * @param  int $postId We call this function wich allowed us to delete a post by its id
         * 
         * @return void
         */
        function erasePost($postId) 
        {
            $postManager = new PostManager(); // Create object
            $deletedPost = $postManager->deletePost($postId);

            header('Location: index.php?action=goEditArticle&id=' . $postId);
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
            
            $lastCommentsManager = new CommentManager(); // Create object
            $lastComments = $lastCommentsManager->allLastComments(); // We call this function wich allowed us to show all last comments by date
            
            return compact('lastPost', 'lastComments');
            
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
        function postAdmin($postId)
        {
            $postManager = new PostManager();
            $post = $postManager->getPost($postId);
            
            return $post;
            
        } 

        
    }