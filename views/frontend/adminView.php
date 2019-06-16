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
        <li class="active"><a href="#"><i class="fas fa-user"></i> Utilisateur(s)</a></li>
        <li><a href="#"><i class="fas fa-scroll"></i> Article(s) posté(s)</a></li>
        <li><a href="#"><i class="fas fa-feather-alt"></i> Créer</a></li>
        <li><a href="#"><i class="fas fa-comments"></i> Commentaire(s)</a></li>
        </ul>
    </div>
    </nav>
    <div class="container">
        <form method="post" action="index.php?action=addpost">
            <h4>CRÉEZ</h4>
            <div class="form-group">
                <label for="chapter">Chapitre</label>
                <input type="text" class="form-control" id="chapter" name="chapter" placeholder="Chapitre 1">
            </div>
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Titre" >
            </div>
            
            <div class="form-group">
                <label for="content">Écrire</label>
                <textarea class="form-control" id="content" rows="3" name="content"></textarea>
            </div>
            <div class="form-group">
                <label for="sign">Signature</label>
                <input type="text" class="form-control" id="sign" name="sign" placeholder="Jean FORTEROCHE">
            </div>
        </form>
    </div>
</div>
        
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 
