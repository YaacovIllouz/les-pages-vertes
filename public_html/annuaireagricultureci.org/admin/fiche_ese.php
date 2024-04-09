<?php

$colname_rs_ese = "-1";
if (isset($_GET['id'])) {
  $colname_rs_ese = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_ese = sprintf("SELECT * FROM entreprise WHERE Id_ese = %s", GetSQLValueString($colname_rs_ese, "int"));
$rs_ese = mysql_query($query_rs_ese, $annuaire) or die(mysql_error());
$row_rs_ese = mysql_fetch_assoc($rs_ese);
$totalRows_rs_ese = mysql_num_rows($rs_ese);
?>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<h3>Fiche entreprise - <?php echo $row_rs_ese['entreprise']; ?></h3>
<div class="container">
<div class="row">
	<div class="col-md-4"><img src="../<?php echo $row_rs_ese['image']; ?>" class="img-responsive"></div><!--col-md-4-->
    <div class="col-md-8"><?php echo $row_rs_ese['entreprise']; ?></div><!--col-md-8-->
</div><!--row-->
</div><!--container-->
<?php
mysql_free_result($rs_ese);
?>
