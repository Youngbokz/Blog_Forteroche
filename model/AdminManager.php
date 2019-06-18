<?php

//namespace Blog_Forteroche\Model;

require_once("model/Manager.php");

class AdminManager extends Manager
{
    public function __construct()
    {

    }

    /**
     * METHOD
     */
    
    
    public function getAdmin($name) //permet de selectionner l'administrateur
    {
        $db = $this->dbConnect();
        $member = $db->prepare('SELECT name, password FROM admin WHERE name = JeanForteroche');
        $result = $admin->fetch();

        return $result;
    }

        
}