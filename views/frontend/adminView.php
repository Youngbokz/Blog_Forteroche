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
                        <li><a href="#">Modifier un chapitre</a></li>
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
            <!--------------------Pannel: Website Overview-------------------->
            <div class="col-md-9">
                <div class="card">
                    <div class="mainColorBg card-header">
                        <h3>Vue Globale</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-4">
                            <div class="card">
                                <h3><a href="index.php?action=adminUsers" class="list-group-item"><i class="fas fa-user"></i><span class="badge "><?= $memberNumber; ?></span></a></h3>
                                <h5>Utilisateurs</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <h3><a href="index.php?action=adminArticle" class="list-group-item"><i class="fas fa-book"></i><span class="badge "><?= $postNumber; ?></span></a> </h3>
                                <h5>Articles</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <h3><a href="index.php?action=adminCom" class="list-group-item"><i class="fas fa-comment-dots"></i><span class="badge "><?= $reportedComNumber; ?></span></a></h3>
                                <h5>Commentaires</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!--------------------Last Users List-------------------->
                <div class="card">
                    <div class="mainColorBg card-header">
                        <h3>Derniers Abonnés</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>NOM</th>
                                <th>DATE D'INSCRIPTION</th>
                            </tr>
                            <?php
                            while ($data = $members->fetch())
                            {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($data['log']); ?></td>
                                    <td><?= $data['registration_date_fr']; ?></td>
                                </tr>
                            <?php          
                            }
                            $members->closeCursor();
                            ?>
                        </table>
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
