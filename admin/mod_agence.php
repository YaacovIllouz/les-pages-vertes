<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE agence SET agence=%s, sit_geographique=%s, tel=%s, cel=%s, bp=%s, fax=%s, email=%s, dirigeant=%s WHERE Id=%s",
                       GetSQLValueString($_POST['agence'], "text"),
                       GetSQLValueString($_POST['sit_geographique'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['cel'], "text"),
                       GetSQLValueString($_POST['bp'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString($_POST['dirigeant'], "text"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
  echo "Agence modifiée avec succès";
}

$colname_rs_agence = "-1";
if (isset($_GET['id'])) {
  $colname_rs_agence = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_agence = sprintf("SELECT Id, agence, sit_geographique, tel, cel, bp, fax, email, dirigeant FROM agence WHERE Id = %s", GetSQLValueString($colname_rs_agence, "int"));
$rs_agence = mysql_query($query_rs_agence, $annuaire) or die(mysql_error());
$row_rs_agence = mysql_fetch_assoc($rs_agence);
$totalRows_rs_agence = mysql_num_rows($rs_agence);

mysql_free_result($rs_agence);
?>
<article class="module width_full">
  <header>
    <h3><b>MODIFIER LES INFORMATIONS DE L'AGENCE <?php echo $row_rs_agence['agence']; ?></b></h3>
  </header>
  <div class="module_content">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center" style="width: 100%;">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" style="width:20%;">Agence:</td>
      <td style="width:80%;"><input type="text" name="agence" value="<?php echo htmlentities($row_rs_agence['agence'], ENT_COMPAT, ''); ?>" style="width: 70%; margin-left: 10px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sit_geographique:</td>
      <td><input type="text" name="sit_geographique" value="<?php echo htmlentities($row_rs_agence['sit_geographique'], ENT_COMPAT, ''); ?>" style="width: 70%; margin-left: 10px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tel:</td>
      <td><input type="text" name="tel" value="<?php echo htmlentities($row_rs_agence['tel'], ENT_COMPAT, ''); ?>" style="width: 70%; margin-left: 10px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cel:</td>
      <td><input type="text" name="cel" value="<?php echo htmlentities($row_rs_agence['cel'], ENT_COMPAT, ''); ?>" style="width: 70%; margin-left: 10px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Bp:</td>
      <td><input type="text" name="bp" value="<?php echo htmlentities($row_rs_agence['bp'], ENT_COMPAT, ''); ?>" style="width: 70%; margin-left: 10px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fax:</td>
      <td><input type="text" name="fax" value="<?php echo htmlentities($row_rs_agence['fax'], ENT_COMPAT, ''); ?>" style="width: 70%; margin-left: 10px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_rs_agence['email'], ENT_COMPAT, ''); ?>" style="width: 70%; margin-left: 10px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Dirigeant:</td>
      <td><input type="text" name="dirigeant" value="<?php echo htmlentities($row_rs_agence['dirigeant'], ENT_COMPAT, ''); ?>" style="width: 70%; margin-left: 10px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Mettre à jour l'enregistrement" class="alt_btn" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="Id" value="<?php echo $row_rs_agence['Id']; ?>" />
</form>
</div>
  </article>

