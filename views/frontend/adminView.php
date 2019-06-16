<?php
session_start()
?>
<!--AdminView-->
<?php $title = 'ADMINISTRATEUR | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
<?php
if(isset($_SESSION['login']))
{
?>
<div class="mainAdminContainer container-fluid">
    <nav class="sideAdminNav navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">Tableau de Bord</a>
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="#">Utilisateur(s)</a></li>
        <li><a href="#">Article(s) posté(s)</a></li>
        <li><a href="#">Créer</a></li>
        <li><a href="#">Commentaire(s)</a></li>
        </ul>
    </div>
    </nav>
    <div class="container">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam ipsa ratione debitis sint in itaque ea recusandae voluptates at, totam quod consequatur quibusdam neque hic id dignissimos vitae, voluptatum mollitia.
    </div>
</div>
        
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 
