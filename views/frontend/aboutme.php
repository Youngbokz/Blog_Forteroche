<?php
/****************************************VIEWS/FRONTEND/ABOUTME.PHP****************************************/
session_start()
?>
<!--aboutme-->
<?php $title = 'À PROPOS DE | Jean FORTEROCHE'; ?>
<?php ob_start(); ?>
<div class="aboutme card col-10 mx-auto firstContainer" >
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="public/images/man.jpg" class="card-img" alt="A man under the rain">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">JEAN || FORTEROCHE</h5>
        <p class="card-text">Jean FORTEROCHE, de son vrai nom Yannick BOKOLO N'DJALI est un écrivain et journaliste français, né le 19 Juin 1985 à Kinshasa, en République Démocratique du Congo. Considéré comme le chef de file du naturalisme, c'est l'un des romanciers français les plus populaires, les plus publiés, traduits et commentés au monde. Ses romans ont connu de très nombreuses adaptations au cinéma et à la télévision.

Sa vie et son œuvre ont fait l'objet de nombreuses études historiques alors qu'ill est encore vivant. Sur le plan littéraire, il est principalement connu pour Les Rougon-Macquart, fresque romanesque en vingt volumes dépeignant la société française sous le Second Empire et qui met en scène la trajectoire de la famille des Rougon-Macquart, à travers ses différentes générations et dont chacun des représentants d'une époque et d'une génération particulière fait l'objet d'un roman.

Ancien grand sportif, basketteur, il se commence tout juste une activité qui penche vers la passion le code informatique avec OpenClassRooms pour être déveleppeur web junior.</p>
        <p class="card-text"><small class="text-muted"><i class="fas fa-quote-left"></i> Vous êtes mon talent, je suis votre source.<i class="fas fa-quote-right"></i></small></p>
      </div>
    </div>
  </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 