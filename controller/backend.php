<?php
/****************************************CONTROLLER/BACKEND.PHP****************************************/

    // We charge classes 
    require_once('model/Autoloader.php');

    use \Youngbokz\Blog_Forteroche\Model\Autoloader;
    
    Autoloader::register();

    use \Youngbokz\Blog_Forteroche\Model\PostManager;
    use \Youngbokz\Blog_Forteroche\Model\CommentManager;
    use \Youngbokz\Blog_Forteroche\Model\MemberManager;

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
        
        header('Location: index.php?action=');
    }
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
        //require('views/frontend/adminEditView.php');  
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