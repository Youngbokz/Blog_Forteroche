<?php
session_start();
?>
<!--AdminView-->
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

<!--------------------MAIN CONTENT-------------------->
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
            
            <div class="col-md-9">
                <div class="card">
                    <div class="mainColorBg card-header">
                        <h4>ÉDITER OU SUPPRIMER</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?action=editPost" class="col-md-12">
                            <div class="form-group">
                                <label for="newChapter">CHAPITRE</label>
                                <input type="text" class="form-control" id="chapter" name="newChapter" value="<?= htmlspecialchars($post['chapter']) ?>" >
                            </div>
                            <div class="form-group">
                                <label for="title">TITRE</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($post['title']); ?>" >
                            </div>                        
                            <div class="form-group">
                                <label for="content">ÉCRIRE</label>
                                <textarea class="form-control" id="mytextarea" rows="3" name="content"><?= nl2br(htmlspecialchars($post['content'])); ?></textarea>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-dark" type="submit" value="Éditer" name="edit">
                            </div>   
                            <div class="form-group">
                                <input class="btn btn-dark" type="submit" value="Supprimer" name="delete">
                            </div> 
                        </form>
                    </div>
                </div>
            </div>       
        </div>
    </div>
</section>
    
        
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
