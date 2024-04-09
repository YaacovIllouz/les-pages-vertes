<?php 
$maxRows_rs_all_flash = 10;
$pageNum_rs_all_flash = 0;
if (isset($_GET['pageNum_rs_all_flash'])) {
  $pageNum_rs_all_flash = $_GET['pageNum_rs_all_flash'];
}
$startRow_rs_all_flash = $pageNum_rs_all_flash * $maxRows_rs_all_flash;

mysql_select_db($database_annuaire, $annuaire);
$query_rs_all_flash = "SELECT * FROM flash ORDER BY Id DESC";
$query_limit_rs_all_flash = sprintf("%s LIMIT %d, %d", $query_rs_all_flash, $startRow_rs_all_flash, $maxRows_rs_all_flash);
$rs_all_flash = mysql_query($query_limit_rs_all_flash, $annuaire) or die(mysql_error());
$row_rs_all_flash = mysql_fetch_assoc($rs_all_flash);

if (isset($_GET['totalRows_rs_all_flash'])) {
  $totalRows_rs_all_flash = $_GET['totalRows_rs_all_flash'];
} else {
  $all_rs_all_flash = mysql_query($query_rs_all_flash);
  $totalRows_rs_all_flash = mysql_num_rows($all_rs_all_flash);
}
$totalPages_rs_all_flash = ceil($totalRows_rs_all_flash/$maxRows_rs_all_flash)-1;$maxRows_rs_all_flash = 10;
$pageNum_rs_all_flash = 0;
if (isset($_GET['pageNum_rs_all_flash'])) {
  $pageNum_rs_all_flash = $_GET['pageNum_rs_all_flash'];
}
$startRow_rs_all_flash = $pageNum_rs_all_flash * $maxRows_rs_all_flash;

mysql_select_db($database_annuaire, $annuaire);
$query_rs_all_flash = "SELECT * FROM flash ORDER BY Id DESC";
$query_limit_rs_all_flash = sprintf("%s LIMIT %d, %d", $query_rs_all_flash, $startRow_rs_all_flash, $maxRows_rs_all_flash);
$rs_all_flash = mysql_query($query_limit_rs_all_flash, $annuaire) or die(mysql_error());
$row_rs_all_flash = mysql_fetch_assoc($rs_all_flash);

if (isset($_GET['totalRows_rs_all_flash'])) {
  $totalRows_rs_all_flash = $_GET['totalRows_rs_all_flash'];
} else {
  $all_rs_all_flash = mysql_query($query_rs_all_flash);
  $totalRows_rs_all_flash = mysql_num_rows($all_rs_all_flash);
}
$totalPages_rs_all_flash = ceil($totalRows_rs_all_flash/$maxRows_rs_all_flash)-1;
?>
<article class="module width_full">
  <header>
    <h3><b><span style="color: #090; font-size:14px;"><b>La liste des infos publiées</b></span></b></h3>
  </header>
  <div class="module_content">

    <table class="tablesorter" cellspacing="0">
      <thead>
      <tr>
        <th>Titre</th>
        <th>Date</th>
        <th>Modifier</th>
        <th>Supprimier</th>
      </tr>
      </thead>
      <tbody>
    <?php do { ?>
      <tr>
        <td width="301" align="left" valign="middle"><b><?php echo $row_rs_all_flash['titre']; ?></b></td>
        <td width="157" align="center" valign="middle"><b><?php echo gestionDate::formatDate($row_rs_all_flash['date'],'fr'); ?></b></td>
        <td width="72" align="center" valign="middle"><b><a href="index.php?page=mod_flash&id=<?php echo $row_rs_all_flash['Id']; ?>">Modifier</a></b></td>
        <td width="69" align="center" valign="middle"><b><a href="index.php?page=sup_flash&id=<?php echo $row_rs_all_flash['Id']; ?>">Supprimer</a></b></td>
      </tr>
      <?php } while ($row_rs_all_flash = mysql_fetch_assoc($rs_all_flash)); ?>
      </tbody>
    </table>
    </div>
  </article>
