<?php
/****************************************CONTROLLER/FRONTEND.PHP****************************************/
// We charge classes 
require_once('model/CommentManager.php');
require_once('model/PostManager.php');
require_once('model/MemberManager.php');
//-------------------------------------------->POST
function lastPost()
{
    $lastPostManager = new PostManager(); // Create object
    $lastPost = $lastPostManager->getLastPost(); // We call this function wich allowed us to show the last post by date
    
    $lastCommentsManager = new CommentManager(); // Create object
    $lastComments = $lastCommentsManager->allLastComments(); // We call this function wich allowed us to show all last comments by date
    
    return compact('lastPost', 'lastComments');
    
}

//-------------------------------------------->POST
function listPosts()
{
    $postsManager = new PostManager(); // Create object
    $posts = $postsManager->getPosts(); // We call this function wich allowed us to show the posts 

    return $posts;
}

//-------------------------------------------->POST with COMMENTS
function post($postId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);
    
    return compact('post', 'comments');
}
//-------------------------------------------->POST / ADMIN
function postAdmin($postId)
{
    $postManager = new PostManager();
    $post = $postManager->getPost($postId);
    
    return $post;
    
} 

//-------------------------------------------->MEMBER
function subscribe($log, $password)
{
    $memberManager = new MemberManager();

    $member = $memberManager->addMember($log, $password);

    require('views/frontend/loginView.php');
}
//-------------------------------------------->MEMBER
function verify($log)
{
    $memberManager = new MemberManager();
    $member = $memberManager->verifyMember($log);
    return $member;
}
//-------------------------------------------->MEMBER
function verifyConnection($log, $password)
{
    $memberManager = new MemberManager();
    $member = $memberManager->getMember($log);
   
    $isPasswordCorrect = password_verify($password, $member['password']);
    $right = true;
    return ($member['log'] == $log AND $isPasswordCorrect === $right);
}
//-------------------------------------------->MEMBER
function member($log)
{
    $memberManager = new MemberManager();
    $member = $memberManager->getMember($log);
    return $member;
}
//-------------------------------------------->COMMENT
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
function commentStatus($reported, $commentId, $postId) 
{
    $commentManager = new CommentManager();
    $updateReported = $commentManager->updateComStatus($reported, $commentId);
    
}
