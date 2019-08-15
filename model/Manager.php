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
        
        /**
         * dbConnect
         *
         * Allows to connect to the database
         * 
         * @return $db
         */
        protected function dbConnect() 
        {
            try
            {
                $this->db = new \PDO('mysql:host=localhost;dbname=forteroche_blog;charset=utf8', 'root', 'root', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
                //$this->db = new \PDO('mysql:host=db761026471.hosting-data.io;dbname=db761026471;charset=utf8', 'dbo761026471', 'P@ntera10', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
                return $this->db;
            }
            catch(Exception $e)
            {
                throw new Exception('Erreur : ' . $e->getMessage());
            }
        }
    }