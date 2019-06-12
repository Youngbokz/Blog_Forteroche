
<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
    <section> <!--Selected post-->
        <div class="container">
            <h2>ÉPISODE <?= $post['id']; ?></h2>
            <div class="jumbotron">            
                <p class="lead">Le <?= ($post['post_date_fr']); ?></p>
                <h2><?= htmlspecialchars($post['title']); ?></h2>
                <p class="chapter_slim col-md-8"><?= nl2br(htmlspecialchars($post['content'])); ?></p>                       
                <a class="btn btn-lg btn-primary" href="index.php?action=post&amp;id=<?= $post['id'] ?>" role="button">En voir plus</a>
            </div> 
        </div>
    </section>
    <div class="container-fluid">
        <form method="post" action="index.php?action=sendComment" class="container jumbotron col-md-8 form-group">
            <div class="row">
                <div class="col-md-8 form-group">
                    <h2>Ajouter un commentaire:</h2>
                </div>
                <div class="col-md-8 form-group">
                    <label for="login">Identifiant</label>
                    <input type="text" class="form-control" id="login" placeholder="Votre identifiant">
                </div>
                <div class="col-md-8 form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="3" placeholder="Votre message"></textarea>
                </div>
                <div class="col-md-8 form-group">
                    <button type="submit" name="submit" class="btn btn-outline-secondary">ENVOYER</button>
                </div>
            </div>
        </form>
    </div>
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