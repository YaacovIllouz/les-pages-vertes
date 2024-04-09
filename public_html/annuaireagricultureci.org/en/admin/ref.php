<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO `ref` (id, titre, contenu) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['titre'], "text"),
                       GetSQLValueString($_POST['contenu'], "text"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
}

$maxRows_ref = 2;
$pageNum_ref = 0;
if (isset($_GET['pageNum_ref'])) {
  $pageNum_ref = $_GET['pageNum_ref'];
}
$startRow_ref = $pageNum_ref * $maxRows_ref;

mysql_select_db($database_annuaire, $annuaire);
$query_ref = "SELECT id, titre, contenu FROM `ref` ORDER BY id ASC";
$query_limit_ref = sprintf("%s LIMIT %d, %d", $query_ref, $startRow_ref, $maxRows_ref);
$ref = mysql_query($query_limit_ref, $annuaire) or die(mysql_error());
$row_ref = mysql_fetch_assoc($ref);

if (isset($_GET['totalRows_ref'])) {
  $totalRows_ref = $_GET['totalRows_ref'];
} else {
  $all_ref = mysql_query($query_ref);
  $totalRows_ref = mysql_num_rows($all_ref);
}
$totalPages_ref = ceil($totalRows_ref/$maxRows_ref)-1;
?>
<article class="module width_full">
    <header>
        <h3><b>R&eacute;f&eacute;rencement</b></h3>        
    </header>
    <div class="module_content">
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <table align="center" style="width: 100%;">
                <tr valign="baseline">
                    <td style="width:20%;" align="right" valign="middle" nowrap="nowrap"><b>Titre</b>&nbsp;&nbsp;&nbsp;</td>
                    <td style="width:80%;"><input type="text" name="titre" value="" style="width: 90%; padding: 5px;" autofocus="true" /></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr valign="baseline">
                    <td align="right" valign="middle" nowrap="nowrap"><b>Contenu</b>&nbsp;&nbsp;&nbsp;</td>
                    <td><textarea id="editor1" name="contenu" rows="5" style="width: 90%;"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr valign="baseline">
                    <td nowrap="nowrap" align="right">&nbsp;</td>
                    <td><input type="submit" value="Enregistrer"  class="alt_btn" /></td>
                </tr>
            </table>
            <input type="hidden" name="MM_insert" value="form1" />
        </form>
    </div>
    
    <p>&nbsp;</p>
    <table class="tablesorter" cellspacing="0">
        <thead>
            <tr>
                <th width="257" align="left" valign="middle"><span><b>Titre</b></span></th>
                <th width="102" align="center" valign="middle"><span><b>Modifier</b></span></th>
            </tr>
        </thead>
        <tbody>
            <?php do { ?>
        <tr>
          <td><?php echo $row_ref['titre']; ?></td>
          <td align="center" valign="middle"><a href="index.php?page=mod_ref&id=<?php echo $row_ref['id']; ?>"><b>Modifier</b></a></td>
        </tr>
        <?php } while ($row_ref = mysql_fetch_assoc($ref)); ?>
        </tbody>
      
    </table>
    
</article>
<?php
mysql_free_result($ref);
?>

<script>
     CKEDITOR.replace( 'editor1' );
</script>