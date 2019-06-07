<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--Bootstrap CDN-->
        <link rel="stylesheet" href="public/css/bootstrap.min.css" >
        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <title><?= $title ?></title>
    </head>
        
    <body>
        <div id="container"><!--Menu-->
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li class="active"> <a href="index.php?action=home">ACCUEIL</a> </li>
                        <li> <a href="index.php?action=listPosts">ROMAN</a> </li>
                        <li> <a href="aboutme.html">À PROPOS</a> </li>
                    </ul>
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php?action=home">FORTEROCHE Jean Blog</a>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CONNEXION
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="index.php?action=login">CONNEXION</a>
                            <a class="dropdown-item" href="index.php?action=subscribe">INSCRIPTION</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <?= $content ?>
        <footer>
            Mentions légales et autres
        </footer>
        <script src="public/js/jQuery.min.js"></script>
        <script src="public/js/popper.min.js"></script>
        <script src="public/js/bootstrap.min.js"></script>
    </body>
</html>