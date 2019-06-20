<?php
session_start()
?>
<!--adminComView-->
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
            <a class="navbar-brand" href="#">Tableau de Bord</a>
            </div>
            <ul class="nav navbar-nav">
            <li id="creatNewPost"><a href="#"><span><i class="fas fa-feather-alt"></i></span><span> Créer</span></a></li>
            <li id="postsList"><a href="#"><span><i class="fas fa-scroll"></i></span><span> Article(s)</span></a></li>
            <li id="usersList" class="active"><a href="#"><span><i class="fas fa-user"></i></span><span> Utilisateur(s)</span></a></li>
            <li id="commentsList"><a href="#"><span><i class="fas fa-comments"></i></span><span> Commentaire(s)</span></a></li>
            </ul>
        </div>
    </nav>
   
    
    <!---------------------------------------------------------------------------------->
    <div id="listCom_Admin" class="container">
        <div class="list-group">
        <?php
            while ($data = $comments->fetch())
            {
        ?>
                <a href="#" class="list-group-item list-group-item-action active">
                    <span><?= htmlspecialchars($data['comment']); ?></span>
                    <br/>
                    <span><?= htmlspecialchars($data['author']); ?></span>
                    <br/>
                    <span><?= htmlspecialchars($data['comment_date_fr']); ?></span>
                </a>
        <?php          
            }
            $comments->closeCursor();
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
