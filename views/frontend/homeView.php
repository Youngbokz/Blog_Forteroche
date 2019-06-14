<!--homeView-->
    <?php $title = 'ACCUEIL | Jean FORTEROCHE'; ?>
    <?php ob_start(); ?>
    <header id="banner">
        
            <div class="home_Main_Title col-md-6">
                <h1>"Billet simple pour l'Alaska"</h1>
                <p>Venez découvrir le roman en temps réel !</p>
            </div>
        
    </header>
    <div id="previewChapter container">
        <div class="row";>
            <section class="col-8"> <!--Last post-->
                    <h2>Dernier Épisode</h2>
                    <?php
                    while ($data = $lastPost->fetch())
                    {
                    ?>
                        <main role="main" class="container">
                            <div class="jumbotron">
                                <aside><?= htmlspecialchars($data['chapter']); ?></aside>
                                <p class="lead">Le <?= ($data['post_date_fr']); ?></p>
                                <h2><?= htmlspecialchars($data['title']); ?></h2>
                                <p class="chapter_slim col-md-8"><?= nl2br(htmlspecialchars($data['content'])); ?></p>                       
                                <a class="btn btn-lg btn-primary" href="index.php?action=post&amp;id=<?= $data['id'] ?>" role="button">En voir plus</a>
                                
                            </div>        
                        </main>
                    <?php          
                    }
                    $lastPost->closeCursor();
                    ?>
            </section>
            <aside class="4">
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
    </div>
    <section id="home_words"> 
        <div>
            <h2>"L'Homme reste en haleine par l'attente de l'émotion..."</h2>
            <p>[Jean FORTEROCHE]</p>
        </div>
    </section>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?> 
