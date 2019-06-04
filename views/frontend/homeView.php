<!--homeView-->
    <?php $title = 'FORTEROCHE Jean Blog'; ?>
    <?php ob_start(); ?>
    <header id="main_menu">
        <div> <!--Menu-->
            <a href="index.php?action=home">ACCUEIL</a>
            <a href="index.php?action=listPosts">ROMAN</a>
            <a href="aboutme.html">À PROPOS</a>
        </div>
        <h1>FORTEROCHE Jean Blog</h1>
        <div>
            <a href="index.php?action=login">CONNEXION</a>
            <a href="index.php?action=subscribe">INSCRIPTION</a>
        </div>
    </header>
    <section> <!--Last post-->
        <div>
            <h2>Dernier Épisode</h2>
            <?php
            while ($data = $lastPost->fetch())
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
            $lastPost->closeCursor();
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
