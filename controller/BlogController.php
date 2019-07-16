<?php
/****************************************MODEL/BLOGCONTROLLER.PHP****************************************/

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
     * BlogController class
     * Allowing count members, reported comments and posted, display in admin dashboard
     */

    class BlogController  
    {
        /**
         * countAll
         * 
         * We call this function wich allowed us to count members 
         *
         * @return $memberNumber
         */
        function countAllMember()
        {
            $membersManager = new MemberManager(); 
            $memberNumber = $membersManager->countMembers();
  
            return $memberNumber;
        }
        /**
         * countAllPost
         *
         * We call this function wich allowed us to count posts
         * 
         * @return $postNumber
         */
        function countAllPost()
        {
            $postsManager = new PostManager(); 
            $postNumber = $postsManager->countPost();

            return $postNumber;
        }
        /**
         * countAllReportedCom
         *
         * We call this function wich allowed us to count reported comments
         * 
         * @return $reportedComNumber
         */
        function countAllReportedCom()
        {
            $commentsManager = new CommentManager();
            $reportedComNumber = $commentsManager->countReportedComment();

            return $reportedComNumber;
        }
    }