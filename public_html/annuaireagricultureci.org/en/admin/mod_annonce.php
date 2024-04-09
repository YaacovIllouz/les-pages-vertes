<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE annonce SET nom=%s, entreprise=%s, contact=%s, email=%s, annonce=%s, publier=%s WHERE Id=%s",
                       GetSQLValueString($_POST['nom'], "text"),
                       GetSQLValueString($_POST['entreprise'], "text"),
                       GetSQLValueString($_POST['contact'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['annonce'], "text"),
                       GetSQLValueString($_POST['publier'], "text"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
  echo 'Annonce modifiée avec succès';
}

$colname_rs_mod_anonce = "-1";
if (isset($_GET['id'])) {
  $colname_rs_mod_anonce = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_mod_anonce = sprintf("SELECT Id, nom, entreprise, contact, email, annonce, publier FROM annonce WHERE Id = %s", GetSQLValueString($colname_rs_mod_anonce, "int"));
$rs_mod_anonce = mysql_query($query_rs_mod_anonce, $annuaire) or die(mysql_error());
$row_rs_mod_anonce = mysql_fetch_assoc($rs_mod_anonce);
$totalRows_rs_mod_anonce = mysql_num_rows($rs_mod_anonce);
?>
<script src="ckeditor/ckeditor.js"></script>
<h3>Modifier l' annonce de l'entreprise <b style="color:#090;"><?php echo $row_rs_mod_anonce['entreprise']; ?></b> </h3>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap><b>Nom</b></td>
      <td><input type="text" name="nom" value="<?php echo htmlentities($row_rs_mod_anonce['nom'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap><b>Entreprise</td>
      <td><input type="text" name="entreprise" value="<?php echo htmlentities($row_rs_mod_anonce['entreprise'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap><b>Contact</b></td>
      <td><input type="text" name="contact" value="<?php echo htmlentities($row_rs_mod_anonce['contact'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap><b>Email</b></td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_rs_mod_anonce['email'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="left" valign="middle"><b>Annonce</b></td>
      <td><textarea name="annonce" cols="50" rows="5" id="editor1"><?php echo htmlentities($row_rs_mod_anonce['annonce'], ENT_COMPAT, ''); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap><b>Publier</b></td>
      <td><select name="publier">
        <option value="Publier" <?php if (!(strcmp("Publier", htmlentities($row_rs_mod_anonce['publier'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Publier</option>
        <option value="Ne pas publier" <?php if (!(strcmp("Ne pas publier", htmlentities($row_rs_mod_anonce['publier'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Ne pas publier</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Mettre à jour"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="Id" value="<?php echo $row_rs_mod_anonce['Id']; ?>">
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($rs_mod_anonce);
?>
<script type="text/javascript" src="../js/ajax.js"></script>

<script>
       // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor1' );
</script>