<?php
##Debut Fonction php
    if (!function_exists("GetSQLValueString")) {
        function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
        {
            if (PHP_VERSION < 6) {
                $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
            }

            $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

            switch ($theType) {
                case "text":
                    $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                    break;
                case "long":
                case "int":
                    $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                    break;
                case "double":
                    $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                    break;
                case "date":
                    $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                    break;
                case "defined":
                    $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                    break;
            }
            return $theValue;
        }
    }
##Fin Fonction php

### DEBUT GENERATION DE KEY TURING
function code_key_2(){
		$taille =20 ;
		$lettres = "1G345E7F90ABCHI@JKMLNOPQRSTUVWYZ";
		srand(time());
		for ($i=0;$i<$taille;$i++){
			$key_alea.=substr($lettres,(rand()%(strlen($lettres))),1);
		}
		return ('ICT'.$key_alea.'T');
	}
	if($idex==''){
	$key_alea=code_key_2();
	}
	else{
	$key_alea='ICT'.$idex.'T';
	}
### FIN GENERATION DE KEY IMPORT CONTACT

$query_cat_data = "SELECT * from rubrique ORDER BY rubrique ASC";
//echo $query_pag_data;
$exe_findcat = mysql_query($query_cat_data) or die('MySql Error' . mysql_error());

$msg = "";
$nb_cat = mysql_num_rows($exe_findcat);

/*
$query_pays_data = "SELECT * from pays WHERE statut = 1 ORDER BY lib_pays ASC";
//echo $query_pag_data;
$exe_findpays = mysql_query($query_pays_data) or die('MySql Error' . mysql_error());
*/


// Appel des rubriques
//$req = "SELECT Id, rubrique FROM rubrique ORDER BY rubrique ASC";
//$rep = mysql_query($req)or die (mysql_error());
//echo 'nbre : '.$nb_ctt = mysql_num_rows($rep);

$table = "entreprise";
$sigle = addslashes($_POST['sigle']);
$sigle = preg_replace("#[;:&\"]+#", " ", $sigle);

$entreprise = addslashes($_POST['denomi']);
$dirigeant = addslashes($_POST['dirigeant']);
$membre = addslashes($_POST['membre']);
$cat = addslashes($_POST['rubrique']);
$rub = addslashes($_POST['sous_rubrique']);
$marque = addslashes($_POST['marque']);
$activite = addslashes($_POST['activite']);
$tel = $_POST['tel'];
$tel2 = $_POST['tel2'];
$fax = $_POST['fax'];
$cel = $_POST['cel'];
$cel2 = $_POST['cel2'];
$certif = $_POST['certif'];
$email = addslashes($_POST['email']);
$site = addslashes($_POST['site']);
$adr_postale = addslashes($_POST['bp']);
$adr_geo = addslashes($_POST['adr_geo']);
$date_crea=time();
$flag_ese=1;


include 'upload1.php';

$fichier_logo = 'userfiles/image/'.$nomlogo;

