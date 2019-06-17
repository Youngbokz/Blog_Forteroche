<!----------template.php---------->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--Bootstrap CDN-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!--<link rel="stylesheet" href="public/css/bootstrap.min.css" >-->
        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <script src="public/js/custom.js"></script>
        <script src="https://kit.fontawesome.com/0b86a7eaab.js"></script> 
        <title><?= $title ?></title>
    </head>
        
    <body class="text-center">
        <div id="container"><!--Menu-->
            <nav class="fixMainBarr main-navbar navbar fixed-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav col-4">
                        <li class="active"> <a href="index.php?action=home">ACCUEIL</a> </li>
                        <li> <a href="index.php?action=listPosts">ROMAN</a> </li>
                        <li> <a href="aboutme.html">À PROPOS</a> </li>
                    </ul>                 
                    <div class="navbar-header col-4">
                        <a class="navbar-brand" href="index.php?action=home">FORTEROCHE Jean Blog</a>
                    </div>
                    <?php
                        if(isset($_SESSION['login']))
                        {
                    ?>
                            <div class="col-2">
                                <a href="index.php?action=admin"><p>BIENVENUE, <?= $_SESSION['login']; ?></p></a>
                            </div>
                            <div class="dropdown col-2">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $_SESSION['login']; ?>
                                </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="index.php?action=disconnect">Se Déconnecter</a>
                            </div> 
                    <?php        
                        }
                        else
                        {
                    ?>
                            <div class="dropdown col-4">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    CONNEXION
                                </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="index.php?action=login">Se Connecter</a>
                                <a class="dropdown-item" href="index.php?action=subscribe">Inscription</a>
                            </div> 
                    <?php
                        }
                    ?> 
                    </div>
                </div>
            </nav>
        </div>
        <?= $content ?>
        <footer>
            Mentions légales et autres
        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!--<script src="../public/js/custom.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!--
        <script type="text/javascript" src="../Blog_Forteroche/public/js/jQuery.min.js"></script>
        <script type="text/javascript" src="../Blog_Forteroche/public/js/popper.min.js"></script>
        <script type="text/javascript" src="../Blog_Forteroche/public/js/bootstrap.min.js"></script>-->
    </body>
</html>