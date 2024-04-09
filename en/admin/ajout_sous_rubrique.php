<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO sous_rubrique (rubrique, Id_rubrique) VALUES (%s, %s)",
                       GetSQLValueString($_POST['rubrique'], "text"),
                       GetSQLValueString($_POST['Id_rubrique'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
  echo "Sous rubrique ajoutée avec succès";
}

mysql_select_db($database_annuaire, $annuaire);
$query_rs_rubrique = "SELECT * FROM rubrique ORDER BY rubrique ASC";
$rs_rubrique = mysql_query($query_rs_rubrique, $annuaire) or die(mysql_error());
$row_rs_rubrique = mysql_fetch_assoc($rs_rubrique);
$totalRows_rs_rubrique = mysql_num_rows($rs_rubrique);
?>
<article class="module width_full">
    <header>
        <h3><b>AJOUTER UNE RUBRIQUE</b></h3>        
    </header>
    <div class="module_content">
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
            <table align="center" style="width: 100%;">
                <tr valign="baseline">
                    <td nowrap align="right" style="width: 20%;"><b>Rubrique :&nbsp;&nbsp;&nbsp;</b></td>
                    <td style="width: 80%;"><input type="text" name="rubrique" value=""  style="width:90%; padding: 5px;"></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right"><b>Cat&eacute;gorie :&nbsp;&nbsp;&nbsp;</b></td>
                    <td>
                        <select name="Id_rubrique"  style="width: 90%; padding: 5px;">
                        <?php do {   ?>
                                <option value="<?php echo $row_rs_rubrique['Id']?>" <?php if (!(strcmp($row_rs_rubrique['Id'], $row_rs_rubrique['rubrique']))) {echo "SELECTED";} ?>><?php echo $row_rs_rubrique['rubrique']?></option>
                        <?php } while ($row_rs_rubrique = mysql_fetch_assoc($rs_rubrique));?>
                        </select>
                    </td>
              <tr>
              <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><br /><input type="submit" value="Ajouter une sous rubrique"  class="alt_btn" /></td>
              </tr>
            </table>
            <input type="hidden" name="MM_insert" value="form1">
        </form>
    </div>
</article>
<?php
mysql_free_result($rs_rubrique);
?>
