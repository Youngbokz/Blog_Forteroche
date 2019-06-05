
<?php $title = htmlspecialchars($post['title']); ?>

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
    <section> <!--Selected post-->
        <div>
            <h2>ÉPISODE <?= $post['id']; ?></h2>

            <div class="news">
                <h3><?= htmlspecialchars($post['title']); ?></h3>
                <p><?= nl2br(htmlspecialchars($post['content'])); ?>  
                <br/>
                <p>
                    <?= htmlspecialchars($post['post_author']); ?> le 
                    <?= ($post['post_date_fr']); ?>
                </p>
            </div> 
        </div>
    </section>
    <section>
    <?php
        while ($comment = $comments->fetch())
        {
        ?>
            <p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
            <p><?= htmlspecialchars($comment['author']); ?>le <?= $comment['comment_date_fr']; ?></p>
            
    <?php
        }
    ?>
    </section>
    <footer>
        Mentions légales et autres
    </footer>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>