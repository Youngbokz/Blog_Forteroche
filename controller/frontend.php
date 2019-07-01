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
    
    return compact('lastPost', 'lastComments');
    
}

//-------------------------------------------->POST
function listPosts()
{
    $postsManager = new PostManager(); // Create object
    $posts = $postsManager->getPosts(); // We call this function wich allowed us to show the posts 

    return $posts;
}
//-------------------------------------------->POST / ADMIN
function listPostsAdmin()
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
//-------------------------------------------->COMMENT
function commentStatus($reported, $commentId, $postId) 
{
    $commentManager = new CommentManager();
    $updateReported = $commentManager->updateComStatus($reported, $commentId);
    
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