if(($_POST['valider'])&&($cat!="")&&($rub!=""))
{
	if($fichier!=""){$chemin_fichier = $fichier_logo;} else {$chemin_fichier="userfiles/image/img_indispo.jpg";}
	
	$check_sigle="SELECT * FROM $table WHERE sigle = '".$sigle."' AND Id_rubrique = '".$cat."' AND Id_sous_rubrique = '".$rub."' ";
	
	$exe_check=mysql_query($check_sigle);
	$nbre=mysql_num_rows($exe_check);
	if($nbre==0){

$insertSQL = sprintf("INSERT INTO entreprise (sigle, entreprise, image, `date`, tel1, tel2, cel1, fax, certification, marque, membre, email, web, bp, geoloclaisation, activite, lien_video, etat_video, Id_rubrique, Id_sous_rubrique, flag_ese) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                    GetSQLValueString($sigle, "text"),
                    GetSQLValueString($entreprise, "text"),
                    GetSQLValueString($chemin_fichier, "text"),
                    GetSQLValueString($date_crea, "text"),
                    GetSQLValueString($tel, "text"),
                    GetSQLValueString($tel2, "text"),
                    GetSQLValueString($cel1, "text"),
                    GetSQLValueString($fax, "text"),
                    GetSQLValueString($certif, "text"),
                    GetSQLValueString($marque, "text"),
                    GetSQLValueString($membre, "text"),
                    GetSQLValueString($email, "text"),
                    GetSQLValueString($site, "text"),
                    GetSQLValueString($adr_postale, "text"),
                    GetSQLValueString($adr_geo, "text"),
                    GetSQLValueString($activite, "text"),
                    GetSQLValueString($_POST['lien_video'], "text"),					
                    GetSQLValueString($_POST['etat_video'], "int"),					
                    GetSQLValueString($cat, "int"),
                    GetSQLValueString($rub, "int"),
                    GetSQLValueString($flag_ese, "int"));

	
	//echo $insertSQL;
	
	$exe_insert = mysql_query($insertSQL);
	
	if($exe_insert)
	{		
		$msge = '<div align="center"><font style="color:#008C00; font-size:14px; font-weight:600">&nbsp; ENREGISTREMENT EFFECTUE AVEC SUCCES </font></div>';
		$msge.='<meta http-equiv=refresh content="5; url=?page=?.add_ref">';			
		}
	else
	 {
		 $msge = '<div align="center"><font style="color:#F00; font-size:14px; font-weight:600">ENREGISTREMENT IMPOSSIBLE</font></div>';
		 }	
	
	}else
	 {
		 $msge = '<font style="color:#F00; font-size:14px; font-weight:600"> REFERENCEMENT DEJA EXISTANT</font>';
		 }	
	
}
?><head>

<link rel="stylesheet" href="css/style_ref.css" />
<!-- DEBUT LISTE LIEE CAT ET RUBRIQUE-->

<script type="text/javascript">

function writediv(texte)
{
document.getElementById('loginbox').innerHTML = texte;
}

function verifsigle(sigle)
{
if(sigle != '')
{
if(sigle.length<2)
writediv('<span style="color:#cc0000; font-size:14px"><b>'+sigle+' :</b> Sigle trop court</span>');
else if(sigle.length>4000)
writediv('<span style="color:#cc0000; font-size:14px"><b>'+sigle+' :</b> Sigle est trop long</span>');
else if(texte = file('verif_sigle.php?sigle_ste='+escape(sigle)))
{
if(texte == 1)
writediv('<span style="color:#cc0000; font-size:14px"><b>'+sigle+' :</b> Sigle d&eacute;j&agrave; r&eacute;f&eacute;renc&eacute;</span>');
else if(texte == 2)
writediv('<br><span style="color:#1A7917; font-size:14px"><b>'+sigle+' :</b> Sigle non r&eacute;f&eacute;renc&eacute;</span>');
else
writediv(texte);
}
}

}


</script>


<!-- DEBUT LISTE LIEE CAT ET RUBRIQUE -->
	<script type="text/javascript" src="jquery_.js"></script>    
	<script type="text/javascript" src="jquery.chained_.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>




<table width="100%" border="0">
  <tr>
    <td width="32%" align="left"><h3 class="titre_page">
  AJOUT D'UNE ENTREPRISE
</h3></td>
    <td width="41%" align="center"><?php echo $msge.' '.$erreur;?></td>
    <td width="27%" align="right"><a href="accueil.php?page=?.liste_ref" class="ajout">[Liste des r&eacute;f&eacute;rencements]</a></td>
  </tr>
</table>
<div class="div_princ_ref">

<br>

<form name="frm_bien" method="post" action="" enctype="multipart/form-data">

<table width="99%" border="0" align="center" cellpadding="0"  cellspacing="3">
  <tr>
  <td height="40" colspan="3"><table width="95%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="6%" align="left"><div class="num2">&nbsp;</div></td>
      <td width="61%" align="left" class="txtgris">Informations structure / soci&eacute;t&eacute;</td>
      <td width="33%">&nbsp;</td>
    </tr>
  </table>
 <hr color="#CCCCCC" size="100%"/></td>
  </tr>
