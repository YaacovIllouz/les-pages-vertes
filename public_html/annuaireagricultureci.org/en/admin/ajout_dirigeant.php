<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO dirigeant (nom, fonction, Id_ese) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['nom'], "text"),
                       GetSQLValueString($_POST['fonction'], "text"),
                       GetSQLValueString($_POST['Id_ese'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
  echo 'Dirigeant ajouté avec succès';
}

$colname_rs_ese = "-1";
if (isset($_GET['id'])) {
  $colname_rs_ese = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_ese = sprintf("SELECT Id_ese, entreprise FROM entreprise WHERE Id_ese = %s", GetSQLValueString($colname_rs_ese, "int"));
$rs_ese = mysql_query($query_rs_ese, $annuaire) or die(mysql_error());
$row_rs_ese = mysql_fetch_assoc($rs_ese);
$totalRows_rs_ese = mysql_num_rows($rs_ese);
?>
<h3>Ajouter un dirigeant de l'entreprise <?php echo $row_rs_ese['entreprise']; ?></h3>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Nom:</td>
      <td><input type="text" name="nom" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Fonction:</td>
      <td><input type="text" name="fonction" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Valider"></td>
    </tr>
  </table>
  <input type="hidden" name="Id_ese" value="<?php echo $row_rs_ese['Id_ese']; ?>">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<a href="index.php?page=liste_ese">Retour</a>
<?php
mysql_free_result($rs_ese);
?>
