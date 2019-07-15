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
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        
                        <strong class="mr-auto"><?= $_SESSION['flash']['message']; ?></strong>
                        
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        <?= $_SESSION['flash']['message']; ?>
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                        $('.toast').toast('show');
                        setTimeout(() => {
                            $('.toast').hide('fade');
                        }, 3000);
                    });
                <script>
                   
<?php
                
            }
        }
    }
?>
    