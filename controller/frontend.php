<?php
// We charge classes 
require('model/CommentManager.php');
require('model/PostManager.php');

function lastPost()
{
    $postManager = new PostManager(); // Create object
    $lastPost = $postManager->getLastPost(); // We call this function wich allowed us to show the last post by id

    require('views/frontend/homeView.php');
}

function listPosts()
{
    $postManager = new PostManager(); // Create object
    $posts = $postManager->getPosts(); // We call this function wich allowed us to show the posts 

    require('views/frontend/listPostsView.php');
}
?>
