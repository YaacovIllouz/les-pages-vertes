<?php
$pub = $db->query("SELECT * FROM pub_site WHERE position = 'Référencement' ORDER BY Id DESC")->fetch();
/*if(!$pub){
	$pub = $db->query("SELECT * FROM pub_site WHERE position = 'Gauche' ORDER BY RAND() LIMIT 1")->fetch();
}*/

$maintenant = time();
?>

<div class="col-md-4 ">
    <img src="<?= $pub['image']; ?>" class="img-responsive pub_gauche" />
</div><!--col-md-3"-->
    
<div class="col-md-8">
	<div class="titre_droit" style="border-radius: 5px;"><b>FREE REFERENCING</b></div>
     <!--search-->
	<div class="col-lg-12" style="padding: 0;">
		<?php
			if(!empty($_POST['societe']) && !empty($_POST['fixe1'])) {
				extract($_POST);
				/*
				if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)){
					$passage_ligne = "\r\n";
				}
				else {
					$passage_ligne = "\n";
				}

				$header = "MIME-Version: 1.0".$passage_ligne;
				$header .= 'From:'.$societe.' <'.$email.'>';;

				$destinataire = 'info@lespagesvertesci.net'; //pageverteci@gmail.com
				$sujet = "REFERENCEMENT";

				$message = 'SIGLE: '.minToMajSansAccent($sigle).$passage_ligne;
				$message .= 'SOCIETE: '.minToMajSansAccent($societe).$passage_ligne;
				$message .= 'TELEPHONE 1: '.$fixe1.$passage_ligne;
				$message .= 'TELEPHONE 2: '.$fixe2.$passage_ligne;
				$message .= 'MOBILE: '.$mobile.$passage_ligne;
				$message .= 'FAX: '.$fax.$passage_ligne;
				$message .= 'EMAIL: '.$email.$passage_ligne;
				$message .= 'ADRESSE POSTALE : '.minToMajSansAccent($adr_post).$passage_ligne;
				$message .= 'ADRESSE GEOGRAPHIQUE : '.$adr_geo.$passage_ligne;
				$message .= 'SITE WEB: '.$site_web.$passage_ligne.$passage_ligne;
				$message .= 'MARQUE: '.$marque.$passage_ligne.$passage_ligne;
				$message .= 'CERTIFICATION: '.$certif.$passage_ligne.$passage_ligne;
				$message .= 'ACTIVITE PRINCIPALE : '.$activite.$passage_ligne.$passage_ligne.$passage_ligne;

				//if(isEmail($email)){
					$envoi = mail($destinataire, $sujet, $message, $header);
					if($envoi){
						echo '<div><h5 class="alert alert-success"><b>Votre r&eacute;f&eacute;rencement a &eacute;t&eacute; 
                  		soumis avec succ&egrave;s. Merci et &agrave; bient&ocirc;t.</b></h5></div>';
					}
					else{
						echo '<div><h5 class="alert alert-danger">Une erreur est survenue lors de l\'envoi 
                 		de votre message.</h5></div>';
					}
				//}*/

				$Upload = new uploadImage(512, 250, 250, 80, 80, 'userfiles/image/');
				$Upload->SetExtension(".jpg;.jpeg;.gif;.png");
				$Upload->SetMimeType("image/jpg;image/gif;image/png");

				$msg = '';
				if($Upload->CheckUpload()) {
					if($Upload->WriteFile()) {
						$tableau = $Upload->GetSummary();

						$rqte = $db->prepare("INSERT INTO entreprise (sigle, entreprise, image, date, tel1, tel2, cel1, fax, certification, 
									marque, email, web, bp, geoloclaisation, activite) 
									VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
						$rqte->bindParam(1, minToMajSansAccent($sigle));
						$rqte->bindParam(2, minToMajSansAccent($societe));
						$rqte->bindParam(3, substr($tableau['chemin'],3));
						$rqte->bindParam(4, time());
						$rqte->bindParam(5, $fixe1);
						$rqte->bindParam(6, $fixe2);
						$rqte->bindParam(7, $mobile);
						$rqte->bindParam(8, $fax);
						$rqte->bindParam(9, $certif);
						$rqte->bindParam(10, $marque);
						$rqte->bindParam(11, $email);
						$rqte->bindParam(12, $site_web);
						$rqte->bindParam(13, minToMajSansAccent($adr_post));
						$rqte->bindParam(14, $adr_geo);
						$rqte->bindParam(15, $activite);
						$envoi = $rqte->execute();
						if($envoi){
							echo '<script>alert("YOUR REFERENCING HAS BEEN SUCCESSFULLY SUBMITTED");</script>';
							echo '<script>document.location.href="?page=referencement";</script>';
						}
						else{
							$msg = 'An error occurred while submitting your SEO';
						}

					}
					else {
						$msg = "<p>Echec 2 du transfert de l'image sur le serveur.</p>";
						$tableau = $Upload-> GetError();
						foreach ($tableau as $valeur)
						{
							$msg .= $valeur."<br />";
						}
					}
				}
				else {
					$msg = "<p>Echec 1 du transfert de l'image sur le serveur.</p>";
					$tableau = $Upload->GetError();
					foreach ($tableau as $valeur) {
						$msg .= $valeur."<br />";
					}
				}

				echo '<div style="margin: 15px; "><h5 class="alert alert-danger">'.$msg.'</h5></div>';
			}
		?>
	</div>
	<div class="col-lg-12" style="padding: 0;">

		<div style="padding:0px; margin:10px 0; text-align: left;">
			<b>Fields marked with * are mandatory</b>
		</div>
		<form method="post" class="form-horizontal" style="margin:5px;" enctype="multipart/form-data" >

			<br/>
			<div class="form-group">
				<label class="control-label col-lg-4">Logo</label>
				<div class="col-lg-8">
					<input type="file" name="userfile" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Sigle</label>
				<div class="col-lg-8">
					<input type="text" name="sigle" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Company name *</label>
				<div class="col-lg-8">
					<input type="text" name="societe" required class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Address</label>
				<div class="col-lg-8">
					<input type="text" name="adr_post" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Geographic address </label>
				<div class="col-lg-8">
					<input type="text" name="adr_geo" required class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Phone 1 *</label>
				<div class="col-lg-8">
					<input type="text" name="fixe1" required class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Phone 2</label>
				<div class="col-lg-8">
					<input type="text" name="fixe2" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Mobile</label>
				<div class="col-lg-8">
					<input type="text" name="mobile" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Fax</label>
				<div class="col-lg-8">
					<input type="text" name="fax" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Email </label>
				<div class="col-lg-8">
					<input type="email" name="email" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Web Site</label>
				<div class="col-lg-8">
					<input type="text" name="site_web" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Certification</label>
				<div class="col-lg-8">
					<textarea name="certif" rows="3" class="form-control"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Brand</label>
				<div class="col-lg-8">
					<textarea name="marque" rows="3" class="form-control"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Activities</label>
				<div class="col-lg-8">
					<textarea name="activite" rows="3" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-4"></div>
				<div class="col-lg-8">
					<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
					<input type="submit" name="btnRef" class="btn btn-success" value="Submit" style="border-radius: 5px;">
				</div>
			</div>
		</form>
	</div>
	<!--box-->
     
</div><!--col-md-6"-->

