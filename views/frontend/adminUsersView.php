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
            <li id="postsList"><a href="index.php?action=adminArticle"><span><i class="fas fa-scroll"></i></span><span> Article(s)</span></a></li>
            
            <li id="commentsList"><a href="index.php?action=adminCom"><span><i class="fas fa-comments"></i></span><span> Commentaire(s)</span></a></li>
            </ul>
        </div>
    </nav>
    
    <!---------------------------------------------------------------------------------->
    <div id="listUser_Admin" class="container">
        <div class="list-group">
        <?php
            while ($data = $members->fetch())
            {
        ?>
                <a href="#" class="list-group-item list-group-item-action active"><?= htmlspecialchars($data['log']); ?></a>
        <?php          
            }
            $members->closeCursor();
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
