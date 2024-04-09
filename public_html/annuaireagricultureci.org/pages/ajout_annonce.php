<?php
$pub = $db->query("SELECT image FROM pub_site WHERE position = 'Annonce' ORDER BY Id DESC LIMIT 1")->fetch();
/*if(!$pub){
    $pub = $db->query("SELECT image FROM pub_site WHERE position = 'Gauche' ORDER BY RAND() LIMIT 1")->fetch();
}*/
?>

<div class="col-md-4">
    <?php if($pub) { ?>
        <img src="<?php echo $pub['image']; ?>"  class="img-responsive pub_gauche"/>
    <?php }?>
</div><!--col-md-4"-->

<div class="col-md-8">
    <div class="titre_droit" style="border-radius: 5px; font-weight: bold;">SOUMETTRE UNE ANNONCE</div><br/>
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
                  echo '<script>alert("VOTRE ANNONCE A ETE ENVOYEE AVEC SUCCES");</script>';
                  echo '<script>document.location.href="?page=ajout_annonce";</script>';
                }
                else{
                  echo '<div><h3 class="alert alert-danger">Une erreur est survenue lors de l\'envoi 
                  de votre annonce.</h3></div>';
                }
            }
        }
        ?>

       <!-- <div style="text-align: left; margin: 0 0 0 -10px;">
            <b>Les champs marqu&eacute;s par <b>*</b> sont obligatoires</b>
        </div>-->

        <form method="post" class="form-horizontal" style="margin:5px;">

            <div class="form-group">
                <label class="control-label">Nom & Pr&eacute;nom </label>
                <div class="">
                    <input type="text" name="nom" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Nom de la soci&eacute;t&eacute; </label>
                <div class="">
                    <input type="text" name="entreprise" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">T&eacute;l&eacute;phone </label>
                <div class="">
                    <input type="text" name="phone" class="form-control" onkeyup="isNumeric(phone);" maxlength="15" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Adresse email </label>
                <div class="">
                    <input type="email" name="email" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Titre de l'annonce</label>
                <div class="">
                    <input type="text" name="titre" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Contenu de l'annonce </label>
                <div>
                    <textarea name="contenu"  rows="12" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group">
              <div class="col-lg-7" style="padding:0;">
                  <input type="submit" name="btn" class="btn btn-success" value="Soumettre" style="border-radius: 5px;">
              </div>
            </div>

        </form>
    </div>        
</div><!--col-md-8"-->
