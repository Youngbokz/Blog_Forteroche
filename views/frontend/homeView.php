<!--homeView-->
    <?php $title = 'FORTEROCHE Jean Blog'; ?>
    <?php ob_start(); ?>
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
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?> 
