<?php

$id=$_GET['com'];
//-------------- -------------------//
$select_pub="SELECT * from pub WHERE Id = '".$id."' ";
$exe_reqpub = mysql_query($select_pub);
$result_pub=mysql_fetch_array($exe_reqpub);
//--------------- -----------------//
$fichier_actuel = $result_pub['image'];

$entreprise = addslashes($_POST['entreprise']);
$position_pub = addslashes($_POST['empl']);
$date_crea_pub=time();
$etat_pub = 1;

include 'upload1.php';

$fichier_logo = 'userfiles/image/'.$nomlogo;


if($_POST['valider'])
{

	if(($fichier!="")&&($ok1=1)){
		$chemin_fichier = $fichier_logo;
		@unlink('../../'.$fichier_actuel);
		} else {$chemin_fichier = $fichier_actuel;}
				
	$modif = "UPDATE pub SET Id_ese='".$entreprise."', position_pub='".$position_pub."', image='".$chemin_fichier."' WHERE Id='".$id."' ";
	//echo $insertion;
	//echo $insertion.' extension='.$extension.' '.$format_img.' '.$ok1;
	
	$exe_modif = mysql_query($modif);
	
	if($exe_modif)
	{		
		$msge = '<font class="confirm">&nbsp; PUB MODIFIEE AVEC SUCCES</font>';
		
		}
	else
	 {
		 $msge = '<font class="refuse"> IMPOSSIBLE D\'ENREGISTRER CETTE PUB</font>';
		 }

	
}
?>



<div class="div_princ_ref">
<table width="100%" border="0">
  <tr>
    <td width="42%" align="left"><h3 class="titre_page">
  EDITION D'UNE PUBLICITE FICHE ENTREPRISE
</h3></td>
    <td width="25%" align="center"><?php echo $msge.' '.$erreur;?></td>
    <td width="33%" align="right"><a href="accueil.php?page=?.liste_pubese" class="ajout">[Liste des affiches publicitaires]</a></td>
  </tr>
</table>
<form name="frm_pub" method="post" action="" enctype="multipart/form-data">
<fieldset class="fieldset_1">
<legend class="info_zone">&nbsp;</legend>
<table width="60%" border="0" align="center"  cellspacing="8">
<tr>
    <td height="35" align="left"><label for="tcontrat" class="obl">Entreprise : </label></td>
    <td align="left">
	
		<select name="entreprise" data-placeholder="Choisir une catégorie" class="select_contrat" style="width:400px">
<option value="vide">- Choisissez une catégorie -</option>

<?php
// Appel des regions
$req = "SELECT Id_ese, sigle, entreprise FROM entreprise ORDER BY entreprise ASC";
$rep = mysql_query($req)or die (mysql_error());

while ($row = mysql_fetch_array($rep)) {
	if(($row['sigle']!="")&&($row['entreprise']!="")){$tiret=" - ";} else {$tiret="";}
	if($row['Id_ese']==$result_pub['Id_ese']){
	echo "<option value=".$row['Id_ese']." selected>".$row['sigle'].$tiret.$row['entreprise']."</option>";} else {
	echo "<option value=".$row['Id_ese'].">".$row['sigle'].$tiret.$row['entreprise']."</option>";	
		}
} 
@mysql_free_result($req);
?>
</select>
	
</td>
</tr> 
  <td width="36%" height="35" align="left"><label for="tcontrat" class="obl">Emplacement : </label></td>
    <td align="left"><div align="left"><span>Haut </span>
      <input name="empl" type="radio" id="radio" value="haut" <?php if($result_pub['position_pub']=="haut") echo 'checked';?>>
      <span>Gauche </span>
      <input type="radio" name="empl" id="radio2" value="gauche" <?php if($result_pub['position_pub']=="gauche") echo 'checked';?>>
		
      </div></td>
  
  <tr>
    <td height="45" class="font_tab">Téléchargez la pub ici</td>
    <td>
    <!-- DEBUT -->
   
												
													<div data-fileupload="image" class="fileupload fileupload-new">
														<input type="hidden" />
														<div style="width: 200px; height: 150px;" class="fileupload-new thumbnail"><img src="<?php echo '../../'.$result_pub['image']; ?>" /></div>
														<div style="width: 200px; height: 150px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
														<span class="btn btn-file"><span class="fileupload-new">Choisir image</span><span class="fileupload-exists">Modifier</span><input type="file" id="fileinput" name="logo" /></span>
														<a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Supprimer</a>
													</div>	
												
											
    
    <!-- FIN -->
    </td>
  </tr>
  <tr>
    <td height="21" class="font_tab">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21" class="font_tab">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21" class="font_tab">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;</td>
    <td><div>
      <input type="submit" name="valider" class="valider" value="Valider" />
    </div></td>
  </tr>
</table>
</fieldset>
<br>
</form>
</div>
