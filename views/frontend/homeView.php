<!--homeView-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>FORTEROCHE Jean Blog</title>
</head>
<body>
    <header>
        <div> <!--Menu-->
            <a href="homeView.php">ACCUEIL</a>
            <a href="listPostsView.php">ROMAN</a>
            <a href="aboutme.html">À PROPOS</a>
        </div>
        <h1>FORTEROCHE Jean Blog</h1>
        <div>
            <a href="loginView.php">CONNEXION</a>
            <a href="subscribeView.php">INSCRIPTION</a>
        </div>
    </header>
    <section> <!--Last post-->
        <div>
            <h2>Dernières publications</h2>
            <?php
            while ($data = $posts->fetch())
            {
            ?>
                    <div class="news">
                        <h3><?= htmlspecialchars($data['title']); ?></h3>
                        <p><?= nl2br(htmlspecialchars($data['content'])); ?>  
                        <br/>
                        <p>
                            <?= htmlspecialchars($data['post_author']); ?> le 
                            <?= ($data['post_date_fr']); ?>
                        </p>
                    </div> 
            <?php          
            }
            $posts->closeCursor();
            ?>
        </div>
    </section>
    <aside> <!--About me-->
        (about me) À PROPOS DE MOI
    </aside>
    <footer>
        Mentions légales et autres
    </footer>
    
</body>
</html>