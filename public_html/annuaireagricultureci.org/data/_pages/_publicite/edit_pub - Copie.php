<?php

$id=$_GET['com'];
//-------------- -------------------//
$rqt1="SELECT * from pub WHERE id_pub = '".$id."' ";
$result1 = mysql_query($rqt1);
$result=mysql_fetch_array($result1);
//--------------- -----------------//

$lib_pub = addslashes($_POST['lib_pub']);
$empl_pub = addslashes($_POST['empl']);
$ddpub = $result['date_deb_pub'];
$dfpub = $result['date_fin_crea'];

$date_deb_pub=date('Y-m-d', strtotime($_POST['date_deb_pub']));
$date_fin_crea=date('Y-m-d', strtotime($_POST['date_fin_crea']));
$login_user = $_SESSION['login_user'];
$flag_default = $_POST['flag_default'];


$logo_act=$result['img_pub'];


if($_POST['valider'])
{
	//echo $date_fin_crea;
	
	if($empl_pub=="HAUT") {include '../../upload_pub.php';}
	else if($empl_pub=="GAUCHE") {include '../../upload_pubgche.php';}
	else if($empl_pub=="DROITE") {include '../../upload_pubcorps.php';}
	
	if($fichier!=""){$nomlogo=$nomlogo;} else {$nomlogo=$logo_act;}
	 
	 if($date_deb_pub=="1970-01-01") {$date_deb_pub=$ddpub;}
	 if($date_fin_crea=="1970-01-01") {$date_fin_crea=$dfpub;}

$modif = "UPDATE pub SET lib_pub='".$lib_pub."', emplct_pub='".$empl_pub."', date_deb_pub='".$date_deb_pub."', date_fin_crea='".$date_fin_crea."', img_pub='".$nomlogo."' WHERE id_pub='".$id."' ";
	
//echo $modif;
	
	$exe_modif = mysql_query($modif);
	
	if($exe_modif)
	{		
		$msge = '<font class="confirm">&nbsp; MODIFICATION REUSSIE</font>';
		if($empl_pub=="HAUT"){
		$msge.='<meta http-equiv=refresh content="2; url=?page=?.liste_pubhaut">';}
		
		if($empl_pub=="GAUCHE"){
		$msge.='<meta http-equiv=refresh content="2; url=?page=?.liste_pubgche">';}
		
		if($empl_pub=="DROITE"){
		$msge.='<meta http-equiv=refresh content="2; url=?page=?.liste_pubrech">';}
		
		}
	else
	 {
		 $msge = '<font class="refuse"> MODIFICATION IMPOSSIBLE</font>';
		 }
	/*}
	else $msge = '<font class="refuse"> FORMAT D\'IMAGE NON AUTORISE('.$extension.')</font>';*/
}
?>

<head>

