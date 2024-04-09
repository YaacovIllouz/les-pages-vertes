<?php 
$page="?page=all_annonce&current_page=";
$page1="?page=all_annonce";

$nb_results_p_page = 15; // nombre de r�sultats par page
$nb_avant = 2; // nombre de page avant la page courante
$nb_apres = 2; // nombre de page apr�s la page courante
$premiere = 1; // aficher le lien "premi�re page" (1 ou 0)
$derniere = 1; // afficher le lien "derni�re page" (1 ou 0)
$courant = empty($_GET['current_page']) ? 1 : $_GET['current_page']; // page
$start = ($courant - 1) * $nb_results_p_page; // start (requete mysql)

// comptage du nombre de lignes de la base
$count = $db->query("SELECT count(*) nbre FROM annonce")->fetch();
if(!$count){
    echo "Erreur :: Aucun enregistrement dans la base de donn&eacute;s";
    exit;
}
// nombre de lignes
$nb_results = (int) $count['nbre'];

//SUPPRESSION -  - - - - - - - - - - - - - - - - - - - - - - - 
if(isset($_GET["ida"]) && !empty($_GET["ida"])){
    @$ida = (int) trim($_GET["ida"]);
    $requete1 = $db->query("DELETE FROM annonce WHERE Id=".$ida);
    if($requete1){
        echo '<script>alert("SUPPRESSION EFFECTUE AVEC SUCCES");</script>';
        echo "<script>document.location.href='./index.php?page=all_annonce';</script>";
    }
}

//activiation
if(isset($_GET["idl"]) && !empty($_GET["idl"]) && isset($_GET["do"]) && !empty($_GET["do"])){
    $idl = (int) trim($_GET["idl"]);
    $do = $_GET["do"];
    if($do=='lock'){
      $up = $db->query("UPDATE annonce SET etat=0 WHERE Id=".$idl);  
    }
    
    if($do=='unlock'){
      $up = $db->query("UPDATE annonce SET etat=1 WHERE Id=".$idl);  
    }
    
    if($up){
        echo '<script>alert("TRAITEMENT EFFECTUE AVEC SUCCES");</script>';
        echo "<script>document.location.href='./index.php?page=all_annonce';</script>";
    }
}

?>
<article class="module width_full">
    <header>
        <h3><b>Gestion des Annonces</b></h3>        
    </header>
    <div class="module_content"> 
        
        <table class="tablesorter" cellspacing="0"> 
            <thead>
                <tr>
                    <th colspan="6"></th>
                    <th colspan="2">Total : <b style=" color: #900;"><?php echo $nb_results; ?> Annonces</b></th>
                </tr>
                <tr>
                    <th>N&deg;</th>
                    <th>Nom</th>
                    <th>T&eacute;l&eacute;phone</th>
                    <th>Entreprise</th>
                    <th>Email</th>
                    <th>Titre</th>
                    <th>Annonce</th>
                    <th style="text-align: center; width:15%;">Action</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                $i=1;
                $select = $db->query("SELECT * FROM annonce ORDER BY Id DESC LIMIT ".$start.", ".$nb_results_p_page." ")->fetchAll();
                foreach($select as $result){
                    $id = $result["Id"]; 
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo minToMajSansAccent($result["nom"]); ?></td>
                    <td><?php echo minToMajSansAccent($result["contact"]); ?></td>
                    <td><?php echo minToMajSansAccent($result["entreprise"]); ?></td>
                    <td><?php echo stripslashes(html_entity_decode($result["email"])); ?></td>
                    <td><?php echo stripslashes(html_entity_decode($result["titre"])); ?></td>
                    <td><?php echo stripslashes(html_entity_decode($result["contenu"])); ?></td>
                    <td valign="middle" style="text-align: center;">                        
<!--                        <a href='./index.php?page=all_annonce&ido=<?php echo $result['Id']?>' title='Modifier' class="btn btn-info btn-sm">
                            <i class="fa fa-edit fa-2x"></i>
                        </a>-->
                        <a href="./index.php?page=all_annonce&ida=<?php echo $result["Id"];?>" class="btn btn-danger btn-sm" 
                           onClick="Javascript:return confirm('Voulez-vous vraiment supprimer cette annonce ?');" title="Supprimer">
                            <i class="fa fa-trash-o fa-2x"></i>
                        </a>
                        <a href="./index.php?page=mod_annonce&id=<?php echo $result["Id"];?>" class="btn btn-info btn-sm"  title="Modifier">
                            <i class="fa fa-pencil-square-o fa-2x"></i>
                        </a>
                        <?php if($result['etat']==1){ ?>
                        <a href="./index.php?page=all_annonce&idl=<?php echo $result["Id"];?>&do=lock" title="D&eacute;sactiver" class="btn btn-success btn-sm">
                            <i class="fa fa-unlock fa-2x"></i>
                        </a>
                        <?php } else{ ?>
                        <a href="./index.php?page=all_annonce&idl=<?php echo $result["Id"];?>&do=unlock" title="Publier" class="btn btn-warning btn-sm">
                            <i class="fa fa-lock fa-2x"></i>
                        </a>
                        <?php }?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
    </table>	
    <br>
    <!-- DC Pagination:A1 Start -->
    <ul class="tsc_pagination tsc_paginationA tsc_paginationA01">
    <?php 
    // nombre total de pages
      $nb_pages = ceil($nb_results / $nb_results_p_page);
      // nombre de pages avant
      $avant = $courant > ($nb_avant + 1) ? $nb_avant : $courant - 1;
      // nombre de pages apr�s
      $apres = $courant <= $nb_pages - $nb_apres ? $nb_apres : $nb_pages - $courant;
     
      // premi�re page
      if($premiere && $courant - $avant > 1)
      echo '<li><a href="'. $_SERVER['SCRIPT_NAME'].$page1.'" class="first" title="D&eacute;but">&lt;&lt;</a></li>';
     
      // page pr�c�dente
      if($courant > 1)
        echo '<li><a href="'.$_SERVER['SCRIPT_NAME'].$page.($courant-1).'" class="previous" title="Pr&eacute;c.">&lt;</a></li>';
     
      // affichage des num�ros de page
      for($i = $courant - $avant; $i <= $courant + $apres; $i++)
      {
      // page courante
      if($i == $courant)
      echo '<li><a href="#" class="current">'.$i.'</a></li>';
      else
      echo '<li><a href="'.$_SERVER['SCRIPT_NAME'].$page.$i.'">'.$i.'</a></li>';
      }
     
      // page suivante
      if($courant < $nb_pages)
    echo '<li><a href="'.$_SERVER['SCRIPT_NAME'].$page.($courant + 1).'" class="next" title="Suiv.">&gt;</a></li>';
     
      if($derniere && $courant + $apres < $nb_pages)
      echo '<li><a href="'.$_SERVER['SCRIPT_NAME'].$page.$nb_pages.'" class="last" title="Fin">&gt;&gt;</a></li>';
?>
</ul>
<div class="clear"></div>
</div>
</article>