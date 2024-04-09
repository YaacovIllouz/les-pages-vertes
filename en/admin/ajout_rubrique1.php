<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
   $rubrique = GetSQLValueString($_POST['rubrique'], "text");
   $req = "SELECT rubrique FROM rubrique WHERE  rubrique =  '".$rubrique."'";	
   $res = mysql_query($req);
   $total = mysql_num_rows($res);
   echo 'Rubrique ajoutée avec succès';  
}
?>
<h3>Ajouter une rubrique</h3>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rubrique:</td>
      <td><input type="text" name="rubrique" value="" size="32"  required="required"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Ajouter" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>