<?php
/****************************************MODEL/POSTMANAGER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Model;

    require_once("model/Manager.php");

    /**
     * PostManager class
     * Allowing to create, read, edit and delete posts
     */
    class PostManager extends Manager
    {
        /**
         * getPosts
         *
         * Allows to display all posts in this case by 5 
         * 
         * @return $req
         */
        public function getPosts() 
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, chapter, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr FROM posts ORDER BY post_date DESC LIMIT 0, 5');
        
            return $req;
        } 
        /**
         * getPost
         *
         * @param  int $postId Allows to get a post by its id
         *
         * @return $post
         */
        public function getPost($postId) 
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id, chapter, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr FROM posts WHERE id = ?');
            $req->execute(array($postId));
            $post = $req->fetch();
        
            return $req;
        }
        /**
         * getLastPost
         *
         * Allows to show the last post in this case by only by 1
         * 
         * @return $req
         */
        public function getLastPost() 
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, chapter, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr FROM posts ORDER BY post_date DESC LIMIT 0, 1');
            
            return $req;
        }
        /**
         * addPost
         *
         * @param  string $title
         * @param  string $chapter
         * @param  string $content
         *
         * Allows to create a new chapter with title, chapter name and content
         * 
         * @return $addComment
         */
        public function addPost($title, $chapter, $content)  
        {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO posts (title, chapter, content, post_date) VALUES (?, ?, ?, now())');
            $addComment = $req->execute(array($title, $chapter, $content));

            return $addComment; 
        }
        /**
         * editPost
         *
         * @param  string $chapter
         * @param  string $title
         * @param  string $content
         * @param  int $postId
         *
         * Allows to edit a post. Can change its title, chapter name and content
         * 
         * @return void
         */
        public function editPost($chapter, $title, $content, $postId) // Permet d'éditer un post déjà existant en changeant de titre et de contenu
        {
            $db = $this->dbConnect();
            $req = $db->prepare('UPDATE posts SET chapter = :chapter, title = :title, content = :content WHERE id = :id');
            $req->execute(array(
                'chapter' => $chapter,
                'title' => $title, 
                'content' => $content, 
                'id' => $postId
            ));
        }
        /**
         * deletePost
         *
         * @param  int $postId
         * 
         * Allows to delete a post by its id 
         *
         * @return void
         */
        public function deletePost($postId) 
        {
            $db = $this->dbConnect();
            $req = $db->prepare('DELETE FROM posts WHERE id = :postId');
            $req->execute(array(
                'postId' => $postId 
            ));
        }
        /**
         * countPost
         *
         * Allows to count post
         * 
         * @return $countingPost
         */
        public function countPost()
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT COUNT(*) FROM posts');
            $req->execute();
            $countingPost = $req->fetchColumn();
            
            return $countingPost;
        }
        public function unsetDb(){
            $db = $this->dbConnect();
            unset($db);
        }
    }