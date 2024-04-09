<?php
$colname_rs_r = "-1";
if (isset($_GET['id'])) {
  $colname_rs_r = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_r = sprintf("SELECT * FROM rubrique WHERE Id = %s", GetSQLValueString($colname_rs_r, "int"));
$rs_r = mysql_query($query_rs_r, $annuaire) or die(mysql_error());
$row_rs_r = mysql_fetch_assoc($rs_r);
$totalRows_rs_r = mysql_num_rows($rs_r);

$maxRows_rs_ese = 10;
$pageNum_rs_ese = 0;
if (isset($_GET['pageNum_rs_ese'])) {
  $pageNum_rs_ese = $_GET['pageNum_rs_ese'];
}
$startRow_rs_ese = $pageNum_rs_ese * $maxRows_rs_ese;

$colname_rs_ese = "-1";
if (isset($_GET['id'])) {
  $colname_rs_ese = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_ese = sprintf("SELECT * FROM entreprise WHERE Id_rubrique = %s ORDER BY entreprise ASC", GetSQLValueString($colname_rs_ese, "int"));
$query_limit_rs_ese = sprintf("%s LIMIT %d, %d", $query_rs_ese, $startRow_rs_ese, $maxRows_rs_ese);
$rs_ese = mysql_query($query_limit_rs_ese, $annuaire) or die(mysql_error());
$row_rs_ese = mysql_fetch_assoc($rs_ese);

if (isset($_GET['totalRows_rs_ese'])) {
  $totalRows_rs_ese = $_GET['totalRows_rs_ese'];
} else {
  $all_rs_ese = mysql_query($query_rs_ese);
  $totalRows_rs_ese = mysql_num_rows($all_rs_ese);
}
$totalPages_rs_ese = ceil($totalRows_rs_ese/$maxRows_rs_ese)-1;
?>
<h3>LA LISTE DES ENTREPRISES DE LA RUBRIQUE <?php echo $row_rs_r['rubrique']; ?></h3>
<table>
  <tr> 
    <td>sigle</td>
    <td>entreprise</td>
    <td>Modifier</td>
    <td>Supprimer</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rs_ese['sigle']; ?></td>
      <td><?php echo $row_rs_ese['entreprise']; ?></td>
      <td bgcolor="#CCCCCC"><b><a href="index.php?page=ajout_agence&id=<?php echo $row_rs_ese['Id_ese']; ?>">Ajouter une agence</a></b></td>
      <td bgcolor="#CCCCCC"><b><a href="index.php?page=mod_ese&id=<?php echo $row_rs_ese['Id_ese']; ?>">Modifier</a></b></td>
      <td bgcolor="#CCCCCC"><b><a href="index.php?page=sup_ese&id=<?php echo $row_rs_ese['Id_ese']; ?>">Supprimer</a></b></td>
    </tr>
    <?php } while ($row_rs_ese = mysql_fetch_assoc($rs_ese)); ?>
</table>
<?php
mysql_free_result($rs_r);

mysql_free_result($rs_ese);
?>
