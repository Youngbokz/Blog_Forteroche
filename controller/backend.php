<?php
/****************************************CONTROLLER/BACKEND.PHP****************************************/
// We charge classes 
require_once('model/CommentManager.php');
require_once('model/PostManager.php');
require_once('model/MemberManager.php');


//-------------------------------------------->POST / ADMIN
function listPostsAdmin()
{
    $postsManager = new \Youngbokz\Blog_Forteroche\Model\PostManager(); // Create object
    $posts = $postsManager->getPosts(); // We call this function wich allowed us to show the posts 
    return $posts;
}
//-------------------------------------------->ADMIN
function newPost($title, $chapter, $content)
{
    $postManager = new \Youngbokz\Blog_Forteroche\Model\PostManager();
    $post = $postManager->addPost($title, $chapter, $content);
    

    header('Location: index.php?action=');
}
//-------------------------------------------->ADMIN / MEMBER
function countAll()
{
    $membersManager = new \Youngbokz\Blog_Forteroche\Model\MemberManager(); // Create object
    $memberNumber = $membersManager->countMembers();

    $postsManager = new \Youngbokz\Blog_Forteroche\Model\PostManager(); // Create object
    $postNumber = $postsManager->countPost();

    $commentsManager = new \Youngbokz\Blog_Forteroche\Model\CommentManager();
    $reportedComNumber = $commentsManager->countReportedComment();

    return compact('memberNumber', 'postNumber', 'reportedComNumber');
}
//-------------------------------------------->ADMIN / MEMBER
function lastMembersAdmin()
{
    $membersManager = new \Youngbokz\Blog_Forteroche\Model\MemberManager(); // Create object
    $members = $membersManager->getLastMembers(); // We call this function wich allowed us to show the members 
    return $members;
}
//-------------------------------------------->ADMIN / MEMBER
function getMembersAdmin()
{
    $membersManager = new \Youngbokz\Blog_Forteroche\Model\MemberManager(); // Create object
    $members = $membersManager->getMembers(); // We call this function wich allowed us to show the members 
    return $members;
}
//-------------------------------------------->ADMIN / COMMENTS
function reportedCommentAdminList()
{
    $commentsManager = new \Youngbokz\Blog_Forteroche\Model\CommentManager();
    $comments = $commentsManager->reportedListComments();

    return $comments;
}
//-------------------------------------------->ADMIN / POST 
function updatePost($chapter, $title, $content, $postId)
{
    $postManager = new \Youngbokz\Blog_Forteroche\Model\PostManager(); // Create object
    $postUpdate = $postManager->editPost($chapter, $title, $content, $postId); // We call this function wich allowed us to show the posts 
    
    header('Location: index.php?action=goEditArticle&id=' . $postId);
    //require('views/frontend/adminEditView.php');  
}
//-------------------------------------------->COMMENT ADMIN
function commentStatusAdmin($reported, $commentId) 
{
    $commentManager = new \Youngbokz\Blog_Forteroche\Model\CommentManager();
    $updateReported = $commentManager->updateComStatus($reported, $commentId);
    
}
//-------------------------------------------->POST / ADMIN
function erasePost($postId) 
{
    $postManager = new \Youngbokz\Blog_Forteroche\Model\PostManager(); // Create object
    $deletedPost = $postManager->deletePost($postId);

    header('Location: index.php?action=goEditArticle&id=' . $postId);
}
//-------------------------------------------->COMMENT / ADMIN
function eraseRepotedCom($commentId) 
{
    $commentManager = new \Youngbokz\Blog_Forteroche\Model\CommentManager();
    $deletedReported = $commentManager->deleteReportedComment($commentId);

    header('Location: index.php?action=adminCom');
}