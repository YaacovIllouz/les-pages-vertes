<?php
### DEBUT GENERATION DE KEY TRANSFERT
function code_key_2(){
		$taille =12 ;
		$lettres = "1G345E7F90ABCHIJKML";
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
### FIN GENERATION DE KEY TRANSFERT

$table="rubrique";
$rubrique=htmlspecialchars(addslashes($_POST['rubrique']));
$couleur=htmlspecialchars(addslashes($_POST['couleur']));

if($_POST['valider']){
	
	if(($rubrique!="")&&($couleur!=""))
	{
	
		//On verifie l'existance du Type de contrat qu'on essai de creer	
		$check_rub = @mysql_query("SELECT * FROM rubrique WHERE rubrique='".$lib."'");	
		//$rows = oci_fetch($AGENT);
		$cpt_rub = @mysql_num_rows($check_rub);
	
	if($cpt_rub==0)//S'il n'existe pas on le crée
		{	
		//Ajout d'un type de contrat dans la table tcontrat
		$sql_Adrub="INSERT INTO $table
			VALUES ('', '".$rubrique."', '".$couleur."')";
//echo $sql_Adrub;
$resajout=mysql_query($sql_Adrub);

$msge='<font class="confirm">RUBRIQUE CREEE AVEC SUCCES</font>';
		}
		else //Sinon on affiche un message pour prévenir qu'il existe dejà
		{$msge='<font class="refuse">CETTE RUBRIQUE EXISTE DEJA</font>';}
}
else {$msge='<font class="refuse">VEUILLEZ RENSEIGNER CORRECTEMENT LES CHAMPS</font>';}
//On se déconnecte du serveur
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<!-- Initialisation de la fonction -->
<!-- chargement des scripts -->	
<script src="js/scr/jquery.js" type="text/javascript"></script>
<script src="js/scr/jquery.validate.js" type="text/javascript"></script>
<!-- Initialisation de la fonction -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body>
<!-- Emplacement du formulaire -->		
<div id="main" align="center">
<table width="100%" border="0">
  <tr>
    <td width="25%" height="31"><div class="txt_saisie"><h3 class="ombre2">CREATION RUBRIQUE</h3></div></td>
    <td width="52%" align="right"><div <?php if($msge!="RUBRIQUE CREEE AVEC SUCCES"){echo "id='bl' style='visibility: visible' class='txt_confirm'";}else{echo "class='txt_confirm3'";}?> align="center" ><?php if($msge) echo $msge; ?></div></td>
    <td width="23%" align="right"><div>&nbsp;[<a href="accueil.php?page=?.liste_rub" class="ajout">Liste des rubriques </a>]</div></td>
  </tr>
  <tr>
    <td colspan="3" align="left"></td>
  </tr>
  <tr>
    <td colspan="3"><form name="form_user" class="" id="signupForm" method="post" action="">
		<fieldset>
			<legend class="txt_rs2_bis">INFORMATION RUBRIQUE</legend>
            <div>
            <div>
    <table width="85%" border="0" class="txt_rs2">
  <tr>
    <td width="24%" height="35" align="right"><label for="tdmde" class="obl">Libell&eacute; : &nbsp;</label></td>
    <td width="46%" align="left"><input id="lib" name="rubrique" size="30" required="required" value="<?php echo $_POST['rubrique'];?>"/><span class="rouge"> (*)</span></td>
    
  </tr>
  <tr>
    <td height="35" align="right"><label for="tdmde" class="obl">Description : &nbsp;</label></td>
    <td align="left">
    				
            <input type="color" name="couleur" value="<?php echo $resu_findrub['color']; ?>"><span class="rouge"> (*)</span> 
    </td>
    
  </tr>
  <tr>
    <td class="txt_norm2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="txt_norm2">&nbsp;</td>
    <td colspan="4"><input name="valider" class="valider" type="submit" value="Valider"/><span class="rouge"> (*) champs obligatoires</span></td>
  </tr>

    </table>
            </div>
		</fieldset>
	</form></td>
  </tr>
</table>

	
</div>


</body>
</html>