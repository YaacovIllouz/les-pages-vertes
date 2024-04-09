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

$table="users";
$user_login=$_POST['login'];
$user_pwd=md5("pagesvertes2014");
$user_name=addslashes(strtoupper($_POST['nom']));
$user_prenom=addslashes(strtoupper($_POST['prenom']));
$user_email=$_POST['email'];
$user_ctt=addslashes($_POST['contact']);
$date_crea=date('Y-m-d H:i:s');
$actif=1;
$user_avatar="default.jpg";
$user_secure="";
$secure_code=$key_alea;
$user_con="";
$user_decon="";

//echo $user_pwd;

if($user_login!=""){
$res_user="SELECT * FROM users WHERE login_user='".$user_login."' ";
echo $res_user;
$check_req=mysql_query($res_user);
$nbre=mysql_num_rows($check_req);

if($nbre==0){

$sql_Aduser="INSERT INTO $table
			VALUES ('".$user_login."', '".$user_pwd."', '".$user_name."', '".$user_prenom."', '".$date_crea."', '".$user_con."', '".$user_decon."', '".$actif."', '".$user_avatar."', '".$user_email."', '".$secure_code."', '".$user_ctt."', '0')";
//echo $sql_Aduser;
$resajout=mysql_query($sql_Aduser);

$msge="UTILISATEUR CREE AVEC SUCCES";
}

else{$msge="L'UTILISATEUR EXISTE DEJA";}

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
    <td width="51%" height="31"><div class="txt_saisie"><h3 class="ombre2">CREATION ADMINISTRATEUR</h3></div></td>
    <td width="49%" align="right"><div><a href="accueil.php?page=?.liste_user" class="ajout">[Liste utilisateur]</a></div></td>
  </tr>
  <tr>
    <td colspan="2" align="left"><div <?php if($msge!="UTILISATEUR CREE AVEC SUCCES"){echo "id='bl' style='visibility: visible' class='txt_confirm'";}else{echo "class='txt_confirm3'";}?> align="center" ><?php echo $msge; ?></div></td>
  </tr>
  <tr>
    <td colspan="2"><form name="form_user" class="" id="signupForm" method="post" action="">
		<fieldset>
			<legend class="txt_rs2_bis">INFORMATION UTILISATEUR</legend>
		  <table width="100%" border="0" class="txt_rs2">
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td height="45" align="right"><label for="login" class="obl">Nom utilisateur : </label></td>
    <td align="left"><input id="login" name="login" size="20" autocomplete="off" required="required" /></td>
  </tr>
  <tr>
    <td width="34%" height="45" align="right"><label for="nom" class="obl">Nom : </label></td>
    <td width="66%" align="left"><input id="nom" name="nom" size="20" autocomplete="off" required="required"/></td>
  </tr>
  <tr>
    <td align="right" height="45"><label for="prenom" class="obl">Pr&eacute;nom : </label></td>
    <td align="left"><input id="prenom" name="prenom" size="20" autocomplete="off" required="required"/></td>
  </tr>
  <tr>
    <td align="right" height="45"><label for="curl2" class=""> E-Mail : </label></td>
    <td align="left"><input id="cemail" type="email" name="email" size="20" autocomplete="off"/></td>
  </tr>
  <tr>
    <td align="right" height="45">Contact :</td>
    <td align="left"><input id="contact" name="contact" size="20" autocomplete="off"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="txt_info">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><input class="valider" type="submit" value="Créer" /></td>
    <td class="txt_info">* Les champs en gras sont obligatoires</td>
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