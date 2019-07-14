<?php
/****************************************MODEL/MEMBERCONTROLLER.PHP****************************************/

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
     * MemberManager class
     * Allowing to create, read, edit and delete member
     */

    class MemberController  
    {
        //-------------------------------------------->MEMBER
        /**
         * member
         *
         * @param  string $log We call this function wich allowed us to get a member
         *
         * @return $member
         */
        function member($log)
        {
            $memberManager = new MemberManager();
            $member = $memberManager->getMember($log);
            
            return $member;
        }

        //-------------------------------------------->ADMIN / MEMBER
        /**
         * lastMembersAdmin
         *
         * We call this function wich allowed us to show last members
         * 
         * @return $members
         */
        function lastMembersAdmin()
        {
            $membersManager = new MemberManager(); // Create object
            $members = $membersManager->getLastMembers(); // 
            
            return $members;
        }

        //-------------------------------------------->ADMIN / MEMBER
        /**
         * getMembersAdmin
         * 
         * We call this function wich allowed us to show the members in admin dashbord
         *
         * @return $members
         */
        function getMembersAdmin()
        {
            $membersManager = new MemberManager(); 
            $members = $membersManager->getMembers(); 

            return $members;
        }
        //-------------------------------------------->MEMBER
        /**
         * subscribe
         *
         * @param  string $log
         * @param  string $password
         * 
         * We call this function wich allowed us to subscribe  a new memeber
         *
         * @return void
         */
        function subscribe($log, $password)
        {
            $memberManager = new MemberManager();
            $member = $memberManager->addMember($log, $password);
            
        }
        //-------------------------------------------->MEMBER
        /**
         * verify
         *
         * @param  string $log We call this function wich allowed us to check if a member log is already used
         *
         * @return $member
         */
        function verify($log)
        {
            $memberManager = new MemberManager();
            $verifyMember = $memberManager->verifyMember($log);
            if($verifyMember === false)
            {
                $errorMessage = 'Ce pseudo existe déjà, en choisir un autre ou connectez vous';
            }
            else
            {
                return $verifyMember;
            }
            
        }
        //-------------------------------------------->MEMBER
        /**
         * verifyConnection
         *
         * @param  string $log
         * @param  string $password
         * 
         * We call this function wich allowed us to connect with log and password
         *
         * @return ($member['log'] == $log AND $isPasswordCorrect === $right)
         */
        function verifyConnection($log, $password)
        {
            $memberManager = new MemberManager();
            $member = $memberManager->getMember($log);
            
            $isPasswordCorrect = password_verify($password, $member['password']);
            $right = true;  
            
            return ($member['log'] == $log AND $isPasswordCorrect === $right);  
        }
    }