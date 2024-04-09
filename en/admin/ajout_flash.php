<?php
 $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$maintenant = time();
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO flash (titre, `date`, contenu) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['titre'], "text"),
                       GetSQLValueString($maintenant, "text"),
                       GetSQLValueString($_POST['contenu'], "text"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
  echo 'Info ajoutée avec succès';
}
?>
<script src="ckeditor/ckeditor.js"></script>
<h3><span style="color: #090; font-size:14px;"><b>AJOUTER UNE INFO</b></span></h3>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Titre </b></td>
      <td><input type="text" name="titre" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left" valign="middle"><b>Contenu &nbsp;</b></td>
      <td><textarea name="contenu" cols="50" rows="5" id="editor1"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><br /><input type="submit" value="Valider" /></td>
    </tr>
  </table>
  <input type="hidden" name="date" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<script type="text/javascript" src="../js/ajax.js"></script>

<script>
       // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor1' );
</script>