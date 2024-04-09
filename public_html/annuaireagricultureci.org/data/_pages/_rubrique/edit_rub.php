<?php
//include("_sql/1.php");

$id=$_GET['com'];
//echo $secure_code;
#### identification du user à modifier
$exe_findrub=mysql_query("SELECT * FROM rubrique WHERE Id='".$id."' LIMIT 1;");
$resu_findrub=mysql_fetch_array($exe_findrub);
#### fin identification


$table="rubrique";

//echo $user_pwd;


if($_POST['modifier']){
	
$rubrique =addslashes($_POST['rubrique']);
$couleur =addslashes($_POST['couleur']);

$sql_Modifrub="UPDATE $table SET rubrique='".$rubrique."', color='".$couleur."' WHERE Id='".$id."'";
//echo $sql_Modifrub;
$resedit=mysql_query($sql_Modifrub);
//$msge="MODIFICATION EFFECTUEE AVEC SUCCES";
$redir='<font class="confirm">MODIFICATION REUSSIE !!</font>
				<meta http-equiv="refresh" content="2; url=accueil.php?page=?.liste_rub" />
		';
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
    <td width="46%" align="left"><h3 class="ombre2">MODIFICATION RUBRIQUE</h3></td>
    <td width="20%" align="left"><div><?php if($redir) {echo $redir;} ?></div></td>
    <td width="34%"><div align="right"><a href="accueil.php?page=?.liste_rub" class="ajout">[Liste des rubriques]</a></div></td>
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
      <form name="form_user" class="" id="signupForm" method="post" action="">
        <fieldset>
          <legend class="legend">INFORMATION RUBRIQUE</legend><br />
          <table width="100%" border="0">
  <tr>
    <td height="35" align="right"><label for="tdmde" class="obl">Libell&eacute; : &nbsp;</label></td>
    <td width="46%" align="left"><input id="lib" name="rubrique" class="champ_zonec" required="required" value="<?php echo $resu_findrub['rubrique'];?>"/><span class="rouge"> (*)</span></td>
    
  </tr>
  <tr>
    <td height="10" align="right"></td>
    <td align="left"></td>
    
  </tr>
    <tr>
    <td height="35" align="right"><label for="tdmde" class="obl">Description : &nbsp;</label></td>
    <td align="left">   				
            <input type="color" name="couleur" value="<?php echo $resu_findrub['color']; ?>"><span class="rouge"> (*)</span> 
                                
    </td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="txt_info">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td class="txt_info"><span class="rouge"> 
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