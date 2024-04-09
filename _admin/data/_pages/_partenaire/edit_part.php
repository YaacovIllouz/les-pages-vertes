<?php

$id=$_GET['com'];
//echo $secure_code;
#### identification du user à modifier
$exe_findpart=mysql_query("SELECT * FROM partenaire WHERE id_part='".$id."' LIMIT 1;");
$resu_findpart=mysql_fetch_array($exe_findpart);


$query_cat_data = "SELECT * from categorie WHERE flag_categ = 1 ORDER BY libelle ASC";
//echo $query_cat_data;
$exe_findcat = mysql_query($query_cat_data) or die('MySql Error' . mysql_error());



$nom = addslashes($_POST['nom']);
$nom = preg_replace("#[.;:'&\"]+#", " ", $nom);
$desc = addslashes($_POST['desc']);
$site = addslashes($_POST['site']);
$categ = addslashes($_POST['categ']);
$date_crea=date('Y-m-d H:s:i');
$date_crea=date('Y-m-d H:s:i',strtotime($date_crea));
$login_user = $_SESSION['login_user'];
$flag_part = 1;

$logo_act=$resu_findpart['logo_part'];

include 'upload1.php';

if($_POST['valider'])
{
	if($fichier!=""){$nomlogo=$nomlogo;} else {$nomlogo=$logo_act;}

$modif = "UPDATE partenaire SET nom_part='".$nom."', desc_part='".$desc."', id_categ='".$categ."', site_web='".$site."', logo_part='".$nomlogo."' WHERE id_part='".$id."' ";

	//echo $modif;
	
	$exe_modif = mysql_query($modif);
	
	if($exe_modif)
	{		
		$msge = '<font class="confirm">&nbsp; MODIFICATION EFFECTUEE AVEC SUCCES</font>';
		if($fichier!=""){@unlink('../../logo/'.$logo_act);}
		
		$msge.='<meta http-equiv=refresh content="3; url=?page=?.liste_part">';
		
		}
	else
	 {
		 $msge = '<font class="refuse"> IMPOSSIBLE DE MODIFIER CE PARTENAIRE</font>';
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
  MODIFICATION D'UN PARTENAIRE
</h3></td>
    <td width="25%" align="center"><?php echo $msge.' '.$erreur;?></td>
    <td width="33%" align="right"><a href="accueil.php?page=?.liste_part" class="ajout">[Liste des partenaires]</a></td>
  </tr>
</table>
<form name="frm_bien" method="post" action="" enctype="multipart/form-data">
<fieldset class="fieldset_1">
<legend class="info_zone">Informations de base</legend>
<table width="85%" border="0" align="center"  cellspacing="8"> 
<tr>
    <td width="12%" height="55" class="font_tab">&nbsp;Nom : </td>
    <td width="44%">
    <input type="text" name="nom" class="champ_zoneb" placeholder="Nom partenaire" id="sigle" accesskey="t" tabindex="1" value="<?php echo $resu_findpart['nom_part'];?>"  maxlength="25" onKeyUp="verifsigle(this.value)" required autofocus/><span class="rouge"> (*)</span>
    </td>
    <td width="44%" align="right"><img src="../../logo/<?php echo $resu_findpart['logo_part'];?>" width="100" height="95"></td>
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;Description :</td>
    <td colspan="2"><textarea name="desc" class="large_txt" placeholder="Description du partenaire" cols="100" rows="6"><?php echo $resu_findpart['desc_part'];?></textarea><span class="rouge"> (*)</span></td> 
  </tr>
  <tr>
    <td width="12%" height="35" align="left"><label for="tcontrat" class="obl">Cat&eacute;gorie : </label></td>
    <td colspan="2" align="left">
    <div class="row-fluid">
    <div class="span6">					
<select name="categ" id="categ" data-placeholder="Choisir une cat&eacute;gorie" class="select_contrat" style="width:300px">                     
    <option value="" selected></option>
    <?php
    while($data_categ=mysql_fetch_object($exe_findcat)){                              
    ?>
    <option value="<?php echo $data_categ->id;?>" <?php  if($resu_findpart['id_categ']==$data_categ->id) { echo "selected";}?> class="liste"><?php echo $data_categ->libelle;?></option>
    <?php }mysql_free_result($Liste_categ);?>

</select>
	</div>
    </div>
    </td>
  <tr>
    <td height="35" align="left">Site web</td>
    <td colspan="2" align="left"><input type="text" name="site" class="champ_zoneb" placeholder="http://www.votresite.ext" value="<?php if($resu_findpart['site_web']) {echo $resu_findpart['site_web'];} else {echo "http://";}?>"/></td>
  <tr>
    <td height="45" class="font_tab">&nbsp;Votre logo (100x95)</td>
    <td colspan="2"><input type="file" name="logo"></td>
  </tr>
  <tr>
    <td height="21" class="font_tab">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;</td>
    <td colspan="2"><div>
      <input type="submit" name="valider" class="valider" value="Valider" />
    </div></td>
  </tr>
</table>
</fieldset>
<br>
</form>
</div>
</body>