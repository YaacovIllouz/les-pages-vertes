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
            $insertSQL = sprintf("INSERT INTO pub2 (images, `date`, Id_sr) VALUES (%s, %s, %s)",
                       GetSQLValueString(substr($tableau['chemin'],3), "text"),
                       GetSQLValueString($maintenant, "text"),
                       GetSQLValueString($_POST['Id_sr'], "int"));

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
$colname_rs_sr = "-1";
if (isset($_GET['id'])) {
  $colname_rs_sr = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_sr = sprintf("SELECT * FROM sous_rubrique WHERE Id = %s", GetSQLValueString($colname_rs_sr, "int"));
$rs_sr = mysql_query($query_rs_sr, $annuaire) or die(mysql_error());
$row_rs_sr = mysql_fetch_assoc($rs_sr);
$totalRows_rs_sr = mysql_num_rows($rs_sr);

$maxRows_rs_pub = 10;
$pageNum_rs_pub = 0;
if (isset($_GET['pageNum_rs_pub'])) {
  $pageNum_rs_pub = $_GET['pageNum_rs_pub'];
}
$startRow_rs_pub = $pageNum_rs_pub * $maxRows_rs_pub;

mysql_select_db($database_annuaire, $annuaire);
$query_rs_pub = "SELECT * FROM pub2 ORDER BY Id ASC";
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
<h3>AJOUTER UNE PUB POUR <span style="color:#090; font-size:14px;"><b><?php echo $row_rs_sr['rubrique']; ?></b></span></h3>
<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Images:</td>
      <td><input type="file" name="userfile" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>
      <br>
       <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
       <input type="submit" value="Valider" name="img_up" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="date" value="">
  <input type="hidden" name="Id_sr" value="<?php echo $row_rs_sr['Id']; ?>">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><a href="javascript:history.back()">Retour</a></p>


<br />

</b>
</span>
</center>