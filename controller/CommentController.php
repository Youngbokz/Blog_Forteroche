<?php
/****************************************MODEL/COMMENTCONTROLLER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Controller;

    // We charge classes 
    require_once('core/Autoloader.php');

    require_once('model/PostManager.php');
    require_once('model/CommentManager.php');
    require_once('model/MemberManager.php');
    require_once('model/SessionManager.php');
    require_once('controller/PostController.php');

    use \Youngbokz\Blog_Forteroche\Core\Autoloader;
    
    Autoloader::register();

    use \Youngbokz\Blog_Forteroche\Model\PostManager;
    use \Youngbokz\Blog_Forteroche\Model\CommentManager;
    use \Youngbokz\Blog_Forteroche\Model\MemberManager;
    use \Youngbokz\Blog_Forteroche\Model\SessionManager;
    use \Youngbokz\Blog_Forteroche\Controller\PostController;
    /**
     * CommentManager class
     * Allowing to create, read, edit and delete comments
     */

class CommentController  
{
    //-------------------------------------------->ADMIN / COMMENTS
    /**
     * reportedCommentAdminList
     * 
     * We call this function wich allowed us to show list of reported comments
     *
     * @return $comments
     */
    function reportedCommentAdminList()
    {
        $commentManager = new CommentManager();
        $postManager = new PostManager();
        $memberManager = new MemberManager();

        $comments = $commentManager->reportedListComments();
        $memberNumber = $memberManager->countMembers();
        $postNumber = $postManager->countPosts();
        $reportedComNumber = $commentManager->countReportedComment();

        require('views/frontend/adminComView.php');
    }

    //-------------------------------------------->COMMENT ADMIN
    /**
     * commentStatusAdmin
     *
     * @param  int $reported
     * @param  int $commentId
     *
     * We call this function wich allowed us to change reported comment status
     * 
     * @return void
     */
    function commentStatusAdmin() 
    {
        $commentManager = new CommentManager();
        $reported = 0;
        $commentId = $_GET['id'];

        if(isset($_GET['id']) && $_GET['id'] > 0)
        {
            $commentManager->updateComStatus($reported, $commentId);

            header('Location: index.php?action=adminCom');
        }
        

    }

    //-------------------------------------------->COMMENT / ADMIN
    /**
     * eraseReportedCom
     *
     * @param  int $commentId We call this function wich allowed us to delete reported comment 
     *
     * @return void
     */
    function eraseReportedCom() 
    {
        $commentManager = new CommentManager();
        $commentId = $_GET['id'];
        if(isset($_GET['id']) AND $_GET['id'] > 0)
        {
            $commentManager->deleteReportedComment($commentId);

            header('Location: index.php?action=adminCom');      
        }   
    }

    //-------------------------------------------->COMMENT
    /**
     * newComment
     *
     * @param  int $postId
     * @param  string $author
     * @param  string $comment
     *
     * We call this function wich allowed us to add a new comment
     * 
     * @return void
     */
    function newComment()
    {
        
        $postId = $_GET['id'];
        $author = $_POST['login'];
        $newMessage = $_POST['story'];

        
        //$sessionManager = new SessionManager();
        
        $commentManager = new CommentManager();
        $postManager = new PostManager();
                
        if(isset($_POST['submit']))
        {
            if(isset($postId) AND $postId > 0)
            {
                if(!empty($newMessage))
                {
                    $comment = $commentManager->addComment($postId, $author, $newMessage);
                    header('Location: index.php?action=post&id='.$postId);
                }
                else
                {
                    $post = $postManager->getPost($postId);
                    $comments = $commentManager->getComments($postId);
                    if($post == false)
                    {
                    $errorMessage = 'Ce chapitre n\'existe pas';
                    require('views/errorView.php');
                    }
                    else
                    {
                    $errorMessageSend = '<div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> Message vide, veuillez entrer un commentaire !
                    </div>';
                    require_once('views/frontend/postView.php');                     
                    }                 
                }
            }
            else
            {
                $errorMessage = 'Aucun identifiant de chapitre envoyé';   
                require('views/errorView.php');
            }
        }
        else
        {
            $errorMessage = 'Formulaire n\'a pas été envoyé';   
            require('views/errorView.php');            
        }
    }

    //-------------------------------------------->COMMENT
    /**
     * commentStatus
     *
     * @param  int $reported
     * @param  int $commentId
     * @param  int $postId
     *
     * We call this function wich allowed us to change and reported a comment
     * 
     * @return void
     */
    function commentStatus() 
    {
        $commentManager = new CommentManager();
        $reported = 1;
        $commentId = $_GET['id'];
        $postId = $_GET['postId'];

        if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0)
            {
                $updateReported = $commentManager->updateComStatus($reported, $commentId);
                
                header('Location: index.php?action=post&id=' . $postId);
            }   
    }
}