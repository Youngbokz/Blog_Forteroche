<?php
    session_start();

    // Canceled current session
    
    session_destroy();

    // Canceled current cookies login and password
    

    header('Location: index.php');
?>