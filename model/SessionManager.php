<?php
/****************************************MODEL/SESSIONMANAGER.PHP****************************************/

    namespace Youngbokz\Blog_Forteroche\Model;

    
    
    /**
     * SessionManager class
     * Set sessions
     */

    class SessionManager 
    {
        /**
         * public function __construct start the session at page is load
         *
         * @return void
         */
        public function __construct()
        {
            session_start();
        }

        /**
         * public function setFlashMessage
         *
         * @param  string $message error or success flash message
         * @param  string $color set the color name of bootstrap 
         *
         * @return void
         */
        public function setFlashMessage($message, $color = "primary")
        {
            $_SESSION['flash'] = [
                "color" => $color,
                "message" => $message];
        }

        public function showFlash()
        {
            if(!empty($_SESSION['flash']))
            {
                ?>
                    <div class="alert alert-<?= $_SESSION['flash']['color']; ?> alert-dismissible fade show" role="alert">
                    <strong><?= $_SESSION['flash']['message']; ?></strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php
                if('<span aria-hidden="false">&times;</span>')
                {
                    unset($_SESSION['flash']);
                }
            }
        }
    }