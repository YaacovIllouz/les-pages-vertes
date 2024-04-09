<?php
$pub = $db->query("SELECT image FROM pub_site WHERE position = 'Annonce' ORDER BY Id DESC")->fetch();
/*if(!$pub){
    $pub = $db->query("SELECT image FROM pub_site WHERE position = 'Gauche' ORDER BY RAND() LIMIT 1")->fetch();
}*/
?>

<div class="col-md-4">
    <?php if($pub) { ?>
        <img src="<?php echo $pub['image']; ?>"  class="img-responsive pub_gauche"  />
    <?php }?>
</div><!--col-md-4"-->

<div class="col-md-8">
    <div class="titre_droit" style="border-radius: 5px; font-weight: bold;">SUBMIT AN ADVERTISEMENT</div><br/>
    <div class="col-lg-12">
        <?php 
         if(!empty($_POST['contenu'])){
            $nom        = minToMajSansAccent($_POST['nom']);
            $email      = strtolower($_POST['email']);
            $phone      = $_POST['phone'];
            $entreprise = minToMajSansAccent($_POST['entreprise']);
            $titre      = minToMajSansAccent($_POST['titre']);
            $contenu    = htmlentities($_POST['contenu']); 
            
            if(isEmail($email)){
                //$envoi = envoiMail($email, $destinataire, $sujet, $message, $type='');
                $envoi = $db->query('INSERT INTO annonce SET nom="'.$nom.'", entreprise="'.$entreprise.'", contact="'.$phone.'", 
                        email="'.$email.'", titre="'.$titre.'", contenu="'.$contenu.'", date="'.  gmdate('Y-m-d H:i:s').'", etat=0');
                if($envoi){
                  echo '<script>alert("YOUR ANNOUNCEMENT WAS SUCCESSFULLY SUBMITTED");</script>';
                  echo '<script>document.location.href="?page=ajout_annonce";</script>';
                }
                else{
                  echo '<div><h3 class="alert">An error occurred while sending Of your ad.</h3></div>';
                }
            }
        }
        ?>

       <!-- <div style="text-align: left;">
            <b>Fields marked with * are mandatory</b>
        </div>-->

        <form method="post" class="form-horizontal" style="margin:5px;">

            <div class="form-group">
                <label class="control-label">Name </label>
                <div class="">
                    <input type="text" name="nom" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Company name </label>
                <div class="">
                    <input type="text" name="entreprise" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Phone </label>
                <div class="">
                    <input type="text" name="phone" class="form-control" onkeyup="isNumeric(phone);" maxlength="15" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Email </label>
                <div class="">
                    <input type="email" name="email" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Title</label>
                <div class="">
                    <input type="text" name="titre" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Content  </label>
                <div>
                    <textarea name="contenu"  rows="12" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group">
              <div class="col-lg-7" style="padding:0;">
                  <input type="submit" name="btn" class="btn btn-success" value="Submit" style="border-radius: 5px;">
              </div>
            </div>

        </form>
    </div>        
</div><!--col-md-8"-->
