<?php
   
    class Manager
    {
        protected function dbConnect() // Déclaration de la base de données qui est réutilisé à chaque fois
        {
            try{
                $db = new PDO('mysql:host=localhost;dbname=forteroche_blog;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                return $db;
            }
            catch(Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
        }
    }