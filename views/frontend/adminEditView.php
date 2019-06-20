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
            <li id="creatNewPost"><a href="index.php?action=adminCreate"><span><i class="fas fa-feather-alt"></i></span><span> Créer</span></a></li>
            <li id="usersList" class="active"><a href="index.php?action=adminUsers"><span><i class="fas fa-user"></i></span><span> Utilisateur(s)</span></a></li>
            <li id="commentsList"><a href="index.php?action=adminCom"><span><i class="fas fa-comments"></i></span><span> Commentaire(s)</span></a></li>
            </ul>
        </div>
    </nav>
    
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
