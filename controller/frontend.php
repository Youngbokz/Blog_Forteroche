<?php
/****************************************CONTROLLER/FRONTEND.PHP****************************************/

// We charge classes 
require_once('model/CommentManager.php');
require_once('model/PostManager.php');
require_once('model/MemberManager.php');

use \Youngbokz\Blog_Forteroche\Model\PostManager;
use \Youngbokz\Blog_Forteroche\Model\CommentManager;
use \Youngbokz\Blog_Forteroche\Model\MemberManager;

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
    $postsManager = new PostManager(); // Create object
    $posts = $postsManager->getPosts(); // 

    return $posts;
}
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

    require('views/frontend/loginView.php');
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
    $member = $memberManager->verifyMember($log);

    return $member;
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
function newComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->addComment($postId, $author, $comment);

    if ($comment === false) {
        echo'Impossible d\'ajouter le commentaire !';
    }
    else {
        header('Location: index.php?action=post&id=' . $postId); //send back to post page with the id of the post. 
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
