<?php
/****************************************MODEL/MEMBERMANAGER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Model;

    require_once("model/Manager.php");

    /**
     * MemberManager class
     * Allowing to create, read, edit and delete members
     */
    class MemberManager extends Manager
    {
        /**
         * verifyIfMemberExist
         *
         * @param  string $log Allows to verify if member already exist by its log
         *
         * @return $verifyLog
         */
        public function verifyIfMemberExist($log) 
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT log FROM members WHERE log = ?');
            $req->execute(array($log));
            $verifyLog = $req->rowCount();
            return $verifyLog;
        }
        /**
         * getLastMembers
         *
         * Allows you to select all the members according to their log and in order of registration
         * 
         * @return $req
         */
        public function getLastMembers()  
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, log, password, DATE_FORMAT (registration_date, \'%d/%m/%Y à %Hh%imin%ss\') AS registration_date_fr FROM members ORDER BY log, registration_date DESC LIMIT 0, 3');

            return $req;
        }
        /**
         * getMembers
         *
         * Allows you to select all members by their log in alphabetical order
         * 
         * @return $req
         */
        public function getMembers() 
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id, log, password, DATE_FORMAT (registration_date, \'%d/%m/%Y à %Hh%imin%ss\') AS registration_date_fr FROM members ORDER BY log ASC LIMIT 0, 5');

            return $req;
        }
        /**
         * getMember
         *
         * @param  string $log Allows to select a single member
         *
         * @return $result
         */
        public function getMember($log) 
        {
            $db = $this->dbConnect();
            $member = $db->prepare('SELECT id, log, password, DATE_FORMAT(registration_date, \'%d/%m/%Y à %Hh%imin%ss\') AS registration_date_fr FROM members WHERE log = ?');
            $member->execute(array($log));
            $result = $member->fetch();

            return $result;
        }
        /**
         * addMember
         *
         * @param  string $log
         * @param  string $password
         *
         * Allows to add a new member
         * 
         * @return $newMember
         */
        public function addMember($log, $password) 
        {
            $pass_hache = password_hash($password, PASSWORD_DEFAULT);
            $db = $this->dbConnect();
            $member = $db->prepare('INSERT INTO members(log, password, registration_date) VALUES(?, ?, NOW())');
            $newMember = $member->execute(array($log, $pass_hache));

            return $newMember;
        }
        /**
         * editMember
         *
         * @param  string $log
         * @param  string $password
         * @param  int $memberId
         *
         * Allows to edit member log and password
         * 
         * @return $changedMember
         */
        public function editMember($log, $password, $memberId) 
        {
            $db = $this->dbConnect();
            $member = $db->prepare('UPDATE members SET log = ?, password = ? WHERE id = ?');
            $changedMember = $member->execute(array($log, $password, $memberId));
                
            return $changedMember;
        }
        /**
         * deleteMember
         *
         * @param  int $memberId Allows to delete a member by his id
         * 
         * @return void
         */
        public function deleteMember($memberId) 
        {
            $db = $this->dbConnect();
            $eraseMember = $db->prepare('DELETE FROM members WHERE id = ?');
            $req->execute(array($memberId));
        }
        /**
         * countMembers
         *
         * Allows to count members
         * 
         * @return $countingMember
         */
        public function countMembers()
        {
            $db = $this->dbConnect();
                $req = $db->query('SELECT COUNT(*) FROM members');
                $req->execute();
                $countingMember = $req->fetchColumn();
                
                return $countingMember;
        }
    }