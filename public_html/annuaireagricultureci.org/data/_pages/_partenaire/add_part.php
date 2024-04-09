<?php


$nom = addslashes($_POST['nom']);
$nom = preg_replace("#[.;:'&\"]+#", " ", $nom);
$desc = addslashes($_POST['desc']);
$site = addslashes($_POST['site']);
$categ = addslashes($_POST['categ']);
$date_crea=date('Y-m-d H:s:i');
$date_crea=date('Y-m-d H:s:i',strtotime($date_crea));
$login_user = $_SESSION['login_user'];
$flag_part = 1;


include 'upload1.php';

if($_POST['valider'])
{
	if($fichier!=""){$nomlogo=$nomlogo;} else {$nomlogo="img_indispo.jpg";}
	$check_sigle="SELECT * FROM partenaire WHERE nom = '".$nom."'";
	
	$exe_check=mysql_query($check_sigle);
	$nbre=mysql_num_rows($exe_check);
	if($nbre==0){
	
	$insertion = "INSERT INTO partenaire VALUES
('', 
 '".$nom."',
 '".$desc."', 
 '".$nomlogo."',
 '".$date_crea."', 
 '".$categ."', 
 '".$login_user."',
 '".$flag_part."',
 '".$site."'
 )";
	
	//echo $insertion;
	
	$exe_insert = mysql_query($insertion);
	
	if($exe_insert)
	{		
		$msge = '<font class="confirm">&nbsp; PARTENAIRE ENREGISTRE AVEC SUCCES</font>';
		
		}
	else
	 {
		 $msge = '<font class="refuse"> IMPOSSIBLE D\'ENREGISTRER CE PARTENAIRE</font>';
		 }	
	
	}else
	 {
		 $msge = '<font class="refuse"> CE PARTENAIRE EXISTE DEJA</font>';
		 }

}
?>

<head>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<div class="div_princ_ref">
<table width="100%" border="0">
  <tr>
    <td width="42%" align="left"><h3 class="titre_page">
  AJOUT D'UN PARTENAIRE
</h3></td>
    <td width="25%" align="center"><?php echo $msge.' '.$erreur;?></td>
    <td width="33%" align="right"><a href="accueil.php?page=?.liste_part" class="ajout">[Liste des partenaires]</a></td>
  </tr>
</table>
<form name="frm_bien" method="post" action="" enctype="multipart/form-data">
<fieldset class="fieldset_1">
<legend class="info_zone">Informations de base</legend>
<table width="70%" border="0" align="center"  cellspacing="8"> 
<tr>
    <td width="36%" height="55" class="font_tab obl">&nbsp;Nom : </td>
    <td width="64%">
    <input type="text" name="nom" class="champ_zonec" placeholder="Nom partenaire" id="sigle" accesskey="t" tabindex="1" value=""  maxlength="25" onKeyUp="verifsigle(this.value)" required autofocus autocomplete="off"/><span class="rouge"> (*)</span>
    </td>
  </tr>
    
  <tr>
    <td height="35" align="left" class="obl">Site web</td>
    <td align="left"><input type="text" name="site" class="champ_zoneb" placeholder="http://www.votresite.ext" value="http://" autocomplete="off"/></td>
  <tr>
    <td height="45" class="font_tab obl">&nbsp;Votre logo (100x95)</td>
    <td><input type="file" name="logo"></td>
  </tr>
  <tr>
    <td height="21" class="font_tab">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;</td>
    <td><div>
      <input type="submit" name="valider" class="valider" value="Valider" /><span class="rouge"> (*) champs obligatoires</span>
    </div></td>
  </tr>
</table>
</fieldset>
<br>
</form>
</div>
</body>