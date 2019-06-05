<?php

echo'LA PAGE ROMAN avec la liste des épisodes';
?>

<!--listPostsView-->
<?php $title = 'ROMAN'; ?>
    <?php ob_start(); ?>
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
    <section> <!--Last post-->
        <div>
            <h2>ROMAN, tout les derniers épisodes</h2>
            <?php
            while ($data = $posts->fetch())
            {
            ?>
                <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">
                    <div class="news">
                        <h3><?= htmlspecialchars($data['title']); ?></h3>
                        <p><?= nl2br(htmlspecialchars($data['content'])); ?>  
                        <br/>
                        <p>
                            <?= htmlspecialchars($data['post_author']); ?> le 
                            <?= ($data['post_date_fr']); ?>
                        </p>
                    </div> 
                </a>
            <?php          
            }
            $posts->closeCursor();
            ?>
        </div>
    </section>
    <footer>
        Mentions légales et autres
    </footer>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?> 
