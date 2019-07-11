<?php
/****************************************MODEL/MANAGER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Model;
    /**
     * Manager class
     * 
     * Generates a connection to a database
     */
    class Manager
    {
        public $db = null;
        /**
         * dbConnect
         *
         * Allows to connect to the database
         * 
         * @return $db
         */
        protected function dbConnect() 
        {
            if($this->db !== null) //use the connection which is already on 
            {
                return $this->db;
            }
            try{
                $this->db = new \PDO('mysql:host=localhost;dbname=forteroche_blog;charset=utf8', 'root', 'root', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
                return $this->db;
            }
            catch(Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
            return $this->db;
        }
    }