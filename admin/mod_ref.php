<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE `ref` SET titre=%s, contenu=%s WHERE id=%s",
                       GetSQLValueString($_POST['titre'], "text"),
                       GetSQLValueString($_POST['contenu'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
}

mysql_select_db($database_annuaire, $annuaire);
$query_ref = "SELECT id, titre, contenu FROM `ref` ORDER BY id ASC";
$ref = mysql_query($query_ref, $annuaire) or die(mysql_error());
$row_ref = mysql_fetch_assoc($ref);
$totalRows_ref = mysql_num_rows($ref);

mysql_free_result($ref);
?>
<article class="module width_full">
    <header>
        <h3><b>MODIFIER LES INFORMATIONS SUR LE REFERENCEMENT</b></h3>        
    </header>
    <div class="module_content">
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
            <table align="center" style="width: 100%;">
                <tr valign="baseline">
                    <td nowrap align="right" style="width:10%;">Titre : &nbsp;&nbsp;&nbsp;</td>
                    <td style="width: 90%;">
                        <input type="text" name="titre" value="<?php echo htmlentities($row_ref['titre'], ENT_COMPAT, ''); ?>" style="padding: 5px; width: 90%;" >
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">Contenu : &nbsp;&nbsp;&nbsp;</td>
                  <td><textarea name="contenu" rows="8"  style="width: 90%;" id="editor1"><?php echo htmlentities($row_ref['contenu'], ENT_COMPAT, ''); ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td><input type="submit" value="Mettre &agrave; jour"  class="alt_btn" /></td>
                </tr>
            </table>
            <input type="hidden" name="MM_update" value="form1">
            <input type="hidden" name="id" value="<?php echo $row_ref['id']; ?>">
        </form>
    </div>
</article>
<script>
       // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor1' );
</script>