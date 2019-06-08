<!--homeView-->
    <?php $title = 'ACCUEIL | Jean FORTEROCHE'; ?>
    <?php ob_start(); ?>
    <header id="banner">
        <h1>"Billet simple pour l'Alaska"</h1>
        <p>Venez découvrir le roman en temps réel !</p>
    </header>
    <div id="previewChapter">
        <section id=""> <!--Last post-->
            <div>
                <h2>Dernier Épisode</h2>
                <?php
                while ($data = $lastPost->fetch())
                {
                ?>
                    <main role="main" class="container">
                        <div class="jumbotron">
                            <aside><?= htmlspecialchars($data['chapter']); ?></aside>
                            <h2><?= htmlspecialchars($data['title']); ?></h2>
                            <p class="chapter_slim"><?= nl2br(htmlspecialchars($data['content'])); ?></p>                       
                            <a class="btn btn-lg btn-primary" href="index.php?action=post&amp;id=<?= $data['id'] ?>" role="button">En voir plus</a>
                            <p class="lead"><?= htmlspecialchars($data['post_author']); ?> le 
                                <?= ($data['post_date_fr']); ?></p>
                        </div>        
                    </main>
                <?php          
                }
                $lastPost->closeCursor();
                ?>
            </div>
        </section>
        <aside>
            <div>
                <h2>Derniers Commentaires</h2>
                <?php
                while ($data = $lastComments->fetch())
                {
                ?>
                    <div>
                        <p><?= nl2br(htmlspecialchars($data['comment'])); ?></p> 
                        <br/>
                        <p>
                            <?= htmlspecialchars($data['author']); ?> le 
                            <?= ($data['comment_date_fr']); ?>
                        </p>
                    </div> 
                <?php          
                }
                $lastComments->closeCursor();
                ?>
            </div>
        </aside>
    </div>
    <section> <!--About me-->
        (about me) À PROPOS DE MOI
    </section>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?> 
