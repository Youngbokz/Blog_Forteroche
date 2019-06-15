
<?php
session_start()
?>
<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<div class="mainSection">
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
    <section class="container-fluid">
    <?php
        while ($comment = $comments->fetch())
        {
    ?>
            <div class="container">
            <div class="row">
                <div class="col-md-8">
                <h2 class="page-header">Comments</h2>
                    <section class="comment-list">
                    <!-- First Comment -->
                    <article class="row">
                        <div class="col-md-10 col-sm-10">
                        <div class="panel panel-default arrow left">
                            <div class="panel-body">
                            <header class="text-left">
                                <div class="comment-user"><i class="fa fa-user"></i><?= htmlspecialchars($comment['author']); ?></div>
                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?= $comment['comment_date_fr']; ?></time>
                            </header>
                            <div class="comment-post">
                                <p>
                                <?= nl2br(htmlspecialchars($comment['comment'])); ?>
                            </p>
                            </div>
                            <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Signaler</a></p>
                            </div>
                        </div>
                        </div>
                    </article>
                    </section>
                </div>
            </div>
        </div>
    <?php
        }
        $comments->closeCursor();
    ?>
    <?php
        if(isset($_SESSION['login']))
        {
    ?>
            <div class="addComContainer container-fluid">
                <form method="post" action="index.php?action=sendComment&amp;id=<?= $post['id']; ?>" class="container jumbotron col-md-8 form-group">
                    <div class="row">
                        <div class="addComInput col-md-8 form-group">
                            <h2>Ajouter un commentaire:</h2>
                        </div>
                        <div class="addComInput col-md-8 form-group">
                            <label for="login">Identifiant</label>
                            <input type="text" class="form-control" id="login" name="login" placeholder="Votre identifiant">
                        </div>
                        <div class="addComInput col-md-8 form-group">
                            <label for="story">Message</label>
                            <textarea class="form-control" id="story" name="story" rows="3" placeholder="Votre message"></textarea>
                        </div>
                        <div class="addComInput col-md-8 form-group">
                            <button type="submit" name="submit" class="btn btn-outline-secondary">ENVOYER</button>
                        </div>
                    </div>
                </form>
            </div>
    <?php
        }
    ?>
            
    
    
    </section>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>