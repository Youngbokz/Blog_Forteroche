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
        $req->execute(array($postId));

        return $req;
    }

    public function getComment($commentId) //permet d'afficher un seul commentaire 
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT id, author, comment, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $comment->execute(array($commentId));

        return $comment;
    }

    public function allLastComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, comment, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY comment_date DESC LIMIT 0, 3');
        
        return $req;
    }

    public function reportedListComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, comment, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, reported FROM comments WHERE reported = 1 ORDER BY comment_date DESC LIMIT 0, 3');
        
        return $req;
    }

    public function updateReportedCommentValue($reported, $commentId, $postId)
    {
        $db = $this->dbConnect();
        $newComment = $db->prepare('UPDATE comments SET reported = ? WHERE id = ?, post_id = ?');
        $affectedComment = $newComment->execute(array($reported, $commentId, $postId));

        return $affectedComment;
    }

    public function addComment($postId, $author, $comment) // permet l'ajout d'un commentaire
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, reported) VALUES(?, ?, ?, NOW(), "0")');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function editComment($comment, $commentId, $postId) // permet la modification d'un commentaire existant
    {
        $db = $this->dbConnect();
        $newComment = $db->prepare('UPDATE comments SET comment = ? WHERE id = ?, post_id = ?');
        $affectedComment = $newComment->execute(array($comment, $commentId, $postId));
            
        return $affectedComment;
    }

    public function deleteComment($commentId) // Permet la suppression d'un message selon son id
    {
        $db = $this->dbConnect();
        $eraseComment = $db->prepare('DELETE comments WHERE id = ?');
        $req->execute(array($postId));
    }       

    public function countReportedComment()
    {
        $db = $this->dbConnect();
            $req = $db->query('SELECT COUNT(*) FROM comments WHERE reported = 1');
            $req->execute();
            $countingReported = $req->fetchColumn();
            
            return $countingReported;
    }

    public function updateComStatus($reported, $commentId)
    {
        $db = $this->dbConnect();
        $commentStatus = $db->prepare('UPDATE comments SET reported = ? WHERE id = ?');
        $affectedComment = $commentStatus->execute(array($reported, $commentId));
        
        return $affectedComment;
    }
}