<?php
//include("_sql/1.php");

$secure_code=$_GET['com'];
//echo $secure_code;
#### identification du user à modifier
$exe_findU=mysql_query("SELECT * FROM users WHERE secure_code='".$secure_code."' LIMIT 1;");
$resu_findU=mysql_fetch_row($exe_findU);
#### fin identification


$table="users";

//echo $user_pwd;

$check_req=mysql_query("SELECT * FROM users WHERE login_user='".$user_login."' LIMIT 1;");
$nbre=mysql_num_rows($check_req);

if($_POST['modifier']){
	
$user_login=$_POST['login'];
$user_pwd=$resu_findU[1];
$user_name=addslashes(strtoupper($_POST['nom']));
$user_prenom=addslashes(strtoupper($_POST['prenom']));
$user_agence=$_POST['agence'];
$user_profil=$_POST['profil'];
$user_email=$_POST['email'];
$user_ctt=addslashes($_POST['contact']);
$actif=$_POST['actif_U'];

$sql_Modifuser="UPDATE $table SET nom_user='".$user_name."', pren_user='".$user_prenom."', actif_user='".$actif."', email_user='".$user_email."', contact='".$user_ctt."' WHERE secure_code='".$secure_code."'";
//echo $sql_Aduser;
$resedit=mysql_query($sql_Modifuser);
//$msge="MODIFICATION EFFECTUEE AVEC SUCCES";
$redir='<font class="important">MODIFICATION REUSSIE !!</font>
				<meta http-equiv="refresh" content="3; url=accueil.php?page=?.liste_user" />
		';
}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

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

<div id="container">
<div id="page-heading">
  <div>
   <table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><h3 class="ombre2">MODIFICATION UTILISATEUR</h3></td>
    <td><div align="right"><a href="accueil.php?page=?.liste_user" class="ajout">[Liste des utilisateurs]</a></div></td>
  </tr>
</table>
  </div> 
</div>

<table width="100%" border="0">
    <tr>
    <td><div align="center" <?php if($redir!="MODIFICATION REUSSIE"){echo "id='bl' style='visibility: visible' class='txt_confirm'";}else{echo "class='txt_confirm3'";}?> ><?php echo $redir; ?></div></td>
  </tr>
  <tr>
    <td height="55">
      <form name="form_user" class="" id="signupForm" method="post" action="">
        <fieldset>
          <legend class="legend">INFORMATION UTILISATEUR</legend><br />
          <table width="100%" border="0">
  <tr>
    <td height="35" align="right"><label for="login" class="obl">Login : </label></td>
    <td align="left"><input id="login" name="login" value="<?php echo $resu_findU[0];?>" size="25" autocomplete="off" readonly="readonly"/></td>
  </tr>
  <tr>
    <td width="38%" height="35" align="right"><label for="nom" class="obl">Nom : </label></td>
    <td width="62%" align="left"><input id="nom" name="nom" class="maj" value="<?php echo $resu_findU[2];?>" size="25" autocomplete="off"/></td>
  </tr>
  <tr>
    <td align="right" height="35"><label for="prenom" class="obl">Pr&eacute;nom : </label></td>
    <td align="left"><input id="prenom" name="prenom" class="maj" value="<?php echo $resu_findU[3];?>" size="25" autocomplete="off"/></td>
  </tr>
  <tr>
    <td height="35" class="txt_norm2"><div align="right" class="obl">Actif ? : </div></td>
    <td><div align="left"><span class="txt_v">Oui </span>
      <input name="actif_U" type="radio" id="radio" value="1" <?php if($resu_findU[7]==1){echo 'checked="checked"';};?>>
      <span class="important">Non</span>
      <input type="radio" name="actif_U" id="radio2" value="0" <?php if($resu_findU[7]==0){echo 'checked="checked"';};?>>
      <label for="actif_U"> </label>
      </div>
      </td>
  </tr>
  <tr>
    <td align="right" height="35"><label for="curl2" class="obl"> E-Mail : </label></td>
    <td align="left"><input id="cemail" type="email" name="email" value="<?php echo $resu_findU[9];?>" size="25" autocomplete="off"/></td>
  </tr>
  <tr>
    <td align="right" height="35" class="obl">Contact :</td>
    <td><input id="contact" name="contact" value="<?php echo $resu_findU[11];?>" size="25" autocomplete="off"/></td>
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