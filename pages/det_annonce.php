<?php 
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = (int) $_GET['id'];
//pub
$pub = $db->query("SELECT image FROM pub_site WHERE position = 'Annonce' ORDER BY RAND() LIMIT 1")->fetch();
if(!$pub){
    $pub = $db->query("SELECT image FROM pub_site WHERE position = 'Gauche' ORDER BY RAND() LIMIT 1")->fetch();
}
?>
<div class="col-md-4">
    <?php if($pub) { ?>
    <img src="<?php echo $pub['image']; ?>"  class="img-responsive img-rounded border" style="height: 940px;" /> 
    <?php }?>
</div><!--col-md-3"-->
    
<div class="col-md-8">
    <div class="titre_droit" style="border-radius:5px;">
        <b>DETAILS ANNONCE</b>
    </div>
    <div class="cleafix">&nbsp;</div>
    <?php 
    $row_rs_annonce = $db->query("SELECT * FROM annonce WHERE etat=1 AND Id=".$id)->fetch();
        $date = explode(' ', $row_rs_annonce['date']);
        ?>
    <div class="col-md-12" style="min-height:100px; border:1px solid #090; margin-bottom:20px; border-radius:10px; padding:0px;">
        <div class="col-md-12" style="padding:5px 10px;">
            <b style=" color:#090;">
                    <?= $row_rs_annonce['titre'];?>
            </b>
        </div><br/>
        <div style="padding:5px 10px;">
            <div style="border-bottom:1px dotted #CCC;">
                <p><?= html_entity_decode($row_rs_annonce['contenu']); ?></p>
            </div>
            <p style="color:#090;"> 
                <b>Entreprise : </b><?= $row_rs_annonce['entreprise']; ?><br />
                <b>T&eacute;l&eacute;phone : </b><?= $row_rs_annonce['contact']; ?> <br/> 
                <b>Email : </b><?= $row_rs_annonce['email']; ?><br/>
                <b>Post&eacute;e par : </b><?= $row_rs_annonce['nom']; ?>
            </p>
       </div>
        <div class="col-md-12" style="background:#090; height:30px; border-radius:0px 0px 8px 8px;">
            <p>
                <span style="float:left; margin-top:5px; height:15px;color:#FFF;">
                    <b><a href="javascript:history.back()" style="color:white;"> << Retour</a></b>
                </span>
                <span style="float:right; margin-top:5px; height:15px;color:#FFF;">
                    Publi&eacute; le <?= '<b>'.reverseDateFr($date[0]). '</b> &agrave <b>'.$date[1].'</b>';?>
                </span>
            </p>
        </div>
    </div>
    <?php } ?>
</div>
