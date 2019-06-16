<?php
session_start()
?>
<!--AdminView-->
<?php $title = 'ADMINISTRATEUR | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
<?php
if(isset($_SESSION['login']))
{
?>
<div class="mainAdminContainer container-fluid">
    <nav class="sideAdminNav navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">Tableau de Bord</a>
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="#"><span><i class="fas fa-user"></i></span><span> Utilisateur(s)</span></a></li>
        <li><a href="#"><span><i class="fas fa-scroll"></i></span><span> Article(s) posté(s)</span></a></li>
        <li><a href="#"><span><i class="fas fa-feather-alt"></i></span><span> Créer</span></a></li>
        <li><a href="#"><span><i class="fas fa-comments"></i></span><span> Commentaire(s)</span></a></li>
        </ul>
    </div>
    </nav>
    <div class="container">
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
    <!---------------------------------------------------------------------------------->
    <div class="container">
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
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 
