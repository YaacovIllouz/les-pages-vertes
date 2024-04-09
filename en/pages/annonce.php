<?php 
$page="?page=annonce&current_page=";
$page1="?page=annonce";

$nb_results_p_page = 6; // nombre de r�sultats par page
$nb_avant = 1; // nombre de page avant la page courante
$nb_apres = 3; // nombre de page apr�s la page courante
$premiere = 1; // aficher le lien "premi�re page" (1 ou 0)
$derniere = 1; // afficher le lien "derni�re page" (1 ou 0)
$courant = empty($_GET['current_page']) ? 1 : $_GET['current_page']; // page
$start = ($courant - 1) * $nb_results_p_page; // start (requete mysql)

// comptage du nombre de lignes de la base
$count = $db->query("SELECT COUNT(*) nbre FROM annonce WHERE etat=1")->fetch();
if(!$count){
    echo "Erreur :: Aucun enregistrement dans la base de donn&eacute;s";
    exit;
}
// nombre de lignes
$nb_results = (int) $count['nbre'];

//pub
$pub = $db->query("SELECT image FROM pub_site WHERE position = 'Annonce' ORDER BY Id DESC")->fetch();
/*if(!$pub){
    $pub = $db->query("SELECT image FROM pub_site WHERE position = 'Gauche' ORDER BY RAND() LIMIT 1")->fetch();
}*/
?>
<div class="col-md-4 ">
    <?php if($pub) { ?>
    <img src="<?php echo $pub['image']; ?>"  class="img-responsive pub_gauche" />
    <?php }?>
</div><!--col-md-3"-->
    
<div class="col-md-8">
    <div class="titre_droit" style="border-radius:5px;">
        <b>ALL ADVERTISING - <?php echo $nb_results ; ?> ADVERTISING</b>
    </div>
    <div class="cleafix">&nbsp;</div>
    <?php 
    $select = $db->query("SELECT * FROM annonce WHERE etat=1 ORDER BY Id DESC LIMIT ".$start.", ".$nb_results_p_page." ")->fetchAll();
    foreach($select as $row_rs_annonce){
        $date = explode(' ', $row_rs_annonce['date']);
        ?>
    <div class="col-md-12" style="min-height:100px; border:1px solid #090; margin-bottom:30px; border-radius:10px; padding:0px;">
        <div class="col-md-12" style="padding:5px 10px;">
            <b style=" color:#090;">
                <a href="?page=det_annonce&id=<?= $row_rs_annonce['Id']; ?>" title="Voir les d&eacute;tails">
                    <?= $row_rs_annonce['titre'];?>
                </a>
            </b>
        </div><br/>
        <div style="padding:5px 10px;">
            <div style="border-bottom:1px dotted #CCC;">
                <p><?= substr(html_entity_decode($row_rs_annonce['contenu']),0,125).' ...'; ?></p>
            </div>
            <p style="color:#090;"> 
                <b>Enterprise : </b><?= $row_rs_annonce['entreprise']; ?><br />
                <b>Phone : </b><?= $row_rs_annonce['contact']; ?> /
                <b>Email : </b><?= $row_rs_annonce['email']; ?>
            </p>
       </div>
        <div class="col-md-12" style="background:#090; height:30px; border-radius:0px 0px 8px 8px;">
            <p>
                <span style="float:left; margin-top:5px; height:15px;color:#FFF;">
                    Publish on <?= '<b>'.reverseDateFr($date[0]). '</b> at <b>'.$date[1].'</b>';?>
                </span>
                <span style="float:right; margin-top:5px; height:15px;color:#FFF;">
                    <a href="?page=det_annonce&id=<?= $row_rs_annonce['Id']; ?>"
                       title="More details" style="color: white;">
                        <b>Details ></b>
                    </a>
                </span>
            </p>
        </div>
    </div><br />
    <?php } ?>   
    <div class="clearfix">&nbsp;</div>
    <div style="text-align:center;">
        <ul class="tsc_pagination tsc_paginationA tsc_paginationA06">
            <?php
            // nombre total de pages
              $nb_pages = ceil($nb_results / $nb_results_p_page);
              // nombre de pages avant
              $avant = $courant > ($nb_avant + 1) ? $nb_avant : $courant - 1;
              // nombre de pages apr�s
              $apres = $courant <= $nb_pages - $nb_apres ? $nb_apres : $nb_pages - $courant;

              // premi�re page
              if($premiere && $courant - $avant > 1) {
                  echo '<li><a href="' . $_SERVER['SCRIPT_NAME'] . $page1 . '" class="first" title="D&eacute;but">&lt;&lt;</a></li>';
              }
              // page pr�c�dente
                if($courant > 1)
                    echo '<li><a href="'.$_SERVER['SCRIPT_NAME'].$page.($courant-1).'" class="previous" title="Pr&eacute;c.">&lt;</a></li>';

                    // affichage des num�ros de page
                    for($i = $courant - $avant; $i <= $courant + $apres; $i++) {
                          // page courante
                          if($i == $courant) {
                              echo '<li><a href="#" class="current">' . $i . '</a></li>';
                          }
                          else {
                              echo '<li><a href="' . $_SERVER['SCRIPT_NAME'] . $page . $i . '">' . $i . '</a></li>';
                          }
                    }

              // page suivante
              if($courant < $nb_pages) {
                  echo '<li><a href="' . $_SERVER['SCRIPT_NAME'] . $page . ($courant + 1) . '" class="next" title="Suiv.">&gt;</a></li>';
              }

              if($derniere && $courant + $apres < $nb_pages) {
                  echo '<li><a href="' . $_SERVER['SCRIPT_NAME'] . $page . $nb_pages . '" class="last" title="Fin">&gt;&gt;</a></li>';
              }
            ?>
        </ul>
    </div>
</div>
