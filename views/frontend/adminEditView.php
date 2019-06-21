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
   
    
    <!---------------------------------------------------------------------------------->
    <div id="listPost_Admin" class="container">
            <div class="row">
                    <?php
                    while ($data = $posts->fetch())
                    {
                    ?>
                            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">
                                <div class="news">
                                    <p>
                                         Publié le <?= ($data['post_date_fr']); ?>
                                    </p>
                                    <h3><?= htmlspecialchars($data['title']); ?></h3>
                                    
                                </div> 
                            </a>
                    <?php          
                    }
                    $posts->closeCursor();
                    ?>
            </div>
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
