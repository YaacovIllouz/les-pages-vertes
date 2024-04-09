<?php
$pub = $db->query("SELECT * FROM pub_site WHERE position = 'Contact' ORDER BY Id DESC")->fetchAll();
?>

<div class="col-md-4">
    <?php foreach ($pub as $p) { ?>
    <img src="<?= $p['image']; ?>" class="img-responsive pub_gauche" />
    <?php }?>
</div><!--col-md-4"-->

<div class="col-md-8">
    <div class="titre_droit" style="border-radius: 5px;"><b>CONTACT US<b></div><br/>
    <div class="col-lg-12" style="padding: 0;">
        <?php 
         if (isset($_POST['societe']) && !empty($_POST['societe']) && isset($_POST['phone'])
            && !empty($_POST['phone']) && isset($_POST['message']) && !empty($_POST['message'])) {
            $destinataire = 'info@lespagesvertesci.net'; //pageverteci@gmail.com
            $name = minToMajSansAccent($_POST['nom']);
            $email = strtolower($_POST['email']);
            $phone = $_POST['phone'];
            $societe = minToMajSansAccent($_POST['societe']);
            $sujet = "MESSAGE DE CONTACT";
            $msg = $_POST['message'];

             if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)){
                 $passage_ligne = "\r\n";
             }
             else
             {
                 $passage_ligne = "\n";
             }

             $header = "MIME-Version: 1.0".$passage_ligne;
             if(!empty($name)){
                 $header .= 'From:'.$name.' <'.$email.'>';
             }
             else{
                 $header .= 'From:'.$societe.' <'.$email.'>';
             }

$message = 'NOM & PRENOM: '.$name.$passage_ligne;
$message .= 'CONTACT : '.$phone.$passage_ligne;
$message .= 'EMAIL : '.$email.$passage_ligne;
$message .= 'SOCIETE : '.$societe.$passage_ligne.$passage_ligne.$passage_ligne;;

             //=====Ajout du message au format texte.

$message .= 'MESSAGE:'.$passage_ligne.$passage_ligne.strip_tags($msg);

            if(isEmail($email)){
                $envoi = mail($destinataire, $sujet, $message, $header);
                if($envoi){
                  echo '<div><h5 class="alert alert-success">Your message has been sent.
                   We\'ll be back soon. <br> Thanks & Soon.</h5></div>';
                }
                else{
                  echo '<div><h5 class="alert alert-danger">An error occurred while sending
                   your message.</h5></div>';
                }
            }
        }
        ?>
    </div>
    <div class="col-lg-12">           
        <form method="post" class="form-horizontal" style="margin:5px;">

            <div class="form-group">
                <label class="control-label">Company name *</label>
                <div class="">
                    <input type="text" name="societe" class="form-control" required />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Name</label>
                <div class="">
                    <input type="text" name="nom" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Contact *</label>
                <div class="">
                    <input type="text" name="phone" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Email </label>
                <div class="">
                    <input type="email" name="email" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Message * </label>
                <div>
                    <textarea name="message" rows="15" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group">
              <div class="col-lg-7" style="padding:0;">
                  <input type="submit" name="btnMsg" class="btn btn-success active" value="Submit" style="border-radius: 5px;">
              </div>
            </div>

        </form>
    </div>        
</div><!--col-md-8"-->