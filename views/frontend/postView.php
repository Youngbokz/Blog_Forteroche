
<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
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
            <p><?= htmlspecialchars($comment['author']); ?> le <?= $comment['comment_date_fr']; ?></p>
            
    <?php
        }
        $comments->closeCursor();
    ?>
    </section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>