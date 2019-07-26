<!--/****************************************VIEWS/FRONTEND/TEMPLATE.PHP****************************************/-->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=no">
        <meta name="description" content="Jean FORTEROCHE's blog where his novel, 'Billet simple pour l'Alaska', is published by episode / Blog de Jean FORTEROCHE où est publié son roman, 'Billet simple pour l'Alaska', par épisode. ">
        <!--jQuery-->
        <script type="text/javascript" src="public/js/jQuery.min.js"></script>
        <!--Bootstrap-->
        <link rel="stylesheet" href="public/css/bootstrap.min.css">
        <!--My CSS-->
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <!--fontawesome-->
        <script src="https://kit.fontawesome.com/0b86a7eaab.js"></script> 
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
        <!--Menu-->
            <nav class="fixMainBarr main-navbar navbar fixed-top">
                <div class="container-fluid">
                    <div class="pos-f-t col-lg-3">
                        <div class="collapse" id="navbarToggleExternalContent">
                            <div class="p-4">
                                <ul class="nav navbar-nav col-lg-12">
                                    <li class="active"> <a href="index.php?action=home"><i class="fas fa-igloo"></i>  ACCUEIL</a> </li>
                                    <li> <a href="index.php?action=listPosts"><i class="fas fa-book"></i>  ROMAN</a> </li>
                                    <li> <a href="index.php?action=aboutme"><i class="fas fa-user-edit"></i>  À PROPOS</a> </li>
                                </ul>                 
                            </div>
                        </div>
                        <nav class="navbar navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                        </nav>
                    </div>
                    <div class="navbar-header col-lg-6">
                        <a class="navbar-brand" href="index.php?action=home">BLOG | Jean FORTEROCHE</a>
                        <?php
                        if(isset($_SESSION['login']) && ($_SESSION['login'] != 'admin'))
                        {
                        ?>
                            <p class="welcomHome">BIENVENUE, <span class="welcomLogin"><?= mb_strtoupper($_SESSION['login']); ?></span></p>
                        <?php
                        }
                        ?>
                        
                    </div>
                    
                    <?php
                        if(isset($_SESSION['login']))
                        {
                    ?>      <div class="btn-group col-lg-3">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                                    <?= mb_strtoupper($_SESSION['login']); ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg-right">
                                    <?php
                                    if(isset($_SESSION['login']) && $_SESSION['login'] == 'admin')
                                    {
                                    ?>
                                        <a class="dropdown-item" href="index.php?action=admin"><i class="fas fa-feather"></i> Tableau de bord</p></a>
                                    <?php
                                    }
                                    ?>
                                    <a class="dropdown-item" href="index.php?action=disconnect">Se Déconnecter</a>
                                </div>
                            </div>
                            
                    <?php        
                        }
                        else
                        {
                    ?>
                            <div class="btn-group col-lg-3">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                                    CONNEXION
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg-right">
                                    <a class="dropdown-item" href="index.php?action=login">Se Connecter</a>
                                    <a class="dropdown-item" href="index.php?action=subscribe">Inscription</a>
                                </div>
                            </div>
                    <?php
                        }
                    ?> 
                    </div>
                </div>
            </nav>
        
        <?= $content ?>
        <footer class="container-fluid">
            <p>© 2018-2019 Jean FORTEROCHE Company|Inc. · <a href="#">Privé</a> · <a href="#">Conditions</a></p>
            <p><a href="#container"><i class="fas fa-angle-double-up"></i>  <span class="footer_anchor">Haut de page</span></a></p>
        </footer>
        <!--Popper-->
        <script type="text/javascript" src="public/js/popper.min.js"></script>
        <!--Bootstrap-->
        <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
    </body>
</html>