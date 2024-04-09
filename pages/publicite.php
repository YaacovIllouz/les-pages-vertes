<?php
$pub = $db->query("SELECT * FROM pub_site WHERE position = 'Annonce' ORDER BY Id DESC")->fetchAll();
/*if(!$pub){
   $pub = $db->query("SELECT * FROM pub_site WHERE position = 'Gauche' ORDER BY Id DESC LIMIT 1")->fetchAll(); 
}*/
?>

<div class="col-md-4 ">
   <?php foreach ($pub as $p) { ?>
   <img src="<?php echo $p['image']; ?>" class="img-responsive pub_gauche" alt="pub" />
   <?php } ?>
</div><!--col-md-3"-->
    
<div class="col-md-8">
    <div class="titre_droit" style="border-radius: 5px;"><b>PUBLICITE<b></div>
    <div style="float:left;"><br />
        <img src="images/Format publicite.jpg" alt="Pub" width="500" height="643" />
        <h6 class="title">
            <b>
                POUR TOUTES INFORMATIONS, BIEN VOUS POUVEZ NOUS ECRIRE VIA 
                <a href="index.php?page=contact" style="color: #090;">LE FORMULAIRE DE CONTACT</a>
            </b>
        </h6>
    </div>
</div><!--col-md-8"-->
