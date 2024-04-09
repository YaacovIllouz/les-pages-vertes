<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE sous_rubrique SET rubrique=%s WHERE Id=%s",
                       GetSQLValueString($_POST['rubrique'], "text"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
  echo 'Modification effectué avec succès';
}

$colname_sr_mod_sr = "-1";
if (isset($_GET['id'])) {
  $colname_sr_mod_sr = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_sr_mod_sr = sprintf("SELECT Id, rubrique FROM sous_rubrique WHERE Id = %s", GetSQLValueString($colname_sr_mod_sr, "int"));
$sr_mod_sr = mysql_query($query_sr_mod_sr, $annuaire) or die(mysql_error());
$row_sr_mod_sr = mysql_fetch_assoc($sr_mod_sr);
$totalRows_sr_mod_sr = mysql_num_rows($sr_mod_sr);
?>
<h3>Modifier <?php echo $row_sr_mod_sr['rubrique']; ?></h3>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rubrique:</td>
      <td><input type="text" name="rubrique" value="<?php echo htmlentities($row_sr_mod_sr['rubrique'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Modifier" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="Id" value="<?php echo $row_sr_mod_sr['Id']; ?>" />
</form>
<p>&nbsp;</p>
<p><a href="index.php?page=liste_sr">Retour</a></p>
<?php
mysql_free_result($sr_mod_sr);
?>
