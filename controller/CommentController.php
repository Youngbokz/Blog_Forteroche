<?php
/****************************************MODEL/COMMENTCONTROLLER.PHP****************************************/

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
        $commentsManager = new CommentManager();
        $comments = $commentsManager->reportedListComments();

        return $comments;
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
    function commentStatusAdmin($reported, $commentId) 
    {
        $commentManager = new CommentManager();
        $updateReported = $commentManager->updateComStatus($reported, $commentId);

    }

    //-------------------------------------------->COMMENT / ADMIN
    /**
     * eraseRepotedCom
     *
     * @param  int $commentId We call this function wich allowed us to delete reported comment 
     *
     * @return void
     */
    function eraseRepotedCom($commentId) 
    {
        $commentManager = new CommentManager();
        $deletedReported = $commentManager->deleteReportedComment($commentId);

        header('Location: index.php?action=adminCom');
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
    function newComment($postId, $author, $newMessage)
    {
        $commentManager = new CommentManager();
        $comment = $commentManager->addComment($postId, $author, $newMessage);
        
        if(isset($_POST['submit']))
        {
            if(isset($postId) AND $postId > 0)
            {
                if(!empty($author) AND !empty($newMessage))
                {
                    $comment;
                    header('Location: index.php?action=post&id='.$_GET['id']);
                }
                else
                {
                    throw new Exception
                    ($errorMessage = '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i>
                                                Votre message est vide !
                                        </div>');
                }
            }
            else
            {
                throw new Exception('<p>Aucun identifiant de chapitre envoyé</p>');
                            
            }
        }
        else
        {
            throw new Exception('<p>Formulaire n\'a pas été envoyé</p>');
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
    function commentStatus($reported, $commentId, $postId) 
    {
        $commentManager = new CommentManager();
        $updateReported = $commentManager->updateComStatus($reported, $commentId); 
    }
}