<script language="javascript">
function choix(chaine)
{

var a = document.getElementById("lib_img1");
var b = document.getElementById("lib_img2");
var c = document.getElementById("lib_img3");
var d = document.getElementById("fileinput");

		a.style.display = "none";
		b.style.display = "none";
		c.style.display = "none";
		d.style.display = "none";
 
	if (chaine == 'haut'){
		a.style.display = "block";		
		b.style.display = "none";
		c.style.display = "none";
		d.style.display ="block";
		return false;
	
	/*a.style.display = "none";
	b.style.display = "none";*/
	}
	
	if (chaine == 'gauche'){			
		a.style.display = "none";
		b.style.display = "block";
		c.style.display = "none";
		d.style.display = "block";
		return false;
	}
	
		if (chaine == 'droite'){				
		a.style.display = "none";
		b.style.display = "none";
		c.style.display = "block";
		d.style.display = "block";
		return false;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<div class="div_princ_ref">
<table width="100%" border="0">
  <tr>
    <td width="50%" align="left"><h3 class="titre_page">
  MODIFICATION D'UNE AFFICHE PUBLICITAIRE
</h3></td>
    <td width="18%" align="center"><?php echo $msge.' '.$erreur;?></td>
    <td width="32%" align="right"><a href="accueil.php?page=?.<?php if($result['emplct_pub']=="GAUCHE") {echo "liste_pubgche";} elseif($result['emplct_pub']=="HAUT") {echo "liste_pubhaut";} else {echo "liste_pubrech";}?>" class="ajout">[Liste des affiches publicitaires]</a></td>
  </tr>
</table>
<form name="frm_pub" method="post" action="" enctype="multipart/form-data">
<fieldset class="fieldset_1">
<legend class="info_zone">Informations de base</legend>
<table width="60%" border="0" align="center"  cellspacing="8">
  <tr>
    <td height="45" class="font_tab obl">&nbsp;Libell&eacute; :</td>
    <td width="32%"><input type="text" name="lib_pub" required class="large_txt" placeholder="Lebell&eacute; de l'image" value="<?php echo $result['lib_pub'];?>"></td>
    <td width="32%">&nbsp;</td> 
  </tr>
  <tr>
    <td width="36%" height="35" align="left"><label for="tcontrat" class="obl">Emplacement : </label></td>
    <td align="left"><div align="left"><span>Haut </span>
      <input name="empl" type="radio" id="radio" value="HAUT" onChange="choix('haut')" <?php if(($_POST['empl']=="HAUT")||($result['emplct_pub']=="HAUT")) echo 'checked';?>>
      <span>&nbsp;&nbsp;Gauche </span>
      <input type="radio" name="empl" id="radio2" value="GAUCHE" onChange="choix('gauche')" <?php if(($_POST['empl']=="GAUCHE")||($result['emplct_pub']=="GAUCHE")) echo 'checked';?>>
		<span>&nbsp;&nbsp;Droite </span>
      <input type="radio" name="empl" id="radio3" value="CORPS" onChange="choix('droite')" <?php if(($_POST['empl']=="DROITE")||($result['emplct_pub']=="DROITE")) echo 'checked';?>>
      </div></td>
    <td rowspan="3" align="left">&nbsp;</td>
  <tr>
    <td height="35" align="left" class="obl">Date d&eacute;but pub :</td>
    <td align="left">
      <div class="input-append date" id="dp_start">
        <input class="span6" type="text"  readonly name="date_deb_pub" value="<?php if($result['date_deb_pub']!="1970-01-01 00:00:00") {echo date("d/m/Y",strtotime($result['date_deb_pub']));}?>" /><span class="add-on"><i class="splashy-calendar_day_up"></i></span>
        </div>
</td>
    <tr>
    <td height="35" align="left" class="obl">Date fin pub :</td>
    <td align="left">
      <div class="input-append date" id="dp_end">
        <input class="span6" type="text" readonly  name="date_fin_crea" value="<?php if($result['date_fin_crea']!="1970-01-01 00:00:00") {echo date("d/m/Y",strtotime($result['date_fin_crea']));}?>"/><span class="add-on"><i class="splashy-calendar_day_down"></i></span>
</div></td>
    <tr>
    <td class="obl" height="21" align="left">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
        </tr>
    <td height="45" class="font_tab obl"><div id="lib_img1" class="<?php if($result['emplct_pub']!="HAUT") echo "masquer"; ?>">Votre pub (930x300)</div><div id="lib_img2" class="<?php if($result['emplct_pub']!="GAUCHE") echo "masquer"; ?>">Votre pub (largeur:220)</div><div id="lib_img3" class="<?php if($result['emplct_pub']!="CORPS") echo "masquer"; ?>">Votre pub (largeur:220)</div></td>
    <td colspan="2">
    <!-- DEBUT -->
   
												
													<div data-fileupload="image" class="fileupload fileupload-new">
														<input type="hidden" />
														<div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
<?php if($result['emplct_pub']=="HAUT"){?>
<img src="../../_affiches/pub_haut/<?php echo $result['img_pub'];?>"><?php }?>

<?php if($result['emplct_pub']=="GAUCHE"){?>
<img src="../../_affiches/pub_gauche/<?php echo $result['img_pub'];?>"><?php }?>

<?php if($result['emplct_pub']=="DROITE"){?>
<img src="../../_affiches/pub_rech/<?php echo $result['img_pub'];?>"><?php }?>

</div>
														<div style="width: 200px; height: 150px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
														<span class="btn btn-file"><span class="fileupload-new">Choisir image</span><span class="fileupload-exists">Modifier</span><input type="file" id="fileinput" name="logo"/></span>
														<a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Supprimer</a>
													</div>	
												
											
    
    <!-- FIN -->
    </td>
  </tr>
  <tr>
    <td height="21" class="font_tab">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" class="font_tab">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
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