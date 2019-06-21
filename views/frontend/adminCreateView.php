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
<header id="header" class="navAdmin fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1><a class="navbar-brand" href="index.php?action=admin"><i class="fas fa-user-cog"></i></a>  Tableau de Bord   <small>Gérer votre site ici</small></h1>
            </div>
            <div class="col-md-2">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Gérer 
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="index.php?action=adminCreate">Créer un chapitre</a></li>
                        <li><a href="#">Modifier un chapitre</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mainAdminContainer container-fluid">
    
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
