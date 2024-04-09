<?php
//include("_sql/1.php");

### DEBUT GENERATION DE KEY IMPORT CONTACT
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
### FIN GENERATION DE KEY IMPORT CONTACT

$table="categorie";
$lib_categ=addslashes(strtoupper($_POST['lib']));
$desc_categ=addslashes($_POST['desc']);
$user_crea=addslashes($_SESSION['login_user']);
$flag_crea=1;
$date_crea=date('Y-m-d H:i:s');
$secure_code=$key_alea;
//echo $user_pwd;

if(($_POST['valider'])&&($_POST['lib']!="")&&($_POST['desc']!="")){
	
$res_categ="SELECT * FROM categorie WHERE libelle='".$lib_categ."' ";
//echo $res_user;
$check_req=mysql_query($res_categ);
$nbre=mysql_num_rows($check_req);

if($nbre==0){

$sql_Adcateg="INSERT INTO $table
			VALUES ('', '".$lib_categ."', '".$desc_categ."', '".$date_crea."', '".$user_crea."', '".$flag_crea."', '".$secure_code."')";
//echo $sql_Adcateg;
$resajout=mysql_query($sql_Adcateg);

$msge="<font class=\"confirm\">CATEGORIE CREEE AVEC SUCCES</font>";
}

else{$msge="<font class=\"refuse\">LA CATEGORIE EXISTE DEJA</font>";}

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
<script type="text/javascript">

// les règles se fixent dans la partie "rules"
// exemple : password: {required: true,minlength: 5},
// 			password -> nom du champs
//			required=true -> obligatoire
//			minlength:5 -> la valeur saisie doit comporter 5 caractères au moins
// les messages associés se fixent dans la partie "messages"
	
$().ready(function() {
	$("#signupForm").validate({
		rules: {
			login: {required: true},
			nom: {required: true},
			prenom: {required: true},
			password: {required: true,minlength: 5},
			confirm_password: {required: true,minlength: 5,	equalTo: "#password"},
			email: {required: false, email: true	},
			agence: {required: true},
			profil: {required: true},
		},
		messages: {
			login: "Merci d'indiquer un nom utilisateur",
			nom: "Merci d'indiquer un nom",
			prenom: "Merci d'indiquer un prénom",
			agence: "Merci d'indiquer une agence",
			profil: "Merci d'indiquer un profil",
			password: {
				required: "Vous devez saisir un mot de passe",
				minlength: "5 caractères au moins"
			},
			confirm_password: {
				required: "Vous devez confirmer votre mot de passe",
				minlength: " 5 caractères au moins",
				equalTo: "Mot de passe et confirmation différents"
			},
			email: "adresse email invalide"
		}
	});
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<body>
<!-- Emplacement du formulaire -->		
<div id="main" align="center">
<table width="100%" border="0">
  <tr>
    <td width="25%" height="31" align="left"><h3 class="titre_page">CREATION CATEGORIE</h3></td>
    <td width="45%" align="left"><div align="center"><?php echo $msge; ?></div></td>
    <td width="30%" align="right"><div>&nbsp;<a href="accueil.php?page=?.liste_categ" class="ajout">[Liste des cat&eacute;gories]</a></div></td>
  </tr>
  <tr>
    <td colspan="3"><form name="form_user" class="" id="signupForm" method="post" action="">
		<fieldset>
			<legend class="txt_rs2_bis">INFORMATION CATEGORIE</legend>
		  <table width="100%" border="0" class="txt_rs2">
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td height="45" align="right"><label for="libelle" class="obl">Libell&eacute; : </label></td>
    <td align="left"><input id="lib" name="lib" style="width:300px"autocomplete="off" required="required" placeholder="Libellé de la catégorie" /><span class="rouge"> (*)</span></td>
  </tr>
  <tr>
    <td width="34%" height="45" align="right"><label for="nom" class="obl">Description : </label></td>
    <td width="66%" align="left"><textarea id="desc" name="desc" autocomplete="off" required="required" placeholder="Description de la catégorie" style="width:250px; height:100px"></textarea><span class="rouge"> (*)</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="txt_info">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left" class="txt_info"><input name="valider" class="valider" type="submit" value="Créer" />
     <span class="rouge">(*) champs obligatoires</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="txt_info"></td>
  </tr>
</table>
		</fieldset>
	</form></td>
  </tr>
</table>

	
</div>


</body>
</html>