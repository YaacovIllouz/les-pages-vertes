<?php
//pub gauche
$pub_gauche = $db->query("SELECT image FROM pub WHERE Id_ese = '".$_GET['id']."' ORDER BY Id DESC LIMIT 1")->fetch();
/*if(!$pub_gauche){
    $pub_gauche = $db->query("SELECT image FROM pub_site WHERE position='Gauche' ORDER BY RAND() LIMIT 1")->fetch();
}*/

//info de l'entreprisse dont l'id est passer par le get
$ese = $db->query("SELECT E.*, R.*, S.rubrique AS sous_rub FROM entreprise E, rubrique R, sous_rubrique S 
                   WHERE E.Id_sous_rubrique=S.Id AND R.Id=S.Id_rubrique AND E.Id_ese =".$_GET['id'])->fetch();
				   
$ese_pubgauche = $db->query("SELECT * FROM entreprise WHERE etat_pubgauche = 1 AND Id_ese =".$_GET['id'])->fetch();				   
				   
$pub_gauche_fiche = $ese_pubgauche['pub_gauche']; 
$pub_bas_fiche = $ese['pub_bas'];

if($pub_gauche_fiche!=''){$pub_gauche = $pub_gauche_fiche;}
else {$pub_gauche = $pub_gauche['image'];}
//else {$pub_gauche = 'userfiles/image/les-pages-vertes.jpg';}
$lien = $ese['web'];

				   
?>

<div class="col-md-4">
    <div  style="border-radius:5px; border:1px solid <?=$ese['color'];?>; max-height: 950px;height:950px;width:265px;">
       
            <a href="<?= $lien; ?>" target="_blank">
                <img src="<?= $pub_gauche; ?>" class="img-responsive img-rounded"  alt="" />
            </a>
        
    </div>
</div><!--col-md-4"-->

<div class="col-md-8"  style="min-height:100px; border-radius:3px; border:1px solid <?=$ese['color'];?>;">
    <div  class="box" style="padding:5px; font-size:15px; margin-top:15px;">
        <div class="row">

            <div class="col-md-9">
                <h4 style="font-weight:bold; font-size:20px; color:#000;"><b><?= minToMajSansAccent($ese['sigle']); ?></b></h4>
                <h5 style="font-weight:bold; font-size:18px; color:#000; text-transform: uppercase;"><b><?= $ese['entreprise']; ?></b></h5>

                <h5><span style="color:<?= $ese['color']; ?>;"><b><?= $ese['rubrique']; ?></b></span></h5>
                <h5 style="line-height: 0.3"><span style="font-size:12px; color:<?= $ese['color']; ?>;"><b><?=$ese['sous_rub'];?></b></span></h5>
            </div><!--col-md-6"-->
                        <div class="col-md-3">
                <img alt="logo" src="<?php echo $ese['image']; ?>" class="img-responsive"/>
            </div><!--col-md-6"-->
        </div><!--row"-->
        <br />

        <div style="border-bottom:1px dotted #CCC;">
            <div class="row">
             		<div class="col-md-3"><b style=" font-weight:bold; font-size:16px;">Tél. </b></div><!--col-md-6"-->
                    <div class="col-md-9"><span style="color:#000;"><b><?php echo $ese['tel1']; ?></b></span></div><!--col-md-6"-->
            </div><!--row"-->
        </div>
        <br />

         <div style="border-bottom:1px dotted #CCC;">
             <div class="row">
             		<div class="col-md-3"><b style=" font-weight:bold; font-size:16px;">Fax</b></div><!--col-md-6"-->
                    <div class="col-md-9"><span style="color:#000;"><b><?php echo $ese['fax']; ?></b></span></div><!--col-md-6"-->
             </div><!--row"-->
         </div>
          <br />

        <div style="border-bottom:1px dotted #CCC;">
            <div class="row">
             		<div class="col-md-3"><b style=" font-weight:bold; font-size:16px;">Cel. </b></div><!--col-md-6"-->
                    <div class="col-md-9"><span style="color:#000;"><b><?php echo $ese['cel1']; ?></b></span></div><!--col-md-6"-->
             </div><!--row"-->
             </div>
             <br />

             <div style="border-bottom:1px dotted #CCC;">
             <div class="row">
             		<div class="col-md-3"><b style=" font-weight:bold; font-size:16px;">Email</b></div><!--col-md-6"-->
                    <div class="col-md-9"><span style="color:#000;"><b><?php echo $ese['email']; ?></b></span></div><!--col-md-6"-->
             </div><!--row"-->
             </div>
             <br />

             <div style="border-bottom:1px dotted #CCC;">
             <div class="row">
             		<div class="col-md-3"><b style=" font-weight:bold; font-size:16px;">Site web</b></div><!--col-md-6"-->
                    <div class="col-md-9"><a href="<?php echo $ese['web']; ?>" target="_blank"><span style="color:#000;"><b><?php echo $ese['web']; ?></b></span></a></div><!--col-md-6"-->
             </div><!--row"-->
             </div>
                <br />

             <div style="border-bottom:1px dotted #CCC;">
             <div class="row">
             		<div class="col-md-3"><b style=" font-weight:bold; font-size:16px;">Marque</b></div><!--col-md-6"-->
                    <div class="col-md-9"><span style="color:#000;"><b><?php echo $ese['marque']; ?></b></span></a></div><!--col-md-6"-->
             </div><!--row"-->
             </div>
                <br />

             <div style="border-bottom:1px dotted #CCC;">
             <div class="row">
             		<div class="col-md-3"><b style=" font-weight:bold; font-size:16px;">Certification</b></div><!--col-md-6"-->
                    <div class="col-md-9"><span style="color:#000;"><b><?= $ese['certification']; ?></b></span></a></div><!--col-md-6"-->
             </div><!--row"-->
             </div>
               <br />


        <div style="border-bottom:1px dotted #CCC;">
            <div class="row">
                <div class="col-md-3"><b style=" font-weight:bold; font-size:16px;">Membres </b></div><!--col-md-6"-->
                <div class="col-md-9">
                    <b><?php echo $ese['membre']; ?></b>

                </div><!--col-md-6"-->
            </div><!--row"-->
        </div>
        <br />


        <div style="border-bottom:1px dotted #CCC;">
             <div class="row">
             		<div class="col-md-3"><b style=" font-weight:bold; font-size:16px;">Adresse </b></div><!--col-md-6"-->
                    <div class="col-md-9">
                        <b><?php echo $ese['geoloclaisation']; ?></b><br/>
                        <b><?php echo $ese['bp']; ?></b>

                    </div><!--col-md-6"-->
             </div><!--row"-->
             </div>
             <br />

             <div style="border-bottom:1px dotted #CCC;">
             <div class="row">
             		<div class="col-md-3"><b style=" font-weight:bold; font-size:16px;">Activit&eacute;s Missions </b></div><!--col-md-6"-->
                    <div class="col-md-9"><b><?php echo $ese['activite']; ?></b></div><!--col-md-6"-->
             </div><!--row"-->
             </div>

      </div><!--box"-->

        <div class="row">
            <div class="col-md-4">
                <div class="titre_droit4" style="text-align: center; border-radius:3px;">
                    <a href="index.php?page=agence&id=<?php echo $ese['Id_ese']; ?>" style="color:#FFF;"> Nos agences
                </div>
            </div><!--col-md-4-->

            <div class="col-md-4">
                <div class="titre_droit4" style="text-align:center; border-radius:3px;">
                    <a href="index.php?page=contact" style="color:#FFF;">Modification</a>
                </div>
            </div><!--col-md-4-->

            <div class="col-md-4">
               <div class="titre_droit4" style="text-align:center; border-radius:3px;">
                   <a href="index.php?page=contact" style="color:#FFF;">Contacter la société</a>
               </div>
            </div><!--col-md-4-->
        </div>
        <br/>
    </div><!--col-md-6"-->

    <div class="clearfix"><br/></div>
    <div class="clearfix"><br/></div>

<div class="clearfix">&nbsp;</div>
<!--<div class="container">
	<div class="row">
        <div class="clearfix"><br/></div>-->
        <?php
        /*$pub_bas =  $db->query("SELECT * FROM pub_site WHERE position = 'Pub Fiche' ORDER BY Id DESC LIMIT 0,1")->fetch();
        if($pub_bas) {
           echo '<div class="img-responsive">
                <img src="'.$pub_bas['image'].'" alt="Pub bas" class="img-responsive" style="border-radius: 5px;" />
            </div>';
        }*/
        ?>
    	<!--<div class="col-md-4" style="display: none;">
            <div class="last_add" style="border:1px solid #090; border-radius:3px 3px 3px 3px;">
                <div class="titre_droit" style="border-radius: 5px; font-weight: bold;">DERNIERES ENTREPRISES AJOUTEES</div>
                <?php
/*                $last = $db->query("SELECT Id_ese, sigle, entreprise, image FROM entreprise WHERE Id_rubrique > 0 ORDER BY Id_ese DESC LIMIT 0,3")->fetchAll();
                */?>
                <br />
                <div>
                    <?php /*foreach ($last as $row_rs_lats_ese) { */?>
                        <div class="col-md-3" style="height:60px;">
                            <a href="index.php?page=det_ese&id=<?/*= $row_rs_lats_ese['Id_ese']; */?>">
                                <img src="<?/*= $row_rs_lats_ese['image']; */?>"  class="img-responsive" alt="logo" />
                            </a>
                        </div><!--col-md-4- ->
                        <div class="col-md-9" style="height:80px; font-weight: bold; ">
                            <a href="index.php?page=det_ese&id=<?/*= $row_rs_lats_ese['Id_ese']; */?>">
                                <span style="color:#060; font-size:18px;"><b><?/*= $row_rs_lats_ese['sigle']; */?></b></span><br />
                                <span style="color:#000; font-size:14px;"><b><?/*= $row_rs_lats_ese['entreprise']; */?></b></span>
                            </a>
                        </div> <!--col-md-9 - ->
                       <div class="clearfix">&nbsp;</div>
                    <?php /*} */?>
                </div>
            </div><!--slide- ->
        </div>
        <div class="col-md-8" style="display: none;">
        	<div class="pub_horizontal">
                <?php
/*                $pub_bas = $db->query("SELECT * FROM pub_site WHERE position = 'Entreprise' ORDER BY RAND() LIMIT 1")->fetch();
                if($pub_bas) {
                */?>
                <img src="<?/*= $pub_bas['image']; */?>" class="img-responsive img-rounded border" alt="pub" />
				<?php /*} */?>
            </div>
        </div>
    </div><!--row
</div><!--container-->