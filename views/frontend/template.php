<!--/****************************************VIEWS/FRONTEND/TEMPLATE.PHP****************************************/-->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--Bootstrap CDN-->
        <link rel="stylesheet" href="public/css/bootstrap.min.css">
        <!--My CSS-->
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <!--main js-->
        <script src="public/js/custom.js"></script>
        <!--fontawesome-->
        <script src="https://kit.fontawesome.com/0b86a7eaab.js"></script> 
        <!--jQuery-->
        <script type="text/javascript" src="public/js/jQuery.min.js"></script>
        <!--tinyMCE-->
        <script src="public/js/tinymce.min.js"></script>
        <script src="public/js/themes/silver/theme.min.js"></script>
        <script src="public/js/tinyMCEfr.js"></script>

        <script type="text/javascript">
           tinymce.init({
                selector: 'textarea#mytextarea',
                height: 300,
                language: 'fr_FR',
                valid_elements : "em/i,strike,u,strong/b,div[align],br, #p[align],-ol[type|compact],-ul[type|compact],-li",
                /*plugins: [
                    'advlist autolink lists link image charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],*/
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',           
            });
        </script>
        <title><?= $title ?></title>
    </head>
        
    <body class="text-center">
        <div id="container"><!--Menu-->
            <nav class="fixMainBarr main-navbar navbar fixed-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav col-4">
                        <li class="active"> <a href="index.php?action=home"><i class="fas fa-igloo"></i>  ACCUEIL</a> </li>
                        <li> <a href="index.php?action=listPosts"><i class="fas fa-book"></i>  ROMAN</a> </li>
                        <li> <a href="index.php?action=aboutme"><i class="fas fa-user-edit"></i>  À PROPOS</a> </li>
                    </ul>                 
                    <div class="navbar-header col-4">
                        <a class="navbar-brand" href="index.php?action=home">BLOG | Jean FORTEROCHE</a>
                        <?php
                        if(isset($_SESSION['login']) && ($_SESSION['login'] != 'admin'))
                        {
                        ?>
                            <p class="welcomHome">BIENVENUE, <span class="welcomLogin"><?= mb_strtoupper($_SESSION['login']); ?></span></p>
                        <?php
                        }
                        elseif(isset($_SESSION['login']) && $_SESSION['login'] == 'admin')
                        {
                        ?>
                            <a href="index.php?action=admin"><p class="welcomHome">BIENVENUE, <span class="welcomLogin">Jean FORTEROCHE</span>  <i class="fas fa-feather"></i>  Tableau de bord</p></a>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                        if(isset($_SESSION['login']))
                        {
                    ?>
                            <div class="dropdown col-4">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= mb_strtoupper($_SESSION['login']); ?>
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
        <footer class="container-fluid">
            <p>© 2018-2019 Jean FORTEROCHE Company, Inc. · <a href="#">Privé</a> · <a href="#">Conditions</a></p>
            <p><a href="#container"><i class="fas fa-angle-double-up"></i>  Haut de page </a></p>
        </footer>
        <script type="text/javascript" src="public/js/popper.min.js"></script>
        <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
    </body>
</html>