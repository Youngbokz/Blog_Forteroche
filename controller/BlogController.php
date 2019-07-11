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
     * Allowing to connect subscribe, display in Blog
     */

    class BlogController  
    {
        //-------------------------------------------->ADMIN / MEMBER
        /**
         * countAll
         * 
         * We call this function wich allowed us to count members, posts and reported comments 
         *
         * @return compact('memberNumber', 'postNumber', 'reportedComNumber');
         */
        function countAll()
        {
            $membersManager = new MemberManager(); 
            $memberNumber = $membersManager->countMembers();

            $postsManager = new PostManager(); 
            $postNumber = $postsManager->countPost();

            $commentsManager = new CommentManager();
            $reportedComNumber = $commentsManager->countReportedComment();

            return compact('memberNumber', 'postNumber', 'reportedComNumber');
        }
    }