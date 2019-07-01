<?php
/****************************************MODEL/POSTMANAGER.PHP****************************************/
//namespace Blog_Forteroche\Model;
    require_once("model/Manager.php");


    /**
     * PostManger class
     * 
     */
    class PostManager extends Manager
    {
        public function __construct()
        {

        }
        /**
         * METHOD
         */

        public function getPosts() // Permets d'afficher les différents épisodes sur une page
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, chapter, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr FROM posts ORDER BY post_date DESC LIMIT 0, 5');
        
            return $req;
        }
        
        public function getPost($postId) // Permet d'afficher un seul épisode selon son id 
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, chapter, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr FROM posts WHERE id = ?');
            $req->execute(array($postId));
            $post = $req->fetch();
        
            return $post;
        }

        public function getLastPost() //Permet d'afficher le dernier post enregistré
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, chapter, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr FROM posts ORDER BY post_date DESC LIMIT 0, 1');
            
            return $req;
        }

        public function addPost($title, $chapter, $content) // Permet d'ajouter un épisode en indiquant le titre et le contenu. la date sera celle de la création 
        {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO posts (title, chapter, content, post_date) VALUES (?, ?, ?, now())');
            $addComment = $req->execute(array($title, $chapter, $content));
            return $addComment; 
        }

        public function editPost($chapter, $title, $content, $postId) // Permet d'éditer un post déjà existant en changeant de titre et de contenu
        {
            $db = $this->dbConnect();
            $req = $db->prepare('UPDATE posts SET chapter = :chapter, title = :title, content = :content WHERE id = :id');
            $req->execute(array(
                'chapter' => $chapter,
                'title' => $title, //= $_POST['title']
                'content' => $content, //= $_POST['content'], 
                'id' => $postId
            ));
        }

        public function deletePost($postId) // Permet la suppression d'un post avec ses commentaires liés en cascade
        {
            $db = $this->dbConnect();
            $req = $db->prepare('DELETE FROM posts WHERE id = :postId');
            $req->execute(array(
                'postId' => $postId //= $_GET['id']
            ));
        }

        public function countPost()
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT COUNT(*) FROM posts');
            $req->execute();
            $countingPost = $req->fetchColumn();
            
            return $countingPost;
        }
    }