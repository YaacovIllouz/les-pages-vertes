<?php
$colname_rs_mod_rubrique = "-1";
if (isset($_GET['id'])) {
  $colname_rs_mod_rubrique = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_mod_rubrique = sprintf("SELECT * FROM rubrique WHERE Id = %s", GetSQLValueString($colname_rs_mod_rubrique, "int"));
$rs_mod_rubrique = mysql_query($query_rs_mod_rubrique, $annuaire) or die(mysql_error());
$row_rs_mod_rubrique = mysql_fetch_assoc($rs_mod_rubrique);
$totalRows_rs_mod_rubrique = mysql_num_rows($rs_mod_rubrique);
?>
<article class="module width_full">
  <header>
    <h3><b>MODIFIER <?php echo $row_rs_mod_rubrique['rubrique']; ?></b></h3>
  </header>
  <div class="module_content">
    <?php
      $editFormAction = $_SERVER['PHP_SELF'];
      if (isset($_SERVER['QUERY_STRING'])) {
        $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
      }

      if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
        $updateSQL = sprintf("UPDATE rubrique SET rubrique=%s WHERE Id=%s",
            GetSQLValueString($_POST['rubrique'], "text"),
            GetSQLValueString($_POST['Id'], "int"));

        mysql_select_db($database_annuaire, $annuaire);
        $Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
        echo "<div style='text-align: center; color: #090;'>Rubrique modifiée avec succès</div>";
      }
    ?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center" style="width: 100%">
    <tr valign="baseline">
      <td nowrap align="right" style="width: 20%;">Rubrique:</td>
      <td style="width:80%;">
        <input type="text" name="rubrique" value="<?php echo htmlentities($row_rs_mod_rubrique['rubrique'], ENT_COMPAT, ''); ?>"  style="width:80%; padding: 3px;"></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Mettre à jour l'enregistrement" class="alt_btn"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="Id" value="<?php echo $row_rs_mod_rubrique['Id']; ?>">
</form>
<p>&nbsp;</p>
<a href="index.php?page=liste_rubrique">Retour</a>
</div>
  </article>
