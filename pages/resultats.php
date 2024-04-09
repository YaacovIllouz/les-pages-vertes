<?php
if(isset($_GET['recherche']) && !empty($_GET['recherche'])){	
    $entreprise = trim($_GET['recherche']);
    $param = explode(' : ', $entreprise);
    $count = count($param);
    //requete sql
    if($count > 1 && !empty($param[0]) && !empty($param[1])){
		$requete_exe = 'SELECT E.*, R.color, R.rubrique AS rub_prin, S.rubrique AS sous_rub FROM entreprise E, rubrique R, sous_rubrique S 
                            WHERE E.Id_rubrique=R.Id AND S.Id_rubrique=R.Id AND E.Id_sous_rubrique=S.Id
                            AND (E.sigle LIKE "'.addslashes($param[0]).'%" OR E.entreprise LIKE "'.addslashes($param[1]).'%") order by sigle ASC';
        $query = $db->query($requete_exe);
    }	
    else{
		$requete_exe = "SELECT E.*, R.color, R.rubrique AS rub_prin, S.rubrique AS sous_rub FROM entreprise E, rubrique R, sous_rubrique S 
                            WHERE E.Id_rubrique=R.Id AND S.Id_rubrique=R.Id AND E.Id_sous_rubrique=S.Id
                            AND (E.sigle LIKE '".addslashes($param[0])."%' OR E.entreprise LIKE '".addslashes($param[0])."%' OR S.rubrique LIKE '".addslashes($param[0])."%') order by sigle ASC";
        $query = $db->query($requete_exe);		
    }
	//ORDER BY E.sigle ASC
	//echo 'La requete : '.$requete_exe;
    $search = $query->fetchAll();
	$total = Count($search);

?>

    <div class="col-md-4">
       <?php
       $pub = $db->query("SELECT image FROM pub_site WHERE position = 'Recherche' ORDER BY Id DESC")->fetch();
       ?>
         <img src="<?= $pub['image']; ?>" class="img-responsive pub_gauche" alt="Pub" />
    </div><!--col-md-3"-->
    
    <div class="col-md-8">
     <div class="titre_droit2">
         <b>RESULTATS DE LA RECHERCHE</b> -
         <?php
         if($total>1){echo $total.' Contacts trouv&eacute;s';}else{ echo  $total.' Contact trouvé';}
         ?>
     </div>
     <!--search-->
     <div class="box" style="padding:5px;"><b>

     <?php 
	/* if($total == 0) {
			echo "<div class='clearfix'>&nbsp;</div>
				<div style='text-align: center;'>
                <h3><b>Oops...</b></h3><br><h4>nous n'avons pas de réponses pour <b>'".$_GET['recherche']."'</b>.</h4>
				</div>";
		}*/
	
	?>
     </b>
     <br />
  <?php foreach ($search as $row_rs_search) { ?>
       <div class="row" style="min-height:100px; border:1px solid <?= $row_rs_search['color']; ?>; margin-bottom:10px; border-radius:10px;">
        
          <div class="col-md-9">
               <b style="color:#060;">
                   <a href="index.php?page=det_ese&id=<?php echo $row_rs_search['Id_ese'].'&'.format_url($row_rs_search['sigle']).':'.format_url(utf8_encode($row_rs_search['entreprise'])).'/'.format_url(GetLibcateg($row_rs_search['Id_rubrique'])).'/'.format_url(GetLibRub($row_rs_search['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes'; ?>">
                       <span style="font-weight:bold; color:#000; font-size:20px;"><?php echo utf8_decode($row_rs_search['sigle']); ?></span><br />
                       <span style="font-weight:bold; color:#000; font-size:18px;"><?php echo mb_strtoupper($row_rs_search['entreprise']); ?></span>
                   </a>
               </b>
                <br />
                <p>
                <span style="color:<?= $row_rs_search['color']; ?>;">
                    <b><?= $row_rs_search['rub_prin']; ?></b>
                </span>
                <br />
               <span style="color:<?= $row_rs_search['color']; ?>;  font-size:12px;">
                   <b><?= $row_rs_search['sous_rub']; ?></b>
               </span>
                 </p>

              <p><b>Tel. &nbsp;&nbsp;&nbsp;<span
                          style="color:#000;"><?= $row_rs_search['tel1']; ?></span></b></p>

              <p><b>Cel. &nbsp;&nbsp;&nbsp;<span style="color:#000;"><?= $row_rs_search['cel1']; ?></span></b></p>
          </div>
          
            <div class="col-md-3" style="margin-top:25px;">
            <img src="<?= $row_rs_search['image']; ?>" class="img-responsive" alt="Logo" />
           </div>
           <div class="col-md-12" style="background:<?= $row_rs_search['color'];
				 ?>; border:1px solid <?= $row_rs_search['color']; ?>; border-radius:0px 0px 8px 8px;">
            <p style="float:right; margin-top:6px; height:15px;">
            <a href="index.php?page=det_ese&id=<?php echo $row_rs_search['Id_ese'].'&'.format_url($row_rs_search['sigle']).':'.format_url(utf8_encode($row_rs_search['entreprise'])).'/'.format_url(GetLibcateg($row_rs_search['Id_rubrique'])).'/'.format_url(GetLibRub($row_rs_search['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes'; ?>">
                    <span style="color:#fff; font-size:16px;"><b>Plus de détails</b></span></a></p>
           </div>
      </div>
    <?php } ?>
    </div>
</div><!--row-->
<?php }
else{
    echo '<script>document.location.href="index.php";</script>';
}
//$db = null;
?>