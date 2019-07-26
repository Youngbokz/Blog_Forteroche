<?php
/****************************************VIEWS/FRONTEND/ADMINCOMVIEW.PHP****************************************/
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
                <h1><a class="navbar-brand" href="index.php?action=admin"><i class="fas fa-user-cog"></i></a>  <span class="dashboard_quote">Tableau de Bord</span>   <small class="deal_quote">Gérer votre site ici</small></h1>
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
            <div class="col-md-9">
                    <div class="card">
                        <div class="mainColorBg card-header">
                            <h3>Commentaires Signalés</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <tr class="info_ligne">
                                    <th class="info_ligne">N°</th>
                                    <th>NOM</th>
                                    <th class="info_ligne">DATE</th>
                                    <th>RESTAURER</th>
                                    <th>SUPPRIMER</th>
                                </tr>
                                <?php
                                while ($data = $repotedComments->fetch())
                                {
                                ?>
                                    <tr>
                                        <td class="info_ligne"><span class="badge badge-light"><?= htmlspecialchars($data['id']); ?></span></td>
                                        <td><?= htmlspecialchars($data['author']); ?></td>
                                        <td class="info_ligne"><?= htmlspecialchars($data['comment_date_fr']); ?></td>
                                        <td><a type="submit" href="index.php?action=restoreReportedCom&amp;id=<?= $data['id'] ;?>" class="btn btn-secondary btn-sm">Restaurer  <i class="far fa-hand-point-down"></i></a></td>
                                        <td><a type="submit" name="deleteReported" href="index.php?action=deleteReportedCom&amp;id=<?= $data['id'] ;?>" class="btn btn-danger btn-sm">Supprimer  <i class="far fa-hand-point-down"></i></span></a></td>
                                    </tr>
                                    <tr>
                                        <td colspan=5>       
                                            <?= substr( htmlspecialchars($data['comment']), 0, 200); ?>
                                        </td>
                                    </tr>
                                <?php          
                                }
                                $repotedComments->closeCursor();
                                ?>
                            </table>
                        </div>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="index.php?action=adminCom&page=<?= ($currentPage - 1); ?>" tabindex="-1" aria-disabled="true"><i class="fas fa-long-arrow-alt-left"></i></a>
                            </li>
                            <?php
                            for($i=1; $i<= $totalPage; $i++)
                            {
                                if($i == $currentPage)
                                {           
                            ?>          
                                    <li class="page-item"><a class="page-link active" ><?= $i; ?></a></li>
                            <?php
                                }
                                else
                                {
                            ?>
                                    <li class="page-item"><a class="page-link" href="index.php?action=adminCom&page=<?= $i; ?>"><?= $i; ?></a></li>
                            <?php
                                }
                            }
                            
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?action=adminCom&page=<?= ($currentPage + 1); ?>"><i class="fas fa-long-arrow-alt-right"></i></a>
                            </li>
                        </ul>
                    </nav>
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
