<?php

//namespace Blog_Forteroche\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function __construct()
    {

    }

    /**
     * METHOD
     */
    public function getComments($postId) // Permet de selectionner les différent commentaires selon leur post_id
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT (comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC LIMIT 3');
        $comments = $req->execute(array($postId));

        return $comments;
    }

    public function getComment($commentId) //permet d'afficher un seul commentaire 
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT id, author, comment, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $comment->execute(array($commentId));

        return $comment;
    }

    public function addComment($postId, $author, $comment) // permet l'ajout d'un commentaire
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function editComment($comment, $commentId) // permet la modification d'un commentaire existant
    {
        $db = $this->dbConnect();
        $newComment = $db->prepare('UPDATE comments SET comment = ? WHERE id = ?');
        $affectedComment = $newComment->execute(array($comment, $commentId));
            
        return $affectedComment;
    }

    public function deleteComment($commentId) // Permet la suppression d'un message selon son id
    {
        $db = $this->dbConnect();
        $eraseComment = $db->prepare('DELETE comments WHERE id = ?');
        $req->execute(array($postId));
    }       
}