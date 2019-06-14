
<!--listPostsView-->
<?php $title = 'ROMAN | Jean FORTEROCHE'; ?>
    <?php ob_start(); ?>
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
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?> 
