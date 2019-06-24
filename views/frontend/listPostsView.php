<?php
session_start()
?>
<!--listPostsView-->
<?php $title = 'ROMAN | Jean FORTEROCHE'; ?>
    <?php ob_start(); ?>
    <section class="mainRomanSection"> <!--Last post-->
        <div class="romanContainer container">
            <div class="romanMainTitle">
                <h4>ROMAN</h4>
                <span>[Découvrir tout les épisodes]</span>
                <h1>BILLET SIMPLE POUR L'ALASKA</h1>
            </div>
            <div class="row">
                    <?php
                    while ($data = $posts->fetch())
                    {
                    ?>
                        <div class="card text-center col-12">
                            <div class="card-header">
                                <h3><?= htmlspecialchars($data['chapter']); ?></h3>
                            </div>
                            <div class="card-body">
                                <h2 class="card-title"><?= htmlspecialchars($data['title']); ?></h2>
                                <p class="card-text"><?= nl2br(htmlspecialchars(substr($data['content'], 0, 600))); ?> [...]</p>
                                <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-dark">Découvrir</a>
                            </div>
                            <div class="card-footer text-muted">
                                <p>Publié le <?= ($data['post_date_fr']); ?></p>
                            </div>
                        </div>
                    <?php          
                    }
                    $posts->closeCursor();
                    ?>
            </div>
        </div>
    </section>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?> 
