<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Bootstrap CDN-->
        <link rel="stylesheet" href="public/css/bootstrap.min.css" >
        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <title><?= $title ?></title>
    </head>
        
    <body>
        <header id="main_menu">
            <div> <!--Menu-->
                <a href="index.php?action=home">ACCUEIL</a>
                <a href="index.php?action=listPosts">ROMAN</a>
                <a href="aboutme.html">À PROPOS</a>
            </div>
            <h1><a href="index.php?action=home">FORTEROCHE Jean Blog</a></h1>
            <div>
                <a href="index.php?action=login">CONNEXION</a>
                <a href="index.php?action=subscribe">INSCRIPTION</a>
            </div>
        </header>
        <?= $content ?>
        <footer>
            Mentions légales et autres
        </footer>
    </body>
</html>