<?php
$id=$_GET['com'];
//echo $secure_code;
#### identification du user à modifier
$exe_findrub=mysql_query("SELECT * FROM sous_rubrique WHERE Id='".$id."' LIMIT 1;");
$resu_findrub=mysql_fetch_array($exe_findrub);
#### fin identification

#### identification de la pub2 à modifier
$exe_findpub=mysql_query("SELECT * FROM pub2 WHERE Id_sr='".$id."' LIMIT 1;");
$resu_findpub=mysql_fetch_array($exe_findpub);
$fichier_actuel = $resu_findpub['images'];
#### fin identification

$table="rubrique";

//echo $user_pwd;

$Liste_rubrique=mysql_query("SELECT * FROM $table ORDER BY rubrique ASC");

include 'upload1.php';

$fichier_logo = 'userfiles/image/'.$nomlogo;

if($_POST['modifier']){
	
		if(($fichier!="")&&($ok1==1)){
		$chemin_fichier = $fichier_logo;
		@unlink('../../'.$fichier_actuel);
		} else {$chemin_fichier = $fichier_actuel;}
	
$rubrique=addslashes($_POST['rubrique']);
$sous_rubrique=addslashes($_POST['sous_rubrique']);
$date_crea_pub = time();

$sql_Modifrub="UPDATE sous_rubrique SET rubrique='".$sous_rubrique."', Id_rubrique ='".$rubrique."' WHERE Id='".$id."'";
//echo $sql_Modifrub;
$resedit=mysql_query($sql_Modifrub);

//VERIFIONS VOIR SI LA PUB EXISTE SI OUI ON MET A JOUR SINON ON CREE LA PUB

$sql_checkpub = "SELECT * FROM pub2 WHERE Id_sr = '".$id."' ";
$exe_checkpub=mysql_query($sql_checkpub);
$nbre_check = mysql_num_rows($exe_checkpub);

if($nbre_check >=1){

$sql_Modipub="UPDATE pub2 SET images='".$chemin_fichier."' WHERE Id_sr='".$id."'";
//echo '<br>requete update : '.$sql_Modipub;
$exe_Modipub=mysql_query($sql_Modipub);

} else {
	$insertion = "INSERT INTO pub2 VALUES
('', 
 '".$chemin_fichier."',
 '".$date_crea_pub."', 
 '".$resu_findrub['Id']."'
 )";
 
 //echo '<br>requete insertion : '.$insertion;
 $exe_Modipub=mysql_query($insertion);
	}

if($resedit && $exe_Modipub){
//$redir="MODIFICATION EFFECTUEE AVEC SUCCES";
$redir='<font class="confirm">MODIFICATION REUSSIE !!</font>
				<meta http-equiv="refresh" content="3; url=accueil.php?page=?.liste_srub" />
		'; }
}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body>
<!-- Emplacement du formulaire -->		

<div id="container">
<div id="page-heading">
  <div>
   <table width="100%" border="0">
  <tr>
    <td width="46%" align="left"><h3 class="ombre2">MODIFICATION SOUS-RUBRIQUE</h3></td>
    <td width="20%" align="left"><div><strong><?php if($redir) {echo $redir;} ?></strong></div></td>
    <td width="34%"><div align="right">[<a href="accueil.php?page=?.liste_srub" class="ajout">Liste des sous-rubriques </a>]</div></td>
  </tr>
</table>
  </div> 
</div>

<table width="100%" border="0">
    <tr>
    <td></td>
  </tr>
  <tr>
    <td height="55">
      <form name="form_user" class="" id="signupForm" method="post" action="" enctype="multipart/form-data">
        <fieldset>
          <legend class="legend">INFORMATIONS</legend><br />
          <table width="100%" border="0">
          <tr>
    <td width="24%" height="35" align="right"><label for="tcontrat" class="obl">Rubrique : </label></td>
    <td align="left">
    <div class="row-fluid">
    <div class="span6">					
<select name="rubrique" id="rubrique" data-placeholder="Choisir une rubrique" class="select_contrat" style="width:310px" >                     
    <option value="" selected></option>
    <?php
    while($data_categ=mysql_fetch_object($Liste_rubrique)){                              
    ?>
    <option value="<?php echo $data_categ->Id;?>" <?php  if($resu_findrub['Id_rubrique']==$data_categ->Id) { echo "selected";}?> class="liste"><?php echo $data_categ->rubrique;?></option>
    <?php }mysql_free_result($Liste_categ);?>

</select>
	</div>
    </div>
    </td>
  </tr>
  <tr>
    <td height="35" align="right"><label for="tdmde" class="obl">Sous-rubrique : </label></td>
    <td align="left"><input name="sous_rubrique" size="30" required="required" value="<?php echo $resu_findrub['rubrique'];?>" class="champ_zoneb" style="width:300px" autocomplete="off"/></td>
    
  </tr>
  <tr>
    <td height="35" align="right"><label for="tdmde" class="obl">Pub (gauche:263x948) : </label></td>
    <td align="left">
    <div data-fileupload="image" class="fileupload fileupload-new">
        <input type="hidden" />
        <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail"><img src="<?php echo '../../'.$resu_findpub['images']; ?>" /></div>
        <div style="width: 200px; height: 150px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
        <span class="btn btn-file"><span class="fileupload-new">Choisir image</span><span class="fileupload-exists">Modifier</span><input type="file" id="fileinput" name="logo"/></span>
        <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Supprimer</a>
	</div>
    </td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="txt_info">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><input class="valider" type="submit" value="Modifier" name="modifier" /></td>
    <td class="txt_info">* Les champs en gras sont obligatoires</td>
  </tr>
</table>
<br />
             
          </fieldset>
        </form>    
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<div class="clear">&nbsp;</div>

</div>


</body>
</html>