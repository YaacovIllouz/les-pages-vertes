<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$maintenant = time();
if (isset($_POST['img_up']))
{
     $Upload = new uploadImage(512,1000,1000,80,80,'../userfiles/image/');
     $Upload->SetExtension(".jpg;.jpeg;.gif;.png");
     $Upload->SetMimeType("image/jpg;image/gif;image/png");

     $msg = '';
     if($Upload->CheckUpload())
     {
		if($Upload->WriteFile())
		{
	   		$msg = "<p>image chargée avec succès</p>";
	        $tableau = $Upload->GetSummary();
  $insertSQL = sprintf("INSERT INTO pub (image, `date`, Id_ese) VALUES (%s, %s, %s)",
                       GetSQLValueString(substr($tableau['chemin'],3), "text"),
                       GetSQLValueString($maintenant, "text"),
                       GetSQLValueString($_POST['Id_ese'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
echo 'Pub chargeé avec succès';			
		}
		else
		{
	    	$msg = "<p>Echec 2 du transfert de l'image sur le serveur.</p>";
			$tableau = $Upload-> GetError();
			foreach ($tableau as $valeur)
			{
	        	$msg .= $valeur."<br />";
			}
		}
     }
     else
     {
	    $msg = "<p>Echec 1 du transfert de l'image sur le serveur.</p>";
        $tableau = $Upload-> GetError();
		foreach ($tableau as $valeur)
		{
	        $msg .= $valeur."<br />";
		}
     }
//$buffer .= '</infos>';
echo $msg;
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_ese = "SELECT Id_ese, sigle FROM entreprise ORDER BY entreprise ASC";
$rs_ese = mysql_query($query_rs_ese, $annuaire) or die(mysql_error());
$row_rs_ese = mysql_fetch_assoc($rs_ese);
$totalRows_rs_ese = mysql_num_rows($rs_ese);

$maxRows_rs_pub = 20;
$pageNum_rs_pub = 0;
if (isset($_GET['pageNum_rs_pub'])) {
  $pageNum_rs_pub = $_GET['pageNum_rs_pub'];
}
$startRow_rs_pub = $pageNum_rs_pub * $maxRows_rs_pub;

mysql_select_db($database_annuaire, $annuaire);
$query_rs_pub = "SELECT * FROM pub ORDER BY Id DESC";
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

<h3><span style="color: #090; font-size:14px;"><b>AJOUTER UNE PUB</b></span></h3>
<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Image</b></td>
      <td><input type="file" name="userfile" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Entreprise</b></td>
      <td><select name="Id_ese">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_ese['Id_ese']?>" <?php if (!(strcmp($row_rs_ese['Id_ese'], $row_rs_ese['sigle']))) {echo "SELECTED";} ?>><?php echo $row_rs_ese['sigle']?></option>
        <?php
} while ($row_rs_ese = mysql_fetch_assoc($rs_ese));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><br />
       <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
       <input type="submit" value="Valider" name="img_up" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="date" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($rs_ese);

mysql_free_result($rs_pub);
?>
<h3><span style="color: #090; font-size:14px;"><b>LA LSITE DES PUB PUBLIEES</b></span></h3>
<table width="100%" border="1">
  <tr>
    <td align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF;"><b>Image</b></span></td>
    <td align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF;"><b>Date</b></span></td>
    <td align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF;"><b>Modifier</b></span></td>
    <td align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF;"><b>Supprimer</b></span></td>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center" valign="middle"><img src="../<?php echo $row_rs_pub['image']; ?>"  width="100" height="75"/></td>
      <td align="center" valign="middle"><b><?php echo gestionDate::formatDate($row_rs_pub['date'],'fr'); ?></b></td>
      <td align="center" valign="middle"><a href="index.php?page=mod_pub_ese&id=<?php echo $row_rs_pub['Id']; ?>"><b>Modifier</b></a></td>
      <td align="center" valign="middle"><a href="index.php?page=sup_pub_ese&id=<?php echo $row_rs_pub['Id']; ?>"><b>Supprimer</b></a></td>
    </tr>
    <?php } while ($row_rs_pub = mysql_fetch_assoc($rs_pub)); ?>
</table>
