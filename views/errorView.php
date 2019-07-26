<?php
/****************************************VIEWS/ERRORVIEW.PHP****************************************/

?>
<?php $title = 'ERREUR | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
    <div class="mainSection firstContainer">
        <div class="subscribeContainer container ">
        <?=
         '<p class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i>  ERREUR <i class="fas fa-exclamation-triangle"></i><br/>' .$errorMessage. '</p>';
        ?>
        </div> 
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('frontend/template.php'); ?>                           