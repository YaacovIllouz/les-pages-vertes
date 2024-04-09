<?php
$pub = $db->query("SELECT * FROM pub_site WHERE position = 'Référencement' ORDER BY RAND() LIMIT 1")->fetch();
/*if(!$pub){
	$pub = $db->query("SELECT * FROM pub_site WHERE position = 'Gauche' ORDER BY RAND() LIMIT 1")->fetch();
}*/

$maintenant = time();
?>

<div class="col-md-4">
    <img src="<?= $pub['image']; ?>" class="img-responsive pub_gauche"  />
</div><!--col-md-3"-->
    
<div class="col-md-8">
	<div class="titre_droit" style="border-radius: 5px;"><b>REFERENCEMENT GRATUIT</b></div>
     <!--search-->
	<div class="col-lg-12" style="padding: 0;">
		<?php
			if(!empty($_POST['societe'])) {
				extract($_POST);

				$Upload = new uploadImage(512,600, 600, 80, 80, 'userfiles/image/');
				$Upload->SetExtension(".jpg;.jpeg;.gif;.png");
				$Upload->SetMimeType("image/jpg;image/gif;image/png");

				$msg = '';
				if(!empty($_FILES['userfile'])) {
					if ($Upload->CheckUpload()) {
						if ($Upload->WriteFile()) {
							$tableau = $Upload->GetSummary();


						} else {
							$msg = "<p>Echec 2 du transfert de l'image sur le serveur.</p>";
							$tableau = $Upload->GetError();
							foreach ($tableau as $valeur) {
								$msg .= $valeur . "<br />";
							}
						}
					} else {
						$msg = "<p>Echec 1 du transfert de l'image sur le serveur.</p>";
						$tableau = $Upload->GetError();
						foreach ($tableau as $valeur) {
							$msg .= $valeur . "<br />";
						}
					}
				}
				else{
					$tableau['chemin'] = NULL;
				}

				$rqte = $db->prepare("INSERT INTO entreprise (sigle, entreprise, image, date, tel1, tel2, cel1, fax, certification, 
									marque, email, web, bp, geoloclaisation, activite) 
									VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$rqte->bindParam(1, minToMajSansAccent($sigle));
				$rqte->bindParam(2, minToMajSansAccent($societe));
				$rqte->bindParam(3, $tableau['chemin']);
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
					echo '<script>alert("VOTRE REFERENCEMENT A ETE SOUMIS AVEC SUCCES");</script>';
					echo '<script>document.location.href="?page=referencement";</script>';
				}
				else{
					$msg = 'Une erreur est survenue lors de la soumission de votre referencement.';
				}


				echo '<div style="margin: 15px; "><h3 class="">'.$msg.'</h3></div>';
			}
		?>
	</div>
	<div class="col-lg-12" style="padding: 0;">

		<div style="padding:0px; margin:10px 0; text-align: left;">
			<b>Les champs marqu&eacute;s par  <b>*</b> sont obligatoires</b>
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
				<label class="control-label col-lg-4">Nom de la soci&eacute;t&eacute; *</label>
				<div class="col-lg-8">
					<input type="text" name="societe" required class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Adresse postale</label>
				<div class="col-lg-8">
					<input type="text" name="adr_post" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Adresse </label>
				<div class="col-lg-8">
					<input type="text" name="adr_geo" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">T&eacute;l&eacute;phone 1</label>
				<div class="col-lg-8">
					<input type="text" name="fixe1" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">T&eacute;l&eacute;phone 2</label>
				<div class="col-lg-8">
					<input type="text" name="fixe2" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">T&eacute;l&eacute;phone mobile *</label>
				<div class="col-lg-8">
					<input type="text" name="mobile" required class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Fax</label>
				<div class="col-lg-8">
					<input type="text" name="fax" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Adresse email </label>
				<div class="col-lg-8">
					<input type="email" name="email" class="form-control" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Site web</label>
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
				<label class="control-label col-lg-4">Marque</label>
				<div class="col-lg-8">
					<textarea name="marque" rows="3" class="form-control"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4">Activit&eacute; principale</label>
				<div class="col-lg-8">
					<textarea name="activite" rows="3" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-4"></div>
				<div class="col-lg-8">
					<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
					<input type="submit" name="btnRef" class="btn btn-success" value="Soumettre" style="border-radius: 5px;">
				</div>
			</div>
		</form>
	</div>
	<!--box-->
     
</div><!--col-md-6"-->

