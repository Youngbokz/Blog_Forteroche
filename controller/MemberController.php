<?php
/****************************************MODEL/MEMBERCONTROLLER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Controller;

    // We charge classes 
    require_once('core/Autoloader.php');
    
    use \Youngbokz\Blog_Forteroche\Model\PostManager;
    use \Youngbokz\Blog_Forteroche\Model\CommentManager;
    use \Youngbokz\Blog_Forteroche\Model\MemberManager;
    use \Youngbokz\Blog_Forteroche\Core\Autoloader;
    Autoloader::register();
    
    /**
     * MemberManager class
     * Allowing to create, read, edit and delete member
     */

    class MemberController  
    {
        /**
         * member
         *
         * @param  string $log We call this function wich allowed us to get a member
         *
         * @return $member
         */
        function member($log)
        {
            $memberManager = new MemberManager();
            $member = $memberManager->getMember($log);
            
            return $member;
        }
       
        /**
         * getMembersAdmin
         * 
         * We call this function wich allowed us to show the members in admin dashboard with pagination
         *
         * @return $members
         */
        function getMembersAdmin()
        {
            $postManager = new PostManager();
            $commentManager = new CommentManager();
            $memberManager = new MemberManager();

            $members = $memberManager->getMembers(); 
            $memberNumber = $memberManager->countMembers();
            $postNumber = $postManager->countPosts();
            $reportedComNumber = $commentManager->countReportedComment();

            $totalMemberReq = $memberManager->numberOfMembers();
            $totalMember = $totalMemberReq['total'];
            $memberPerPage = 4;
            
            $totalPage = ceil($totalMember / $memberPerPage);
            
            if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $totalPage)
            {
                $_GET['page'] = intval($_GET['page']);
                $currentPage = $_GET['page'];
            }
            else
            {
                $currentPage = 1;
            }

            $start = ($currentPage - 1) * $memberPerPage;

            $members = $memberManager->getLastMembers($start, $memberPerPage); 

            require('views/backend/adminUsersView.php');   
        }
        
        /**
         * subscribe
         *
         * @param  string $log
         * @param  string $password
         * 
         * We call this function wich allowed us to subscribe  a new memeber
         *
         * @return void
         */
        function subscribeMember($log, $password)
        {
            $memberManager = new MemberManager();
            $member = $memberManager->addMember($log, $password);
            
        }
        
        /**
         * verify
         *
         * @param  string $log We call this function wich allowed us to check if a member log is already used
         *
         * @return $member
         */
        function memberRegistration()
        {
            $memberManager = new MemberManager();
            $username =  htmlspecialchars($_POST['username']);
            $pass =  htmlspecialchars($_POST['pass']);
            $re_pass =  htmlspecialchars($_POST['re_pass']);

            if(isset ($_POST['submit']))
            {
                if(!empty($username) AND 
                !empty($pass) AND
                !empty($re_pass))
                {
                    if(preg_match('#^[a-zA-Z0-9_]{2,16}$#i', ($username))) 
                    {
                        $verifyUsername = $memberManager->verifyIfMemberExist($username);
                       
                        if($verifyUsername == 0) // if log doesnt exist in database
                        {
                            if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$#', ($pass))) 
                            {
                                if($pass === $re_pass)
                                {
                                    $this->subscribeMember($username, $pass);
                                    $succesMessage = '<div class="alert alert-success" role="alert">
                                    Vous êtes enregistré(e), vous pouvez vous connecter!
                                    </div>';
                                    
                                    require('views/frontend/loginView.php');
                                }
                                else
                                {
                                    $errorMessage = '<div class="alert alert-warning" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Mot de passe différents
                                    </div>';
                                    require('views/frontend/subscribeView.php');
                                }
                            }
                            else
                            {
                                $errorMessage = '<div class="alert alert-warning" role="alert">
                                <i class="fas fa-exclamation-triangle"></i>
                                Mot de passe 8 caractères minimum avec au moins 1 minuscule, 1 majuscule et 1 chiffre
                                </div>';
                                require('views/frontend/subscribeView.php');
                            }
                        }
                        else
                        {
                            $errorMessage = '<div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            Ce pseudo existe déjà, choisir un autre ou vous connectez
                            </div>';
                            require('views/frontend/subscribeView.php');
                            
                        }
                    }
                    else
                    {
                        $errorMessage = '<div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        Votre pseudo doit comporter au moins 2 lettres
                        </div>';
                        require('views/frontend/subscribeView.php');
                    }
                }
                else
                {
                    $errorMessage = '<div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    Veuillez renseigner tout les champs !
                    </div>';
                    require('views/frontend/subscribeView.php');
                }
            }
            else
            {
                $errorMessage = '<div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                Formulaire n\'a pas été envoyé
                </div>';
                require('views/frontend/subscribeView.php');
            }

            ;
            
            
        }
        
        /**
         * verifyConnection
         *
         * We call this function wich allowed us to connect with log and password
         * 
         * @return void
         */
        function verifyConnection()
        {
            $memberManager = new MemberManager();
            
            $loginConnex = htmlspecialchars($_POST['login']);
            $passConnex = htmlspecialchars($_POST['pass']);
 
            if(isset($_POST['submit']))
            {
                if(!empty($loginConnex) AND !empty($passConnex))
                {
                    $verifyMember = $memberManager->getMember($loginConnex);
                    $isPasswordCorrect = password_verify($passConnex, $verifyMember['password']);
                    $right = true;  
                    
                    if($verifyMember['log'] == $loginConnex AND $isPasswordCorrect === $right)
                    {
                        session_start();
                        $result = $this->member($loginConnex);
                        $_SESSION['loginSession'] = $result['log'];
                        $_SESSION['id'] = $result['id'];
                        $_SESSION['registration_date'] = $result['registration_date_fr'];

                        header('location: index.php?action=home');
                    }
                    else
                    {
                        
                        $errorMessage = '<div class="alert alert-warning" role="alert">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Mauvais mot de passe ou pseudo inconnue
                                        </div>';
                        require('views/frontend/loginView.php');
                    }
                }
                else
                {
                    $errorMessage = '<div class="alert alert-warning" role="alert">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Veuillez renseignez tout les champs
                                        </div>';
                    require('views/frontend/loginView.php');
                }
            }
            else
            {
                $errorMessage = '<p>Formulaire n\'a pas été envoyé</p>';
                require('views/frontend/loginView.php');
            }
        }
    }