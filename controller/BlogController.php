<?php
/****************************************MODEL/BLOGCONTROLLER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Controller;

    // We charge classes 
    require_once('core/Autoloader.php');

    require_once('model/PostManager.php');
    require_once('model/CommentManager.php');
    require_once('model/MemberManager.php');
    require_once('model/SessionManager.php');
    use \Youngbokz\Blog_Forteroche\Core\Autoloader;
    
    Autoloader::register();

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
         //-------------------------------------------->ADMIN / DASHBOARD
        /**
         * adminDashboard
         *
         * We call this function wich allowed us to show admin dashboard
         * 
         * @return void
         */
        function adminDashboard()
        {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $memberManager = new MemberManager();

            $members = $memberManager->getLastMembers(); 
            $memberNumber = $memberManager->countMembers();
            $postNumber = $postManager->countPosts();
            $reportedComNumber = $commentManager->countReportedComment();
            
            require('views/frontend/adminView.php');
        }
        function sideNavAdminData($requirePage)
        {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $memberManager = new MemberManager();
            
            $memberNumber = $memberManager->countMembers();
            $postNumber = $postManager->countPosts();
            $reportedComNumber = $commentManager->countReportedComment();

            require($requirePage);
        }
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
            $postNumber = $postsManager->countPosts();

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