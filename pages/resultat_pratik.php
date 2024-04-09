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
	$i = 0;
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
     <!--search style="padding:5px;"-->
     <div class="box_" >
	 <!-- <b></b> -->

     <?php 
	/* if($total == 0) {
			echo "<div class='clearfix'>&nbsp;</div>
				<div style='text-align: center;'>
                <h3><b>Oops...</b></h3><br><h4>nous n'avons pas de réponses pour <b>'".$_GET['recherche']."'</b>.</h4>
				</div>";
		}*/
	
	?>
     
     <br />
	<?php foreach ($search as $row_rs_search) { 
	$srub = strtolower(GetLibRub($row_rs_search['Id_sous_rubrique']));
	?>
<div class="views-row node node-entreprise info_fiche" style="border: 1px solid <?php echo GetColcateg($row_rs_search['Id_rubrique']);?>">
	<div class="row">
		<div class="col-sm-12 ">
			<div class="field field-name-title field-type-ds field-label-hidden">
				<div class="field-items">
					<div class="field-item titre_ese">
						<h6 class="titre_ese"><a href="index.php?page=det_ese&id=<?= $row_rs_search['Id_ese'].'&'.format_url($row_rs_search['sigle']).':'.format_url($row_rs_search['entreprise']).'/'.format_url(GetLibcateg($row_rs_search['Id_rubrique'])).'/'.format_url(GetLibRub($row_rs_search['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes'; ?>" style="color:#333333"><?php if($row_rs_search['entreprise']) {echo mb_strtoupper($row_rs_search['entreprise']);} else {echo mb_strtoupper($row_rs_search['sigle']);} ?></a></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<span>
			<div class="col-sm-3 ">
				<div class="field field-name-field-logo-entreprise field-type-image field-label-hidden border_logo_accroche">
					<div class="field-items">
						<div class="field-item even">
						<a href="index.php?page=det_ese&id=<?= $row_rs_search['Id_ese'].'&'.format_url($row_rs_search['sigle']).':'.format_url($row_rs_search['entreprise']).'/'.format_url(GetLibcateg($row_rs_search['Id_rubrique'])).'/'.format_url(GetLibRub($row_rs_search['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes'; ?>">
						<img src="<?= $row_rs_search['image']; ?>"  class="img-responsive" alt="<?= $row_rs_search['sigle'];?>" width="80" height="80" style="max-height:80px" title="<?= $row_rs_search['sigle'];?>"></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 ">
				<div class="field field-name-field-signe-entreprise field-type-text field-label-hidden miniscule_maj">
					<div class="field-items">
						<div class="field-item even" style="color:<?php echo GetColcateg($row_rs_search['Id_rubrique']); ?>"><?php echo GetLibcateg($row_rs_search['Id_rubrique']);?></div>
					</div>
				</div>
				<div class="field field-name-field-thematique-v2 field-type-taxonomy-term-reference field-label-hidden color_text_blue" style="color:<?php echo GetColcateg($row_rs_search['Id_rubrique']); ?>">

					<a href="index.php?page=ese_cat&id=<?php echo $row_rs_search['Id_sous_rubrique'].'&'.format_url(GetLibcateg($row_rs_search['Id_rubrique'])).'/'.format_url(GetLibRub($row_rs_search['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes'; ?>">
						<?php echo ucwords($srub);?>
					</a>
						
				</div>
				<div class="field field-name-field-localisation-lieu field-type-taxonomy-term-reference field-label-hidden">
					<div class="field-items">
						<div class="field-item even"><?php echo $row_rs_search['geoloclaisation']; ?></div>
					</div>
				</div>
				<div class="field field-name-field-telepone-1 field-type-text field-label-hidden color_black_blold">
					<div class="field-items">
						<div class="field-item even">+225 20 25 31 25 </div>
					</div>
				</div>
			</div>
			
			<div class="col-sm-3 ">					
				<div class="field field-name-node-link field-type-ds field-label-hidden">
					<div class="field-items">
						<div class="field-item position_detail">
							<a href="index.php?page=det_ese&id=<?= $row_rs_search['Id_ese'].'&'.format_url($row_rs_search['sigle']).':'.format_url($row_rs_search['entreprise']).'/'.format_url(GetLibcateg($row_rs_search['Id_rubrique'])).'/'.format_url(GetLibRub($row_rs_search['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes'; ?>" class="">+ de détails</a>
						</div>
						</br>
					</div>
				</div>
			</div>
			
			</br>
		</span>
	</div>
</div>
<?php 
//$i++;  
//if($i < $total) echo '<hr style="padding:0;"/>'; 
} ?>	

    </div>
</div><!--row-->
<?php }
else{
    echo '<script>document.location.href="index.php";</script>';
}
//$db = null;
?>