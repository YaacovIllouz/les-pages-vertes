<?php
$maxRows_rs_liste = 10;
$pageNum_rs_liste = 0;
if (isset($_GET['pageNum_rs_liste'])) {
  $pageNum_rs_liste = $_GET['pageNum_rs_liste'];
}
$startRow_rs_liste = $pageNum_rs_liste * $maxRows_rs_liste;

mysql_select_db($database_annuaire, $annuaire);
$query_rs_liste = "SELECT * FROM rubrique ORDER BY rubrique ASC";
$query_limit_rs_liste = sprintf("%s LIMIT %d, %d", $query_rs_liste, $startRow_rs_liste, $maxRows_rs_liste);
$rs_liste = mysql_query($query_limit_rs_liste, $annuaire) or die(mysql_error());
$row_rs_liste = mysql_fetch_assoc($rs_liste);

if (isset($_GET['totalRows_rs_liste'])) {
  $totalRows_rs_liste = $_GET['totalRows_rs_liste'];
} else {
  $all_rs_liste = mysql_query($query_rs_liste);
  $totalRows_rs_liste = mysql_num_rows($all_rs_liste);
}
$totalPages_rs_liste = ceil($totalRows_rs_liste/$maxRows_rs_liste)-1;
?>
<article class="module width_full">
    <header>
        <h3><b>LISTE DES CATEGORIES</b></h3>        
    </header>
    <div class="module_content">
        <table width="100%" class="tablesorter" cellspacing="0">
          <?php do { ?>
            <tr>
              <td><b><?php echo $row_rs_liste['rubrique']; ?></b></td>
              <td align="center" valign="middle" style="width: 5%;">
                  <a href="index.php?page=mod_rubrique&id=<?php echo $row_rs_liste['Id']; ?>" title="Modifier">
                      <b>Modifier</b>
                  </a>
              </td>
              <td align="center" valign="middle" style="width: 5%;">
                  <a href="index.php?page=sup_rubrique&id=<?php echo $row_rs_liste['Id']; ?>" title="Supprimer">
                      <b>Supprimer</b>
                  </a>
              </td>
            </tr>
            <?php } while ($row_rs_liste = mysql_fetch_assoc($rs_liste)); ?>
        </table>
    </div>
</article>
<?php
mysql_free_result($rs_liste);
?>
