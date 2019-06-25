<?php
// We charge classes 
require('model/CommentManager.php');
require('model/PostManager.php');
require('model/MemberManager.php');
//-------------------------------------------->POST
function lastPost()
{
    $lastPostManager = new PostManager(); // Create object
    $lastPost = $lastPostManager->getLastPost(); // We call this function wich allowed us to show the last post by date
    $lastCommentsManager = new CommentManager(); // Create object
    $lastComments = $lastCommentsManager->allLastComments(); // We call this function wich allowed us to show all last comments by date

    require('views/frontend/homeView.php');
}
//-------------------------------------------->POST
function listPosts($requirePage)
{
    $postsManager = new PostManager(); // Create object
    $posts = $postsManager->getPosts(); // We call this function wich allowed us to show the posts 

    require($requirePage);
}
//-------------------------------------------->POST with COMMENTS
function post($requirePage)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    
    require_once($requirePage);
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
    if(($member['log'] == $log) AND ($isPasswordCorrect === $right))
    {
        // If login and password match we create a $_SESSION
        
        return 1;
    }
    else
    {
        return 0;
    }
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
//-------------------------------------------->ADMIN
function newPost($title, $chapter, $content)
{
    $postManager = new PostManager();
    $post = $postManager->addPost($title, $chapter, $content);

    header('Location: index.php?action=');
}
//-------------------------------------------->ADMIN / MEMBER
function countAll($requirePage)
{
    $membersManager = new MemberManager(); // Create object
    $members = $membersManager->getMembers(); // We call this function wich allowed us to show the members 
    $memberNumber = $membersManager->countMembers();

    $postsManager = new PostManager(); // Create object
    $posts = $postsManager->getPosts(); // We call this function wich allowed us to show the posts 
    $postNumber = $postsManager->countPost();

    $commentsManager = new CommentManager();
    $comments = $commentsManager->allLastComments();
    $reportedComNumber = $commentsManager->countReportedComment();
    
    require_once($requirePage);
}
//-------------------------------------------->ADMIN / POST 
function updatePost($chapter, $title, $content, $postId)
{
    $postManager = new PostManager(); // Create object
    $post = $postManager->editPost($chapter, $title, $content, $postId); // We call this function wich allowed us to show the posts 
    
    require('views/frontend/adminEditView.php');  
}
//-------------------------------------------->COMMENT
function commentStatus($reported, $commentId, $postId) 
{
    $commentManager = new CommentManager();
    $updateReported = $commentManager->updateComStatus($reported, $commentId);

    if($updateReported == false)
    {
        echo'Impossible de signalé les messages';
    }
    else
    {
        header('Location: index.php?action=post&id='. $postId);
    }
}