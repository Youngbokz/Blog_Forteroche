
<?php
session_start()
?>
<?php $title = htmlspecialchars("COMMENTAIRES"); ?>

<?php ob_start(); ?>
<?php $data= $comment->fetch(); ?>
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Votre message actuel</h1>
        <article class="row">
            <div class="col-md-10 col-sm-10">
                <div class="panel panel-default arrow left">
                    <div class="panel-body">
                        <header class="text-center">
                            <div class="comment-user"><i class="fa fa-user"></i><?= htmlspecialchars($data['author']); ?></div>
                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?= $data['comment_date_fr']; ?></time>
                        </header>
                        <div class="comment-post">
                            <p><?= nl2br(htmlspecialchars($data['comment'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <p class="lead"></p>
        <hr class="my-4">
        <form action="index.php?action=updateComment&amp;id=<?= $data['id'];?>&amp;postId=<?=$data['post_id'];?>" method="post">      
            <label for="newComment">Nouveau commentaire</label><br />
            <textarea id="newComment" name="newComment" value = "Changez votre message..."></textarea>
            <div>
                <input type="Submit" value="Modifier" name="submitEdit" />
            </div>
        </form>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>








