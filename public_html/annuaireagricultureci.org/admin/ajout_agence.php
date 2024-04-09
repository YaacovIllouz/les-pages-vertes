<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO agence (agence, sit_geographique, tel, Id_ese, cel, fax, bp, email, dirigeant) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['agence'], "text"),
                       GetSQLValueString($_POST['sit_geographique'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['Id_ese'], "int"),
                       GetSQLValueString($_POST['cel'], "text"),
					   GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['bp'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString($_POST['dirigeant'], "text"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
  echo 'Agence ajoutée avec succès';
}

$colname_rs_ese = "-1";
if (isset($_GET['id'])) {
  $colname_rs_ese = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_ese = sprintf("SELECT Id_ese, entreprise FROM entreprise WHERE Id_ese = %s", GetSQLValueString($colname_rs_ese, "int"));
$rs_ese = mysql_query($query_rs_ese, $annuaire) or die(mysql_error());
$row_rs_ese = mysql_fetch_assoc($rs_ese);
$totalRows_rs_ese = mysql_num_rows($rs_ese);

$maxRows_rs_agence = 30;
$pageNum_rs_agence = 0;
if (isset($_GET['pageNum_rs_agence'])) {
  $pageNum_rs_agence = $_GET['pageNum_rs_agence'];
}
$startRow_rs_agence = $pageNum_rs_agence * $maxRows_rs_agence;

$colname_rs_agence = "-1";
if (isset($_GET['id'])) {
  $colname_rs_agence = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_agence = sprintf("SELECT * FROM agence WHERE Id_ese = %s ORDER BY agence ASC", GetSQLValueString($colname_rs_agence, "int"));
$query_limit_rs_agence = sprintf("%s LIMIT %d, %d", $query_rs_agence, $startRow_rs_agence, $maxRows_rs_agence);
$rs_agence = mysql_query($query_limit_rs_agence, $annuaire) or die(mysql_error());
$row_rs_agence = mysql_fetch_assoc($rs_agence);

if (isset($_GET['totalRows_rs_agence'])) {
  $totalRows_rs_agence = $_GET['totalRows_rs_agence'];
} else {
  $all_rs_agence = mysql_query($query_rs_agence);
  $totalRows_rs_agence = mysql_num_rows($all_rs_agence);
}
$totalPages_rs_agence = ceil($totalRows_rs_agence/$maxRows_rs_agence)-1;
?>
<article class="module width_full">
  <header>
    <h3><b>Ajouter une agence pour l' entreprise <span style="color: #090; font-size:14px;"><?php echo $row_rs_ese['entreprise']; ?></span></b></h3>
  </header>
  <div class="module_content">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center" style="width:100%;">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left" style="width:20%;"><b>Agence </b></td>
      <td style="width: 80%;"><input type="text" name="agence" value="" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Situation géographique </td>
      <td><input type="text" name="sit_geographique" value="" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Téléphone </b></td>
      <td><input type="text" name="tel" value="+225" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Celulaire </b></td>
      <td><input type="text" name="cel" value="+225" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
     <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Fax </b></td>
      <td><input type="text" name="fax" value="+225" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Boite postale :</b></td>
      <td><input type="text" name="bp" value="" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>E-mail</b></td>
      <td><input type="text" name="email" value="" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Dirigeant</b></td>
      <td><input type="text" name="dirigeant" value="" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Enregistrer" class="alt_btn" /></td>
    </tr>
  </table>
  <input type="hidden" name="Id_ese" value="<?php echo $row_rs_ese['Id_ese']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<br />

    <table class="tablesorter" cellspacing="0">
    <tr bgcolor="#CCCCCC">
    <td bgcolor="#006600"><span style="color:#FFF; font-size:14px;"><b>Agence</b></span></td>
     <td bgcolor="#006600"><span style="color:#FFF; font-size:14px;"><b>Situation géographique</b></span></td>
    <td bgcolor="#006600"><span style="color:#FFF; font-size:14px;"><b>Modifier</b></span></td>
    <td bgcolor="#006600"><span style="color:#FFF; font-size:14px;"><b>Supprimer</b></span></td>
  </tr>
  <?php do { ?>
    <tr>
      <td  style="padding-left:5px;"><b><?php echo $row_rs_agence['agence']; ?></b></td>
      <td style="padding-left:5px;"><b><?php echo $row_rs_agence['sit_geographique']; ?></b></td>
      <td><a href="index.php?page=mod_agence&id=<?php echo $row_rs_agence['Id']; ?>"><b>Modifier</b></a></td>
      <td><a href="index.php?page=sup_agence&id=<?php echo $row_rs_agence['Id']; ?>"><b>Supprimer</b></a></td>
    </tr>
    <?php } while ($row_rs_agence = mysql_fetch_assoc($rs_agence)); ?>
</table>
</div>
  </article>
