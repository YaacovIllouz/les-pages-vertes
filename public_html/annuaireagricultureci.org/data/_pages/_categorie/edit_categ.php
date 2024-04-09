<?php
//include("_sql/1.php");

$secure_code=$_GET['com'];
//echo $secure_code;
#### identification du user à modifier
$exe_findcateg=mysql_query("SELECT * FROM categorie WHERE secure_code='".$secure_code."' LIMIT 1;");
$resu_findcateg=mysql_fetch_row($exe_findcateg);
#### fin identification


$table="categorie";

//echo $user_pwd;

$check_req=mysql_query("SELECT * FROM categorie WHERE secure_code='".$secure_code."' LIMIT 1;");
$nbre=mysql_num_rows($check_req);

if(($_POST['modifier'])&&($_POST['lib'])&&($_POST['desc'])){
	
$libelle=addslashes(strtoupper($_POST['lib']));
$desc_categ=addslashes($_POST['desc']);
$user_ctt=addslashes($_POST['contact']);
$flag_categ=$_POST['flag_categ'];

$sql_Modifcateg="UPDATE $table SET libelle='".$libelle."', desc_categ='".$desc_categ."', flag_categ='".$flag_categ."' WHERE secure_code='".$secure_code."'";
//echo $sql_Aduser;
$resedit=mysql_query($sql_Modifcateg);
//$msge="MODIFICATION EFFECTUEE AVEC SUCCES";
$redir='<font class="confirm">MODIFICATION REUSSIE !!</font>
				<meta http-equiv="refresh" content="2; url=accueil.php?page=?.liste_categ" />
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
    <td width="40%" align="left"><h3 class="titre_page">MODIFICATION CATEGORIE</h3></td>
    <td width="35%" align="center"><?php echo $redir; ?></td>
    <td width="25%"><div align="right"><a href="accueil.php?page=?.liste_categ" class="ajout">[Liste des cat&eacute;gories]</a></div></td>
  </tr>
</table>
  </div> 
</div>

<table width="100%" border="0">
    <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="55">
      <form name="form_user" class="" id="signupForm" method="post" action="">
        <fieldset>
          <legend class="legend">INFORMATION CATEGORIE</legend><br />
          <table width="100%" border="0">
  <tr>
    <td height="35" align="right"><label for="login" class="obl">Libell&eacute; : </label></td>
    <td align="left">
    <input id="lib" name="lib" style="width:300px"autocomplete="off" required="required" placeholder="Libellé de la catégorie" value="<?php echo $resu_findcateg[1];?>"/><span class="rouge"> (*)</span>
    
  </tr>
  <tr>
    <td width="38%" height="35" align="right"><label for="nom" class="obl">Description : </label></td>
    <td width="62%" align="left">
    <textarea id="desc" name="desc" autocomplete="off" required="required" placeholder="Description de la catégorie" style="width:300px; height:100px"><?php echo $resu_findcateg[2];?></textarea><span class="rouge"> (*)</span>
</td>
  </tr>
  <tr>
    <td height="35" align="right" class="txt_norm2"><div align="right" class="obl">Actif ? : </div></td>
    <td align="left"><div align="left"><span class="txt_v">&nbsp;Oui </span>
      <input name="flag_categ" type="radio" id="radio" value="1" <?php if($resu_findcateg[5]==1){echo 'checked="checked"';};?>>
      <span class="important">Non</span>
      <input type="radio" name="flag_categ" id="radio2" value="0" <?php if($resu_findcateg[5]==0){echo 'checked="checked"';};?>>
      <label for="flag_categ"> </label>
      </div>
      </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="txt_info">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left" class="txt_info"><span class="rouge"> 
      <input class="valider" type="submit" value="Modifier" name="modifier" />
      (*) Champs obligatoires</span></td>
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