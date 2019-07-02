<?php
/****************************************CONTROLLER/FRONTEND.PHP****************************************/
// We charge classes 
require_once('model/CommentManager.php');
require_once('model/PostManager.php');
require_once('model/MemberManager.php');


//-------------------------------------------->POST
function lastPost()
{
    $lastPostManager = new \Youngbokz\Blog_Forteroche\Model\PostManager(); // Create object
    $lastPost = $lastPostManager->getLastPost(); // We call this function wich allowed us to show the last post by date
    
    $lastCommentsManager = new \Youngbokz\Blog_Forteroche\Model\CommentManager(); // Create object
    $lastComments = $lastCommentsManager->allLastComments(); // We call this function wich allowed us to show all last comments by date
    
    return compact('lastPost', 'lastComments');
    
}

//-------------------------------------------->POST
function listPosts()
{
    $postsManager = new \Youngbokz\Blog_Forteroche\Model\PostManager(); // Create object
    $posts = $postsManager->getPosts(); // We call this function wich allowed us to show the posts 

    return $posts;
}

//-------------------------------------------->POST with COMMENTS
function post($postId)
{
    $postManager = new \Youngbokz\Blog_Forteroche\Model\PostManager();
    $commentManager = new \Youngbokz\Blog_Forteroche\Model\CommentManager();

    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);
    
    return compact('post', 'comments');
}
//-------------------------------------------->POST / ADMIN
function postAdmin($postId)
{
    $postManager = new \Youngbokz\Blog_Forteroche\Model\PostManager();
    $post = $postManager->getPost($postId);
    
    return $post;
    
} 

//-------------------------------------------->MEMBER
function subscribe($log, $password)
{
    $memberManager = new \Youngbokz\Blog_Forteroche\Model\MemberManager();

    $member = $memberManager->addMember($log, $password);

    require('views/frontend/loginView.php');
}
//-------------------------------------------->MEMBER
function verify($log)
{
    $memberManager = new \Youngbokz\Blog_Forteroche\Model\MemberManager();
    $member = $memberManager->verifyMember($log);
    return $member;
}
//-------------------------------------------->MEMBER
function verifyConnection($log, $password)
{
    $memberManager = new \Youngbokz\Blog_Forteroche\Model\MemberManager();
    $member = $memberManager->getMember($log);
   
    $isPasswordCorrect = password_verify($password, $member['password']);
    $right = true;
    return ($member['log'] == $log AND $isPasswordCorrect === $right);
}
//-------------------------------------------->MEMBER
function member($log)
{
    $memberManager = new \Youngbokz\Blog_Forteroche\Model\MemberManager();
    $member = $memberManager->getMember($log);
    return $member;
}
//-------------------------------------------->COMMENT
function newComment($postId, $author, $comment)
{
    $commentManager = new \Youngbokz\Blog_Forteroche\Model\CommentManager();
    $comment = $commentManager->addComment($postId, $author, $comment);
    if ($comment === false) {
        echo'Impossible d\'ajouter le commentaire !';
    }
    else {
        header('Location: index.php?action=post&id=' . $postId); //send back to post page with the id of the post. 
    }
}
//-------------------------------------------->COMMENT
function commentStatus($reported, $commentId, $postId) 
{
    $commentManager = new \Youngbokz\Blog_Forteroche\Model\CommentManager();
    $updateReported = $commentManager->updateComStatus($reported, $commentId);
    
}
