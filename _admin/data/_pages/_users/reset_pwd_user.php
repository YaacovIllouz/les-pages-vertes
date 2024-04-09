<?php
#### Recuperation de l'agence du user 
$sql_user= "SELECT * FROM users WHERE actif_user = '1'";

#### fin recuperation

$exe_findU=mysql_query($sql_user);
$table="users";

//echo $user_pwd;

//$check_req=mysql_query("SELECT login_user FROM users WHERE login_user='".$user_login."' LIMIT 1;");
//$nbre=mysql_num_rows($check_req);

if(($_POST['modifier'])&&($_POST['login']!="")){
	
$user_login=$_POST['login'];
$user_pwd=md5("FredericouX21pv");

$sql_Modifuser="UPDATE $table SET pass_user='".$user_pwd."' WHERE login_user='".$user_login."'";
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
		},
		messages: {
			login: "Merci d'indiquer un nom utilisateur"
		}
	});
});
</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<body>
<!-- Emplacement du formulaire -->		
<div id="main" align="center">
<table width="650" border="0">
  <tr>
    <td height="31"><h3>REINITIALISATION MOT DE PASSE  UTILISATEUR</h3></td>
  </tr>
  <tr>
    <td><div class="txt_confirm3"><?php echo $redir; ?></div></td>
  </tr>
  <tr>
    <td><form name="form_user" class="" id="signupForm" method="post" action="">
		<fieldset>
			<legend class="txt_rs2_bis">Choisir un utilisateur
		  </legend><table width="100%" border="0" class="txt_rs2">
  <tr>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td width="38%" height="25" align="right"><label for="agence" class="obl">Utilisateur : </label></td>
    <td width="31%" align="left">   
      <select name="login" id="login" >                     
        <option value="">Selectionnez...</option>
        <?php
						while($Luser=mysql_fetch_object($exe_findU)){							
			  	  	  ?>
        <option value="<?php echo $Luser->login_user;?>" class="maj"><?php echo $Luser->nom_user.' '.$Luser->pren_user;?></option>
        <?php }mysql_free_result($exe_findU);?>
        
        </select></td>
    <td width="31%" align="left"><input class="valider" type="submit" value="Modifier" name="modifier" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" class="txt_info">&nbsp;</td>
  </tr>
  </table>
		</fieldset>
	</form></td>
  </tr>
</table>

	
</div>


</body>
</html>