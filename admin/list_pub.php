<?php
$colname_rs_sr = "-1";
if (isset($_GET['id'])) {
  $colname_rs_sr = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_sr = sprintf("SELECT * FROM sous_rubrique WHERE Id = %s ORDER BY rubrique ASC", GetSQLValueString($colname_rs_sr, "int"));
$rs_sr = mysql_query($query_rs_sr, $annuaire) or die(mysql_error());
$row_rs_sr = mysql_fetch_assoc($rs_sr);
$totalRows_rs_sr = mysql_num_rows($rs_sr);

$maxRows_rs_pub = 10;
$pageNum_rs_pub = 0;
if (isset($_GET['pageNum_rs_pub'])) {
  $pageNum_rs_pub = $_GET['pageNum_rs_pub'];
}
$startRow_rs_pub = $pageNum_rs_pub * $maxRows_rs_pub;

$colname_rs_pub = "-1";
if (isset($_GET['id'])) {
  $colname_rs_pub = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_pub = sprintf("SELECT * FROM pub2 WHERE Id_sr = %s ORDER BY Id DESC", GetSQLValueString($colname_rs_pub, "int"));
$query_limit_rs_pub = sprintf("%s LIMIT %d, %d", $query_rs_pub, $startRow_rs_pub, $maxRows_rs_pub);
$rs_pub = mysql_query($query_limit_rs_pub, $annuaire) or die(mysql_error());
$row_rs_pub = mysql_fetch_assoc($rs_pub);

if (isset($_GET['totalRows_rs_pub'])) {
  $totalRows_rs_pub = $_GET['totalRows_rs_pub'];
} else {
  $all_rs_pub = mysql_query($query_rs_pub);
  $totalRows_rs_pub = mysql_num_rows($all_rs_pub);
}
$totalPages_rs_pub = ceil($totalRows_rs_pub/$maxRows_rs_pub)-1;
?>
<h3>Liste des publicités de la rubrique <span style="color:#090; font-size:14px;"><b> <?php echo $row_rs_sr['rubrique']; ?></b></span></h3>
<table width="100%" border="1">
  <tr>
    <td width="14%" align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF; font-size:14px;">Image</span></td>
    <td width="31%" align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF; font-size:14px;">Catégorie</span></td>
    <td width="24%" align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF; font-size:14px;">Rubrique</span></td>

   <td width="17%" align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF; font-size:14px;">Modifier</span></td>

   <td width="14%" align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF; font-size:14px;">Supprimer</span></td>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center" valign="middle"><img src="../<?php echo $row_rs_pub['images']; ?>" width="28" height="100"></td>
      <td align="center" valign="middle"><b>
   
      
       <?php 
       mysql_select_db($database_annuaire, $annuaire);
       $req = "SELECT * FROM rubrique WHERE Id = '".$row_rs_sr['Id_rubrique']."'";
	   $res= mysql_query($req);
	   $row= mysql_fetch_assoc($res);
	   echo $row['rubrique'];
      ?></b>
      </td>
      <td align="center" valign="middle"><b>
	 <?php echo $row_rs_sr['rubrique']; ?></b>
      </td>
      <td width="17%" align="center" valign="middle"><a href="index.php?page=mod_pub_cat&id=<?php echo $row_rs_pub['Id']; ?>"><b>Modifier</b></a></td>
      <td width="14%" align="center" valign="middle"><a href="index.php?page=sup_pub_cat&id=<?php echo $row_rs_pub['Id']; ?>"><b>Supprimer</b></a></td>
    </tr>
    <?php } while ($row_rs_pub = mysql_fetch_assoc($rs_pub)); ?>
</table>
<?php
mysql_free_result($rs_sr);

mysql_free_result($rs_pub);
?>
