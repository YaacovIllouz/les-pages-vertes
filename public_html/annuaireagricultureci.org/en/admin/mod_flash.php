<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE flash SET titre=%s, contenu=%s WHERE Id=%s",
                       GetSQLValueString($_POST['titre'], "text"),
                       GetSQLValueString($_POST['contenu'], "text"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
  echo 'Article modifié avec succès';
}

$colname_rs_mod_flash = "-1";
if (isset($_GET['id'])) {
  $colname_rs_mod_flash = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_mod_flash = sprintf("SELECT * FROM flash WHERE Id = %s", GetSQLValueString($colname_rs_mod_flash, "int"));
$rs_mod_flash = mysql_query($query_rs_mod_flash, $annuaire) or die(mysql_error());
$row_rs_mod_flash = mysql_fetch_assoc($rs_mod_flash);
$totalRows_rs_mod_flash = mysql_num_rows($rs_mod_flash);
?>
<script src="ckeditor/ckeditor.js"></script>
<article class="module width_full">
  <header>
    <h3><b><span style="color: #090; font-size:14px;">Modifier <?php echo $row_rs_mod_flash['titre']; ?></span></b></h3>
  </header>
  <div class="module_content">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center" style="width: 100%;">
    <tr valign="baseline">
      <td nowrap align="right" style="width: 20%;">Titre:</td>
      <td style="width: 80%;">
        <input type="text" name="titre" value="<?php echo htmlentities($row_rs_mod_flash['titre'], ENT_COMPAT, ''); ?>" style="width:90%;"></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Contenu:</td>
      <td><textarea name="contenu" cols="50" rows="5" id="editor1"  style="width: 70%;"><?php echo htmlentities($row_rs_mod_flash['contenu'], ENT_COMPAT, ''); ?></textarea></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Valider" class="alt_btn"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="Id" value="<?php echo $row_rs_mod_flash['Id']; ?>">
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($rs_mod_flash);
?>
<script type="text/javascript" src="../js/ajax.js"></script>

<script>
       // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor1' );
</script>
    </div>
  </article>