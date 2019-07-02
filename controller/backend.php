<?php
/****************************************CONTROLLER/BACKEND.PHP****************************************/
// We charge classes 
require_once('model/CommentManager.php');
require_once('model/PostManager.php');
require_once('model/MemberManager.php');

use \Youngbokz\Blog_Forteroche\Model\PostManager;
use \Youngbokz\Blog_Forteroche\Model\CommentManager;
use \Youngbokz\Blog_Forteroche\Model\MemberManager;
//-------------------------------------------->POST / ADMIN
function listPostsAdmin()
{
    $postsManager = new PostManager(); // Create object
    $posts = $postsManager->getPosts(); // We call this function wich allowed us to show the posts 
    return $posts;
}
//-------------------------------------------->ADMIN
function newPost($title, $chapter, $content)
{
    $postManager = new PostManager();
    $post = $postManager->addPost($title, $chapter, $content);
    

    header('Location: index.php?action=');
}
//-------------------------------------------->ADMIN / MEMBER
function countAll()
{
    $membersManager = new MemberManager(); // Create object
    $memberNumber = $membersManager->countMembers();

    $postsManager = new PostManager(); // Create object
    $postNumber = $postsManager->countPost();

    $commentsManager = new CommentManager();
    $reportedComNumber = $commentsManager->countReportedComment();

    return compact('memberNumber', 'postNumber', 'reportedComNumber');
}
//-------------------------------------------->ADMIN / MEMBER
function lastMembersAdmin()
{
    $membersManager = new MemberManager(); // Create object
    $members = $membersManager->getLastMembers(); // We call this function wich allowed us to show the members 
    return $members;
}
//-------------------------------------------->ADMIN / MEMBER
function getMembersAdmin()
{
    $membersManager = new MemberManager(); // Create object
    $members = $membersManager->getMembers(); // We call this function wich allowed us to show the members 
    return $members;
}
//-------------------------------------------->ADMIN / COMMENTS
function reportedCommentAdminList()
{
    $commentsManager = new CommentManager();
    $comments = $commentsManager->reportedListComments();

    return $comments;
}
//-------------------------------------------->ADMIN / POST 
function updatePost($chapter, $title, $content, $postId)
{
    $postManager = new PostManager(); // Create object
    $postUpdate = $postManager->editPost($chapter, $title, $content, $postId); // We call this function wich allowed us to show the posts 
    
    header('Location: index.php?action=goEditArticle&id=' . $postId);
    //require('views/frontend/adminEditView.php');  
}
//-------------------------------------------->COMMENT ADMIN
function commentStatusAdmin($reported, $commentId) 
{
    $commentManager = new CommentManager();
    $updateReported = $commentManager->updateComStatus($reported, $commentId);
    
}
//-------------------------------------------->POST / ADMIN
function erasePost($postId) 
{
    $postManager = new PostManager(); // Create object
    $deletedPost = $postManager->deletePost($postId);

    header('Location: index.php?action=goEditArticle&id=' . $postId);
}
//-------------------------------------------->COMMENT / ADMIN
function eraseRepotedCom($commentId) 
{
    $commentManager = new CommentManager();
    $deletedReported = $commentManager->deleteReportedComment($commentId);

    header('Location: index.php?action=adminCom');
}