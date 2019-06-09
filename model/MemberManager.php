<?php

//namespace Blog_Forteroche\Model;

require_once("model/Manager.php");

class MemberManager extends Manager
{
    public function __construct()
    {

    }

    /**
     * METHOD
     */
    public function getMembers($log) // Permet de selectionner tout les membres selon leur pseudo
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, log, password, comment_id, DATE_FORMAT (registration_date, \'%d/%m/%Y à %Hh%imin%ss\') AS registration_date_fr FROM members WHERE log = ? ORDER BY log, registration_date DESC LIMIT 10');
        $req->execute(array($log));

        return $req;
    }

    public function getMember($log) //permet d'afficher un seul membre 
    {
        $db = $this->dbConnect();
        $member = $db->prepare('SELECT id, log, password, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin%ss\') AS registration_date_fr FROM members WHERE log = ?');
        $member->execute(array($log));

        return $member;
    }

    public function addMember($log, $password) // permet l'ajout d'un membre
    {
        $db = $this->dbConnect();
        $member = $db->prepare('INSERT INTO members(log, password, comment_id, registration_date) VALUES(?, ?, NOW())');
        $newMember = $member->execute(array($log, $password));

        return $newMember;
    }

    public function editMember($log, $password, $memberId) // permet la modification d'un membre existant pseudo et pass
    {
        $db = $this->dbConnect();
        $member = $db->prepare('UPDATE members SET log = ?, password = ? WHERE id = ?');
        $changedMember = $member->execute(array($log, $password, $memberId));
            
        return $changedMember;
    }

    public function deleteMember($memberId) // Permet la suppression d'un membre selon son id
    {
        $db = $this->dbConnect();
        $eraseMember = $db->prepare('DELETE members WHERE id = ?');
        $req->execute(array($memberId));
    }       
}