<?php
session_start()
?>
<!--AdminView-->
<?php $title = 'ADMINISTRATEUR | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
<?php
if(isset($_SESSION['login']) AND $_SESSION['login'] == 'admin')
{
?>
<div class="mainAdminContainer container-fluid">
    <nav class="sideAdminNav navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="index.php?action=admin">Tableau de Bord</a>
            </div>
            <ul class="nav navbar-nav">
            
            <li id="postsList"><a href="index.php?action=adminArticle"><span><i class="fas fa-scroll"></i></span><span> Article(s)</span></a></li>
            <li id="usersList" class="active"><a href="index.php?action=adminUsers"><span><i class="fas fa-user"></i></span><span> Utilisateur(s)</span></a></li>
            <li id="commentsList"><a href="index.php?action=adminCom"><span><i class="fas fa-comments"></i></span><span> Commentaire(s)</span></a></li>
            </ul>
        </div>
    </nav>
    <div id="newPost_Admin" class="container">
        <form method="post" action="index.php?action=addpost">
            <h4>CRÉEZ</h4>
            <div class="form-group">
                <label for="chapter">ÉPISODE 1</label>
                <input type="text" class="form-control" id="chapter" name="chapter" placeholder="Chapitre 1">
            </div>
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Titre" >
            </div>
            
            <div class="form-group">
                <label for="content">Écrire</label>
                <textarea class="form-control" id="content" rows="3" name="content" placeholder="Il était une fois ..."></textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-dark" type="submit" value="Poster" name="submit">
            </div>   
        </form>
    </div>  
</div>
        
<?php
}
else
{
    echo'<div class="alert alert-danger" role="alert" style="margin-top: 150px;">
    Vous n\'êtes pas l\'administrateur du site !
  </div>';
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 
