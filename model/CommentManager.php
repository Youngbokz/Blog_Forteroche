<?php
/****************************************MODEL/COMMENTMANAGER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Model;

    require_once("model/Manager.php");

    /**
     * CommentManager class
     * Allowing to create, read, edit and delete comments
     */

    class CommentManager extends Manager
    {
        /**
         * getComments
         *
         * @param int $postId allows to view lastest affiliate comments to a post in this case here the last 3
         *
         * @return $req
         */
        public function getComments($postId, $start, $commentPerPage) 
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT (comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, reported FROM comments WHERE post_id = ? ORDER BY comment_date DESC LIMIT ' .$start. ',' .$commentPerPage);
            $req->execute(array($postId));

            return $req;
        }
        public function numberOfCommentByPost($postId)
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT COUNT(*) as total FROM comments WHERE post_id = ? ');
            $req->execute(array($postId));
            $result = $req->fetch();
        
            return $result;
        }
        /**
         * getComment
         *
         * @param  string $commentId allows to display a single comment
         *
         * @return $comment
         */
        public function getComment($commentId) 
        {
            $db = $this->dbConnect();
            $comment = $db->prepare('SELECT id, author, comment, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, reported FROM comments WHERE id = ?');
            $comment->execute(array($commentId));

            return $comment;
        }
        

        /**
         * allLastComments
         *  
         * Allows to see the latest posts in this case here the last 3
         *
         * @return $req
         */
        public function allLastComments()
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, author, comment, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, reported FROM comments ORDER BY comment_date DESC LIMIT 0, 3');
            
            return $req;
        }
        /**
         * reportedListComments
         * 
         * Allows to see the last comments reported in this case last 3
         *
         * @return $req
         */
        public function reportedListComments($start, $repotedCommentPerPage)
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, author, comment, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, reported FROM comments WHERE reported = 1 ORDER BY comment_date DESC LIMIT ' .$start. ',' .$repotedCommentPerPage);
            
            return $req;
        }
        /**
         * updateComStatus
         *
         * @param  int $reported
         * @param  int $commentId
         *
         * Allows 
         * 
         * @return $affectedComment
         */
        public function updateComStatus($reported, $commentId)
        {
            $db = $this->dbConnect();
            $commentStatus = $db->prepare('UPDATE comments SET reported = ? WHERE id = ?');
            $affectedComment = $commentStatus->execute(array($reported, $commentId));
            
            return $affectedComment;
        }
        /**
         * addComment
         *
         * @param  int $postId
         * @param  string $author
         * @param  string $comment
         *
         * Allows to add a comment 
         * 
         * @return $affectedLines
         */
        public function addComment($postId, $author, $comment) 
        {
            $db = $this->dbConnect();
            $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, reported) VALUES(?, ?, ?, NOW(), "0")');
            $affectedLines = $comments->execute(array($postId, $author, $comment));

            return $affectedLines;
        }
        /**
         * editComment
         *
         * @param  string $comment
         * @param  int $commentId
         * @param  int $postId
         *
         * Allows to edit a comment
         * 
         * @return $affectedComment
         */
        public function editComment($comment, $commentId, $postId) // permet la modification d'un commentaire existant
        {
            $db = $this->dbConnect();
            $newComment = $db->prepare('UPDATE comments SET comment = ? WHERE id = ?, post_id = ?');
            $affectedComment = $newComment->execute(array($comment, $commentId, $postId));
                
            return $affectedComment;
        }
        /**
         * deleteReportedComment
         *
         * @param  int $commentId Allows to delete a reported comment
         *
         * @return void
         */
        public function deleteReportedComment($commentId) // Permet la suppression d'un message selon son id
        {
            $db = $this->dbConnect();
            $eraseComment = $db->prepare('DELETE FROM comments WHERE id = ?');
            $eraseComment->execute(array($commentId));
        }       
        /**
         * countReportedComment
         *
         * Allows to count reported comment
         * 
         * @return $countingReported 
         */
        public function countReportedComment()
        {
            $db = $this->dbConnect();
                $req = $db->query('SELECT COUNT(*) FROM comments WHERE reported = 1');
                $req->execute();
                $countingReported = $req->fetchColumn();
                
                return $countingReported;
        } 
        public function numberOfReportedComment()
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT COUNT(*) as total FROM comments WHERE reported = 1');
            
            $result = $req->fetch();
        
            return $result;
        }

    }