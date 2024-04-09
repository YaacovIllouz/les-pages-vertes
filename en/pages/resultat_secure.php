<?php
if(isset($_POST['entreprise']) && !empty($_POST['entreprise'])){
    $entreprise = trim($_POST['entreprise']);
    $param = explode(' : ', $entreprise);
    $count = count($param);

    //requete sql
    if($count > 1 && !empty($param[0]) && !empty($param[1])){
        $query = $db->query('SELECT E.*, R.color, R.rubrique AS rub_prin, S.rubrique AS sous_rub FROM entreprise E, rubrique R, sous_rubrique S 
                            WHERE E.Id_rubrique=R.Id AND S.Id_rubrique=R.Id AND E.Id_sous_rubrique=S.Id
                            AND (E.sigle LIKE "'.$param[0].'%" OR E.entreprise LIKE "'.$param[1].'%") 
                            ORDER BY E.sigle ASC');
    }
    else{
        $query = $db->query('SELECT E.*, R.color, R.rubrique AS rub_prin, S.rubrique AS sous_rub FROM entreprise E, rubrique R, sous_rubrique S 
                            WHERE E.Id_rubrique=R.Id AND S.Id_rubrique=R.Id AND E.Id_sous_rubrique=S.Id
                            AND (E.sigle LIKE "'.$param[0].'%" OR S.rubrique LIKE "'.$param[0].'%") ORDER BY E.sigle ASC');
    }

    $total = $query->rowCount();
    $search = $query->fetchAll();

?>

<div class="col-md-4">
       <?php
       $pub = $db->query("SELECT image FROM pub_site WHERE position = 'Recherche' ORDER BY Id DESC")->fetch();
       ?>
         <img src="<?= $pub['image']; ?>" class="img-responsive pub_gauche" />
    </div><!--col-md-3"-->
    
    <div class="col-md-8">
     <div class="titre_droit2">
         <b>SEARCH RESULTS </b> -
         <?php
         if($total>1){echo $total.' Companies found';}else{ echo  $total.' Company found';}
         ?>
     </div>
     <!--search-->
     <div class="box" style="padding:5px;"><b>

     <?php 
	 if($total == 0) {
			echo "<div class='clearfix'>&nbsp;</div><div style='text-align: center;'>
                <h3>No results found for this search</h3></div>";
		}
	
	?>
     </b>
     <br />
  <?php foreach ($search as $row_rs_search) { ?>
       <div class="row" style="min-height:100px; border:1px solid <?= $row_rs_search['color']; ?>; margin-bottom:10px; border-radius:10px;">
        
          <div class="col-md-9">
              <b style="color:#060;">
                  <a href="index.php?page=det_ese&id=<?php echo $row_rs_search['Id_ese'].'&'.format_url($row_rs_search['sigle']).':'.format_url($row_rs_search['entreprise']).'/'.format_url(GetLibcateg($row_rs_search['Id_rubrique'])).'/'.format_url(GetLibRub($row_rs_search['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes'; ?>">
                      <span style="color:#000; font-size:20px;"><?php echo $row_rs_search['sigle']; ?></span><br />
                      <span style="color:#000; font-size:18px;"><?php echo minToMajSansAccent($row_rs_search['entreprise']); ?></span>
                  </a>
              </b>
              <br />
              <p>
                <span style="color:<?= $row_rs_search['color']; ?>;">
                    <b><?= $row_rs_search['rub_prin']; ?></b>
                </span>
                  <br />
                  <span style="color:<?= $row_rs_search['color']; ?>; font-size: 12px;">
                   <b><?= $row_rs_search['sous_rub']; ?></b>
               </span>
              </p>

              <p><b>Tel. &nbsp;&nbsp;&nbsp;<span
                          style="color:#000;"><?= $row_rs_search['tel1']; ?></span></b></p>

              <p><b>Cel. &nbsp;&nbsp;&nbsp;<span style="color:#000;"><?= $row_rs_search['cel1']; ?></span></b></p>
          </div>
          
            <div class="col-md-3" style="margin-top:25px;">
            <img src="<?= $row_rs_search['image']; ?>" class="img-responsive" style="width: 200px; height: 137;"/>
           </div>
           <div class="col-md-12" style="background:<?= $row_rs_search['color'];
				 ?>; border:1px solid <?= $row_rs_search['color']; ?>; border-radius:0px 0px 8px 8px;">
            <p style="float:right; margin-top:6px; height:15px;"><a href="index.php?page=det_ese&id=<?php echo $row_rs_search['Id_ese'].'&'.format_url($row_rs_search['sigle']).':'.format_url($row_rs_search['entreprise']).'/'.format_url(GetLibcateg($row_rs_search['Id_rubrique'])).'/'.format_url(GetLibRub($row_rs_search['Id_sous_rubrique'])).'/annuaire-agriculture-lespagesvertes'; ?>">
                    <span style="color:#fff; font-size:16px;"><b>More details</b></span></a></p>
           </div>
      </div>
    <?php } ?>
    </div>
</div><!--row-->
<?php }
else{
    echo '<script>document.location.href="index.php";</script>';
}?>