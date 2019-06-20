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
                <h1><i class="fas fa-user-cog"></i>  Tableau de Bord   <small>Gérer votre site ici</small></h1>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
</header>













<div class="mainAdminContainer container-fluid">
    <nav class="sideAdminNav navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="index.php?action=admin">Tableau de Bord</a>
            </div>
            <ul class="nav navbar-nav">
            <li id="creatNewPost"><a href="index.php?action=adminCreate"><span><i class="fas fa-feather-alt"></i></span><span> Créer</span></a></li>
            <li id="postsList"><a href="index.php?action=adminArticle"><span><i class="fas fa-scroll"></i></span><span> Article(s)</span></a></li>
            <li id="usersList" class="active"><a href="index.php?action=adminUsers"><span><i class="fas fa-user"></i></span><span> Utilisateur(s)</span></a></li>
            <li id="commentsList"><a href="index.php?action=adminCom"><span><i class="fas fa-comments"></i></span><span> Commentaire(s)</span></a></li>
            </ul>
        </div>
    </nav>
    
    <div class="adminContent container">
        <!---------------------------------------------------------------------------------->
        <div id="listPost_Admin" class="container">
                <div class="row">
                        <?php
                        while ($data = $posts->fetch())
                        {
                        ?>
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($data['title']); ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($data['content']); ?></p>
                                    <a href="index.php?action=adminArticle" class="btn btn-dark">Modifier</a>
                                </div>
                            </div>
                        <?php          
                        }
                        $posts->closeCursor();
                        ?>
                </div>
        </div>
        
        <!---------------------------------------------------------------------------------->
        <div id="listCom_Admin" class="container">
            <div class="list-group">
                <h3>Derniers Commentaires Signalés</h3>
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
