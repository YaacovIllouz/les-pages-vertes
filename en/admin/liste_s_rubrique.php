<?php

$maxRows_rs_s_rubrique = 10;
$pageNum_rs_s_rubrique = 0;
if (isset($_GET['pageNum_rs_s_rubrique'])) {
  $pageNum_rs_s_rubrique = $_GET['pageNum_rs_s_rubrique'];
}
$startRow_rs_s_rubrique = $pageNum_rs_s_rubrique * $maxRows_rs_s_rubrique;

$colname_rs_s_rubrique = "-1";
if (isset($_GET['id'])) {
  $colname_rs_s_rubrique = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_s_rubrique = sprintf("SELECT * FROM sous_rubrique WHERE Id_rubrique = %s", GetSQLValueString($colname_rs_s_rubrique, "int"));
$query_limit_rs_s_rubrique = sprintf("%s LIMIT %d, %d", $query_rs_s_rubrique, $startRow_rs_s_rubrique, $maxRows_rs_s_rubrique);
$rs_s_rubrique = mysql_query($query_limit_rs_s_rubrique, $annuaire) or die(mysql_error());
$row_rs_s_rubrique = mysql_fetch_assoc($rs_s_rubrique);

if (isset($_GET['totalRows_rs_s_rubrique'])) {
  $totalRows_rs_s_rubrique = $_GET['totalRows_rs_s_rubrique'];
} else {
  $all_rs_s_rubrique = mysql_query($query_rs_s_rubrique);
  $totalRows_rs_s_rubrique = mysql_num_rows($all_rs_s_rubrique);
}
$totalPages_rs_s_rubrique = ceil($totalRows_rs_s_rubrique/$maxRows_rs_s_rubrique)-1;
?>
<h3>LISTE DES SOUS RUBRIQUES DE LA RUBRIQUE 

<?php 
				   mysql_select_db($database_annuaire, $annuaire);
				   $req = "SELECT * FROM sous_rubrique WHERE Id = '".$row_rs_s_rubrique['Id_rubrique']."'";
				   $res= mysql_query($req);
				   $row= mysql_fetch_assoc($res);
				   echo '<b style="text-transform:uppercase">'.$row['rubrique'].'</b>';
 ?>	
</h3>


<table width="100%" style="padding-left:10px;">
  <?php do { ?>
    <tr>
      <td align="left" valign="middle" bgcolor="#666666"><?php echo $row_rs_s_rubrique['rubrique']; ?></td>
      <td align="left" valign="middle" bgcolor="#666666"><a href="index.php?page=mod_sr&id=<?php echo $row_rs_s_rubrique['Id']; ?>">Modifier</a></td>
      <td align="left" valign="middle" bgcolor="#666666"><a href="index.php?page=sup_sr&id=<?php echo $row_rs_s_rubrique['Id']; ?>">Supprimer</a></td>
    </tr>
    <?php } while ($row_rs_s_rubrique = mysql_fetch_assoc($rs_s_rubrique)); ?>
</table>
<?php
mysql_free_result($rs_s_rubrique);
?>