<tr>
  <td height="26" align="left" class="txt_anc"><b>Votre logo (210*210)</b></td>
  <td width="67%" height="26" colspan="2">  
  <div data-fileupload="image" class="fileupload fileupload-new">
														<input type="hidden" />
														<div style="width: 200px; height: 150px;" class="fileupload-new thumbnail"><img src="<?php echo '../../'.$fichier_logo; ?>" /></div>
														<div style="width: 200px; height: 150px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
														<span class="btn btn-file"><span class="fileupload-new">Choisir image</span><span class="fileupload-exists">Modifier</span><input type="file" id="fileinput" name="logo" required/></span>
														<a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Supprimer</a>
													</div>
  </td>
</tr>
<tr>
  <td width="27%" height="24" align="left" class="txt_anc"><b>Sigle</b></td>
  <td colspan="2">
    <input type="text" name="sigle" class="champ_zonea"  id="sigle" accesskey="t" tabindex="1" value="<?php echo $_POST['sigle'];?>"  autocomplete="off" required/>&nbsp;<span id="loginbox"></span>
    </td>
</tr>
  <tr>
    <td height="24" align="left" class="txt_anc"><b>Entreprise</b></td>
    <td colspan="2"><input type="text" name="denomi" class="champ_zoneb"  value="<?php echo $_POST['denomi'];?>" autocomplete="off"/></td>
  </tr>
  <tr>
    <td height="30" align="left"  class="txt_anc"><b>Tel 1</b></td>
    <td height="30" colspan="2" align="left" class="txt_anc"><input type="text" name="tel" class="champ_zonea"  value="+225" autocomplete="off"/>
      </td>
    </tr>  
  <tr>
    <td height="30" align="left"  class="txt_anc"><b>Tel 2</b></td>
    <td height="30" colspan="2" align="left" class="txt_anc">
<input type="text" name="tel2" class="champ_zonea"  value="+225" autocomplete="off"/></td>
    </tr>  
      <tr>
    <td height="40" align="left"  class="txt_anc"><b>Cel 1</b></td>
    <td colspan="2" align="left" class="txt_anc"><input type="text" name="cel" class="champ_zonea"  value="+225" autocomplete="off"/>
    </tr>
  <tr>
    <td height="40" align="left" class="txt_anc"><b>Fax</b></td>
    <td colspan="2"><input type="text" name="fax" class="champ_zoneb"  value="+225" autocomplete="off"/></td>
  </tr> 
