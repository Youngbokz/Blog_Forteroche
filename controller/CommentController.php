<?php
/****************************************MODEL/COMMENTCONTROLLER.PHP****************************************/

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
     * CommentManager class
     * Allowing to create, read, edit and delete comments
     */

class CommentController  
{
    /**
     * reportedCommentAdminList
     * 
     * We call this function wich allowed us to show list of reported comments with pagination
     *
     * @return $comments
     */
    function reportedCommentAdminList()
    {
        $commentManager = new CommentManager();
        $postManager = new PostManager();
        $memberManager = new MemberManager();

        
        $memberNumber = $memberManager->countMembers();
        $postNumber = $postManager->countPosts();
        $reportedComNumber = $commentManager->countReportedComment();

        $totalRepotedCommentReq = $commentManager->numberOfReportedComment();
        $totalRepotedComment = $totalRepotedCommentReq['total'];
        $repotedCommentPerPage = 4;
            
        $totalPage = ceil($totalRepotedComment / $repotedCommentPerPage);
            
        if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $totalPage)
        {
            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];
        }
        else
        {
            $currentPage = 1;
        }
        $start = ($currentPage - 1) * $repotedCommentPerPage;

        $repotedComments = $commentManager->reportedListComments($start, $repotedCommentPerPage);

        require('views/backend/adminComView.php');
    }

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
        $commentManager = new CommentManager();
        $postManager = new PostManager();

        $postId = $_GET['id'];
        $author = htmlspecialchars($_POST['login']);
        $newMessage = htmlspecialchars($_POST['story']);
                
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