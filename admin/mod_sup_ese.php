<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE pub SET image=%s, Id_ese=%s WHERE Id=%s",
                       GetSQLValueString($_POST['image'], "text"),
                       GetSQLValueString($_POST['Id_ese'], "int"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
}

mysql_select_db($database_annuaire, $annuaire);
$query_rs_ese = "SELECT Id_ese, sigle FROM entreprise ORDER BY entreprise ASC";
$rs_ese = mysql_query($query_rs_ese, $annuaire) or die(mysql_error());
$row_rs_ese = mysql_fetch_assoc($rs_ese);
$totalRows_rs_ese = mysql_num_rows($rs_ese);

$colname_rs_mod_pub = "-1";
if (isset($_GET['id'])) {
  $colname_rs_mod_pub = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_mod_pub = sprintf("SELECT * FROM pub WHERE Id = %s", GetSQLValueString($colname_rs_mod_pub, "int"));
$rs_mod_pub = mysql_query($query_rs_mod_pub, $annuaire) or die(mysql_error());
$row_rs_mod_pub = mysql_fetch_assoc($rs_mod_pub);
$totalRows_rs_mod_pub = mysql_num_rows($rs_mod_pub);
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Id:</td>
      <td><?php echo $row_rs_mod_pub['Id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Image:</td>
      <td><input type="text" name="image" value="<?php echo htmlentities($row_rs_mod_pub['image'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Id_ese:</td>
      <td><select name="Id_ese">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_ese['Id_ese']?>" <?php if (!(strcmp($row_rs_ese['Id_ese'], htmlentities($row_rs_ese['sigle'])))) {echo "SELECTED";} ?>><?php echo $row_rs_ese['sigle']?></option>
        <?php
} while ($row_rs_ese = mysql_fetch_assoc($rs_ese));
?>
      </select></td>
    <tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="Id" value="<?php echo $row_rs_mod_pub['Id']; ?>">
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($rs_ese);

mysql_free_result($rs_mod_pub);
?>
