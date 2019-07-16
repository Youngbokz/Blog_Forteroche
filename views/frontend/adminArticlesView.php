<?php
/****************************************VIEWS/FRONTEND/ADMINARTICLESVIEW.PHP****************************************/
session_start()
?>
<!--adminComView-->
<?php $title = 'ADMINISTRATEUR | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
<?php
if(isset($_SESSION['login']) AND $_SESSION['login'] == 'admin')
{
?>
<!--------------------Admin Top Nav Bar-------------------->
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
                        <li><a href="index.php?action=adminArticle">Modifier un chapitre</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
 <!---------------------------------------------------------------------------------->
<section id="mainAdminSection">
    <div class="container">
        <div class="row">
            <!--------------------Side Nav Bar-------------------->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="index.php?action=admin" class="head mainColorBg list-group-item active">
                    <i class="fas fa-user-cog"></i> Tableau de Bord
                    </a>
                    
                    <a href="index.php?action=adminArticle" class="list-group-item"><i class="fas fa-book"></i> Articles <span class="badge badge-light"><?= $postNumber; ?></span></a>
                    
                    <a href="index.php?action=adminUsers" class="list-group-item"><i class="fas fa-user"></i> Utilisateurs <span class="badge badge-light"><?= $memberNumber; ?></span></a>
                    <a href="index.php?action=adminCom" class="list-group-item"><i class="fas fa-comment-dots"></i> Commentaires Signalés <span class="badge badge-light"><?= $reportedComNumber; ?></span></a>
                </div>
            </div>
            <!--------------------Pannel: Website Overview-------------------->
            <div class="adminArticles col-md-9">
            <?php
            if(isset($succesMessage))
            {
                echo $succesMessage;
            }
            while ($data = $posts->fetch())
            {
            ?>
                <div class="card text-center col-md-6">
                    <div class="card-header">
                        <h2><?= htmlspecialchars($data['title']); ?></h2>
                    </div>
                    <div class="adminArticles card-body">
                        <h5 class="card-title"><?= htmlspecialchars($data['chapter']); ?></h5>
                        <p class="card-text"><?= nl2br(substr($data['content'], 0, 100)); ?> ...</p>
                    </div>
                    <div class="card-footer text-muted">
                        <p>Publié le <?= $data['post_date_fr']; ?></p>
                        <div class="container">
                            <div class="col-md-6">
                                <a class="btn btn-secondary" role="button" href="index.php?action=post&amp;id=<?= $data['id']; ?>">Voir</a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-outline-secondary" role="button" href="index.php?action=goEditArticle&amp;id=<?= $data['id']; ?>">Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php          
            }
            $posts->closeCursor();
            ?>
            </div>

        </div>
    </div>
</section>           
<?php
}
else
{
    throw new Exception('Vous n\'êtes pas l\'administrateur du site <i class="fas fa-exclamation"></i> <br/>
    <a href="index.php?action=home">(revenir à la page d\'accueuil)</a>');
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 
