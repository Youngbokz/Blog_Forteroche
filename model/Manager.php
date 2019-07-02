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
            try{
                $db = new \PDO('mysql:host=localhost;dbname=forteroche_blog;charset=utf8', 'root', 'root', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
                return $db;
            }
            catch(Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
        }
    }