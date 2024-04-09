<?php
$maxRows_rs_liste = 30;
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
<h3><span style="color: #090; font-size:14px;">LISTE DES ENTREPRISES PAR RUBRIQUE</span></h3>
<table width="100%" style="padding-left:10px;">
  <?php do { ?>
    <tr bgcolor="#F6F6F6">
      <td bgcolor="#99CC66"><a href="index.php?page=ese_s&id=<?php echo $row_rs_liste['Id']; ?>"><?php echo $row_rs_liste['rubrique']; ?></a></td>
      <td bgcolor="#99CC66"><a href="index.php?page=mod_rubrique&id=<?php echo $row_rs_liste['Id']; ?>">Modifier</a></td>
      <td bgcolor="#99CC66"><a href="index.php?page=sup_rubrique&id=<?php echo $row_rs_liste['Id']; ?>">Supprimer</a></td>
    </tr>
    <?php } while ($row_rs_liste = mysql_fetch_assoc($rs_liste)); ?>
</table>
<?php
mysql_free_result($rs_liste);
?>
