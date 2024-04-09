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

if($_POST['valider']){
	
		if(($fichier!="")&&($ok1==1)){
		$chemin_fichier = $fichier_logo;
		} else {$chemin_fichier = $fichier_actuel;}
	
$rubrique=addslashes($_POST['rubrique']);
$sous_rubrique=addslashes($_POST['sous_rubrique']);
$date_crea_pub = time();

//VERIFIONS VOIR SI LA SOUS RUBRIQUE EXISTE DEJA

$sql_checkpub = "SELECT * FROM sous_rubrique WHERE rubrique = '".$sous_rubrique."' AND Id_rubrique = '".$rubrique."' ";
//echo $sql_checkpub;
$exe_checkpub=mysql_query($sql_checkpub);
$nbre_check = mysql_num_rows($exe_checkpub);

if($nbre_check ==0){
$insertion_srubrique = "INSERT INTO sous_rubrique VALUES
('', 
 '".$sous_rubrique."',
 '".$rubrique."' 
 )";
//echo $insertion_srubrique;
$srub_add=mysql_query($insertion_srubrique);

if($srub_add){

$sql_lastsrub = "SELECT * FROM sous_rubrique ORDER BY Id DESC LIMIT 1; ";	
$srub_lastadd = mysql_query($sql_lastsrub);
$data_lastsrub = mysql_fetch_array($srub_lastadd);	
	
	$insertion_pub2 = "INSERT INTO pub2 VALUES
	('', 
	 '".$chemin_fichier."',
	 '".$date_crea_pub."', 
	 '".$data_lastsrub['Id']."'
	 )";
 //echo '<br>requete insertion : '.$insertion;
 $insert_pub = mysql_query($insertion_pub2);
	}

}
 else {
$redir='<font class="rouge">IMPOSSIBLE DE CREER CETTE SOUS-RUBRIQUE, ELLE EXISTE DEJA !!</font>
				<meta http-equiv="refresh" content="100; url=accueil.php?page=?.liste_srub" />
		';
	}
	
if($srub_add){
//$redir="MODIFICATION EFFECTUEE AVEC SUCCES";
$redir='<font class="confirm">SOUS-RUBRIQUE AJOUTEE AVEC SUCCES !!</font>
				<meta http-equiv="refresh" content="100; url=accueil.php?page=?.liste_srub" />
		';}
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
    <td width="32%" align="left"><h3 class="ombre2">AJOUT D'UNE SOUS-RUBRIQUE</h3></td>
    <td width="34%" align="left"><div><strong><?php if($redir) {echo $redir;} ?></strong></div></td>
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
<select name="rubrique" id="rubrique" data-placeholder="Choisir une rubrique" class="select_contrat" style="width:310px" required>                     
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
        <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail"></div>
        <div style="width: 200px; height: 150px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
        <span class="btn btn-file"><span class="fileupload-new">Choisir image</span><span class="fileupload-exists">Modifier</span><input type="file" id="fileinput" name="logo" /></span>
        <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Supprimer</a>
	</div>
    </td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="txt_info">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><input class="valider" type="submit" value="Valider" name="valider" /></td>
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