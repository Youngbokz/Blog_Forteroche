<?php
session_start();
?>
<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

<div class="mainSection firstContainer" id="top_mainSection_PostView">
    <section> <!--Selected post-->
        <div class="container">
            <h3><?= $post['chapter']; ?></h3>
            <div>            
                <p class="lead">Publié le <?= ($post['post_date_fr']); ?></p>
                <h2><?= htmlspecialchars($post['title']); ?></h2>
                <p class="chapter_slim"><?= nl2br($post['content']); ?></p>                       
                <a class="btn btn-lg btn-dark" href="#top_mainSection_PostView"><i class="fas fa-cloud-upload-alt"></i></a>
            </div> 
        </div>
    </section>
    <section class="post_commentSection container-fluid">
            <div class="post_commentsContainer container">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="page-header">Commentaires</h2>
                        <section class="comment-list">
                        <!-- A Comment -->
                        <?php          
                            while ($comment = $comments->fetch())
                            {          
                                if($comment['reported'] == '0')
                                {           
                        ?>
                                    <article class="row">
                                        <div class="col-md-10 col-sm-10">
                                            <div class="panel panel-default arrow left">
                                                <div class="panel-body">
                                                    <header class="text-center">
                                                        <div class="comment-user"><i class="fa fa-user"></i><?= htmlspecialchars($comment['author']); ?></div>
                                                        <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?= $comment['comment_date_fr']; ?></time>
                                                    </header>
                                                    <div class="comment-post">
                                                        <p>
                                                            <?= nl2br(htmlspecialchars($comment['comment'])); ?>
                                                        </p>
                                                    </div>
                                                    <?php
                                                        if(isset($_SESSION['loginSession']))
                                                        {
                                                    ?>
                                                    <p class="text-right">
                                                        <a href="index.php?action=reportComment&amp;id=<?= $comment['id']; ?>&amp;postId=<?= $post['id']; ?>" class="btn btn-default btn-outline-secondary btn-sm">
                                                            <i class="fa fa-reply"></i> Signaler
                                                        </a>
                                                    </p>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                        <?php
                                }
                            }
                            $comments->closeCursor();
                        ?>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="index.php?action=post&id=<?= $_GET['id'] ;?>&page=<?= ($currentPage - 1); ?>" tabindex="-1" aria-disabled="true"><i class="fas fa-long-arrow-alt-left"></i></a>
                                </li>
                                <?php
                                for($i=1; $i<= $totalPage; $i++)
                                {
                                    if($i == $currentPage)
                                    {           
                                ?>          
                                        <li class="page-item"><a class="page-link active" ><?= $i; ?></a></li>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                        <li class="page-item"><a class="page-link" href="index.php?action=post&id=<?= $_GET['id'] ;?>&page=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php
                                    }
                                }
                                
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?action=post&id=<?= $_GET['id'] ;?>&page=<?= ($currentPage + 1); ?>"><i class="fas fa-long-arrow-alt-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                        </section>
                    </div>
                </div>
            </div>
    
    <?php
        if(isset($_SESSION['loginSession']))
        {
    ?>
            <div class="addComContainer container-fluid">
                <form method="post" action="index.php?action=sendComment&amp;id=<?= $post['id']; ?>" class="container jumbotron col-md-8 form-group">
                    <div class="row">
                    <?php
                    if(isset($errorMessageSend))
                    {
                        echo $errorMessageSend;
                    }
                    ?>
                        <div class="addComInput col-md-8 form-group">
                            <h2>Ajouter un commentaire:</h2>
                        </div>
                        <div class="addComInput col-md-8 form-group">
                            <label for="login">Identifiant</label>
                            <input type="text" class="form-control" id="login" name="login" value="<?= $_SESSION['loginSession']; ?>" READONLY>
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