<?php
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id =  (int) $_GET['id'];

    //pagination
    //$page  = "?page=ese_cat&id=".$id."&current_page=";
    //$page1 = "?page=ese_cat&id=".$id;

    $nb_results_p_page = 6; // nombre de r�sultats par page
    $nb_avant = 2; // nombre de page avant la page courante
    $nb_apres = 4; // nombre de page apr�s la page courante
    $premiere = 1; // aficher le lien "premi�re page" (1 ou 0)
    $derniere = 1; // afficher le lien "derni�re page" (1 ou 0)
    $courant = empty($_GET['current_page']) ? 1 : $_GET['current_page']; // page
    $start = ($courant - 1) * $nb_results_p_page; // start (requete mysql)

    // comptage du nombre de lignes de la base
    $count1 = $db->query("SELECT COUNT(Id_ese) AS total FROM entreprise WHERE Id_sous_rubrique = ".$id)->fetch();
    if($count1){
          $nb_results = $count1['total'];
    }
   
//liste entreprise pour la sous categoriee
$entreprise = $db->query("SELECT * FROM entreprise WHERE Id_sous_rubrique = '".$id."' 
                ORDER BY sigle ASC LIMIT ".$start.", ".$nb_results_p_page."")->fetchAll();

//pub requesst
$pub  = $db->query("SELECT * FROM pub2 WHERE Id_sr = '".$id."' ORDER BY Id DESC")->fetch();
//$pub1 = $db->query("SELECT image FROM pub_site WHERE position = 'Gauche' ORDER BY RAND() LIMIT 1")->fetch();

//code couleur 
$color = $db->query("SELECT color FROM rubrique R, sous_rubrique S WHERE R.id=S.Id_rubrique AND S.Id = '".$id."'")->fetch();
?>

<div class="col-md-4">
    <div style="min-height:100px; padding:0px; height:950px; width:265px; border-radius:3px 3px 3px 3px; border:1px solid <?= $color['color'];?>;">
        <?php 
        if($pub){ 
            echo '<img src="'.$pub['images'].'" class="img-responsive" style="width:auto;" />';
        }
        ?> 
    </div>
</div><!--col-md-3"-->
    
<div class="col-md-8">
    <div class="titre_droit3" style="text-transform:uppercase; background:<?= $color['color'];?>;">
        <?php
        $row = $db->query("SELECT * FROM sous_rubrique WHERE Id = ".$id)->fetch();
        $count = $db->query("SELECT COUNT(Id_ese) AS nbre FROM entreprise WHERE Id_sous_rubrique =".$id)->fetch();
	echo '<b style="text-transform:uppercase">'.$row['rubrique'].' - '.$count['nbre'].' Entreprise(s)</b>';
	?>	      
    </div>
    
     
     <div class="box">
        <br />
         <?php foreach ($entreprise as $ese) { ?>
 
        <div style="min-height:100px; border:1px solid <?= $color['color'];?>; margin-bottom:20px; border-radius:10px;">
            <div class="col-md-9">
                <p style="text-transform:uppercase; font-weight:bold; margin-top:10px;">
                    <a href="index.php?page=det_ese&id=<?php echo $ese['Id_ese'].'&'.format_url($ese['sigle']).':'.format_url($ese['entreprise']).'/'.format_url(GetLibcateg($ese['Id_rubrique'])).'/'.format_url(GetLibRub($ese['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes'; ?>">
                        <span style="color:#000; font-size:20px;"><b><?php echo $ese['sigle']; ?></b></span><br />
                        <span style="color:#000; font-size:15px;"><b><?php echo $ese['entreprise']; ?></b></span>
                    </a>
                </p>
                <p>
                   <span style="color:<?= $color['color'];?>;"><b>
                        <?php
                        $rub = $db->query("SELECT * FROM rubrique WHERE Id = '".$ese['Id_rubrique']."'")->fetch();
                        echo $rub['rubrique'];
                        ?>
                       </b></span>
                    <br />
                    <span style="color:<?= $color['color'];?>; font-size:12px;"><b>
                        <?php
                        $sous_rub = $db->query("SELECT * FROM sous_rubrique WHERE Id = '".$ese['Id_sous_rubrique']."'")->fetch();
                        echo $sous_rub['rubrique'];
                        ?>	
                         </b>
                   </span>
                </p>

                    <p><b>Phone &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<span
                                style="color:#000;"><?php echo $ese['tel1']; ?></span></b>
                    </p>

               <p><b>Mobile &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<span style="color:#000;"><?php echo $ese['cel1']; ?></span></b></p>

            </div> <!--col-md-8-->

            <div class="col-md-3 field-name-field-logo-entreprise border_logo_accroche_cat" style="margin-top:25px;">
                <img <?php fctaffichimage($ese['image'],150,100); ?>  alt="Logo" class="img-responsive" width="100px" height="110px" style="max-height:115px; max-width:100px" />
            </div><!--col-md-3-->
            <div class="clearfix">&nbsp;</div>
            <div class="" style="background:<?= $color['color'];?>; border:1px solid <?= $color['color'];?>;
                 border-radius:0px 0px 5px 5px; padding:3px 15px 5px 5px; height:30px; font-size: 14px;">
                <p style="float:right;">
                    <a href="index.php?page=det_ese&id=<?php echo $ese['Id_ese'].'&'.format_url($ese['sigle']).':'.format_url($ese['entreprise']).'/'.format_url(GetLibcateg($ese['Id_rubrique'])).'/'.format_url(GetLibRub($ese['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes'; ?>">
                        <b style="color:#FFF;"><i class="fa fa-arrow-right"></i> More details</b>
                    </a>
                </p>
            </div> 
        </div>
        <br>
          <?php } ?>
    </div><!--box-->
     
    <div style="text-align: center;">   <!-- DC Pagination:A1 Start -->
        <ul class="tsc_pagination tsc_paginationA tsc_paginationA06"  style="text-align: center;">
        <?php 
		
		//pagination
		
		$page = "?page=ese_cat&id=".$id.'&'.format_url(GetLibcateg($ese['Id_rubrique'])).'/'.format_url(GetLibRub($ese['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes';
		$page  = $page."&current_page=";
		
		$page1 = "?page=ese_cat&id=".$id.'&'.format_url(GetLibcateg($ese['Id_rubrique'])).'/'.format_url(GetLibRub($ese['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes';
		
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
    </div>
</div><!--col-md-8"-->
<?php } ?>