<tr>
    <td height="24" align="left" class="txt_anc"><b>Certification</b></td>
    <td colspan="2"><textarea name="certif" cols="40" rows="8" class="textarea_insertb" ><?php echo $_POST['certif'];?></textarea></td>
  </tr>
  <tr>
    <td height="24" align="left" class="txt_anc"><b>Marque</b></td>
    <td colspan="2"><textarea name="marque" cols="40" rows="8" class="textarea_insertb" ><?php echo $_POST['marque'];?></textarea></td>
  </tr>
  <tr>
    <td height="24" align="left" class="txt_anc"><b>Membres</b> </td>
    <td colspan="2"><textarea name="membre" cols="40" rows="8" class="textarea_insertb" ><?php echo $_POST['dirigeant2'];?></textarea></td>    
  </tr>
  <tr>
    <td height="24" align="left" class="txt_anc"><b>E-mail</b></td>
    <td colspan="2"><input type="email" name="email" class="champ_zoneb"  value="<?php echo $_POST['email'];?>" autocomplete="off"/></td>
  </tr>
  <tr>
    <td height="24" align="left" class="txt_anc"><b>Site internet</b></td>
    <td colspan="2"><input type="text" name="site" class="champ_zoneb"  value="http://" autocomplete="off"/></td>
  </tr>       
    <tr>
    <td height="24" align="left" class="txt_anc"><b>Boite postale</b></td>
    <td colspan="2"><input type="text" name="bp" size="60" value="<?php echo $_POST['bp'];?>" class="champ_zoneb"/></td>
  </tr>
  <tr>
    <td height="24" align="left" class="txt_anc"><b>Situation g&eacute;ographique</b></td>
    <td colspan="2"><textarea name="adr_geo" id="editor1" cols="40" rows="8" class="textarea_insertb" ><?php echo $_POST['adr_geo'];?></textarea></td>
  </tr>
  
 <!-- <tr>
   <td height="24" class="txt_anc">&nbsp;Marque </td>
    <td><input type="text" name="marque" class="champ_zoneb" placeholder="Votre marque" value="<?php //echo $_POST['marque'];?>" autocomplete="off"/></td> 
  </tr>-->
  <tr>
   <td width="27%" height="45" align="left" class="txt_anc"><b>Activit&eacute;s</b></td>
    <td colspan="2"><textarea name="activite" id="editor2" cols="40" rows="8" class="textarea_insertb" ><?php echo $_POST['activite'];?></textarea></td> 
  </tr>
  <tr valign="baseline" height="45" class="txt_anc">
				  <td align="left" valign="middle" nowrap="nowrap"><b>Lien vidéo</b></td>
				  <td><input type="text" name="lien_video" size="100%" class="champ_zoneb" autocomplete="off"/>
				</tr>
				<tr valign="baseline">
				  <td><b>Etat video</b> </td>
				  <td><div align="left" valign="middle" nowrap="nowrap">
								<span class="important">Actif</span>
								<input type="radio" name="etat_video" id="radio1" value="1" class="champ_zoneb">
								<span class="important">Inactif</span>
								<input type="radio" name="etat_video" id="radio2" value="0" checked class="champ_zoneb">
								
							</div></td>
				</tr>
</table>

<table width="99%" border="0" align="center" cellpadding="0"  cellspacing="3">

    <td width="29%" height="24" align="left" class="txt_anc"><b>Catégorie</b></td>
    <td width="71%"><select name="rubrique" id="rubrique" data-placeholder="Choisir une catégorie" class="select_contrat">
<option value="vide">- Choisissez une catégorie -</option>
<?php
// Appel des regions
$req = "SELECT Id, rubrique FROM rubrique ORDER BY rubrique ASC";
$rep = mysql_query($req)or die (mysql_error());

while ($row = mysql_fetch_array($rep)) {
	echo "<option value=".$row['Id'].">".$row['rubrique']."</option>";
} 
@mysql_free_result($req);
?>
</select></td>
  </tr>
  <tr>
    <td height="24" align="left" class="txt_anc"><b>Rubrique </b></td>
    <td id="blocDepartements"><select name="sous_rubrique" id="sous_rubrique" data-placeholder="Choisir une rubrique" class="select_contrat_">
<option value="vide">- Choisissez une rubrique -</option>

<?php
// Appel des regions
$req = "SELECT * FROM sous_rubrique ORDER BY rubrique ASC";
$rep = mysql_query($req);
while ($row = mysql_fetch_array($rep)) {
	echo "<option value=".$row['Id']." class=".$row['Id_rubrique'].">".$row['rubrique']."</option>";
} 
@mysql_free_result($req);
?>
</select>
    </td>
  </tr>
    <tr>
    <td height="36" colspan="3" align="center" class="txt_anc_"><div>
      <input type="submit" name="valider" class="valider" value="Valider" />
    </div></td>
    </tr>
  </table>

</form>
</div>

<!-- END PAGE CONTENT -->
<script type="text/javascript">$(function(){
    $("#sous_rubrique").chained("#rubrique");
	/*$("#article").chained("#produit");
	$("#ssarticle").chained("#article");
	$("#element").chained("#ssarticle");*/
});
</script>
<script type="text/javascript" src="../js/ajax.js"></script>
<script>
       // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor1' );
	  CKEDITOR.replace( 'editor2' );  
</script>