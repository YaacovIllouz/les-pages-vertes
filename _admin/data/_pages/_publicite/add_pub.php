<?php
$id_ese=$_GET['id'];
$query_ese_data = "SELECT * from entreprise WHERE Id_ese = $id_ese LIMIT 1;";
//echo $query_pag_data;
$exe_findese = mysql_query($query_ese_data);
$data_ese = @mysql_fetch_array($exe_findese);

$entreprise = addslashes($_POST['entreprise']);
$position_pub = addslashes($_POST['empl']);
$date_crea_pub=time();
$etat_pub = 1;

include 'upload1.php';

$fichier_logo = 'userfiles/image/'.$nomlogo;


if(($_POST['valider'])&&($ok1=1))
{

	
	/*if(($fichier!="")&&($format_img=='ok'))
	{*/			
	$insertion = "INSERT INTO pub VALUES
('', 
 '".$fichier_logo."',
 '".$date_crea_pub."', 
 '".$entreprise."',
 '".$position_pub."', 
 '".$etat_pub."'
 )";
	//echo $insertion;
	//echo $insertion.' extension='.$extension.' '.$format_img.' '.$ok1;
	
	$exe_insert = mysql_query($insertion);
	
	if($exe_insert)
	{		
		$msge = '<font class="confirm">&nbsp; AFFICHE ENREGISTREE AVEC SUCCES</font>';
		
		}
	else
	 {
		 $msge = '<font class="refuse"> IMPOSSIBLE D\'ENREGISTRER CETTE AFFICHE</font>';
		 }
	/*}
	else $msge = '<font class="refuse"> FORMAT D\'IMAGE NON AUTORISE ('.$extension.')</font>';*/
	
}
?>



<div class="div_princ_ref">
<table width="100%" border="0">
  <tr>
    <td width="42%" align="left"><h3 class="titre_page">
  AJOUT D'UNE PUBLICITE FICHE ENTREPRISE
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
	if($row['Id_ese']==$data_ese['Id_ese']){
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
      <input name="empl" type="radio" id="radio" value="HAUT" onChange="choix('haut')" <?php if($_POST['empl']=="HAUT") echo 'checked';?>>
      <span>Gauche </span>
      <input type="radio" name="empl" id="radio2" value="GAUCHE" onChange="choix('gauche')" <?php if($_POST['empl']=="GAUCHE") echo 'checked';?>>
		
      </div></td>
  
  <tr>
    <td height="45" class="font_tab">Téléchargez la pub ici</td>
    <td>
    <!-- DEBUT -->
   
												
													<div data-fileupload="image" class="fileupload fileupload-new">
														<input type="hidden" />
														<div style="width: 200px; height: 150px;" class="fileupload-new thumbnail"></div>
														<div style="width: 200px; height: 150px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
														<span class="btn btn-file"><span class="fileupload-new">Choisir image</span><span class="fileupload-exists">Modifier</span><input type="file" id="fileinput" name="logo" required/></span>
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
