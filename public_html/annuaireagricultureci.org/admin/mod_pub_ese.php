<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_POST['img_up']))
{
     $Upload = new uploadImage(512,1500,1500,80,80,'../userfiles/image/');
     $Upload->SetExtension(".jpg;.jpeg;.gif;.png");
     $Upload->SetMimeType("image/jpg;image/gif;image/png");

     $msg = '';
     if($Upload->CheckUpload())
     {
		if($Upload->WriteFile())
		{
	   		$msg = "<p>image chargée avec succès</p>";
	        $tableau = $Upload->GetSummary();
            $updateSQL = sprintf("UPDATE pub SET image=%s WHERE Id=%s",
                       GetSQLValueString(substr($tableau['chemin'],3), "text"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
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
$colname_rs_mod_pub = "-1";
if (isset($_GET['id'])) {
  $colname_rs_mod_pub = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_mod_pub = sprintf("SELECT * FROM pub WHERE Id = %s", GetSQLValueString($colname_rs_mod_pub, "int"));
$rs_mod_pub = mysql_query($query_rs_mod_pub, $annuaire) or die(mysql_error());
$row_rs_mod_pub = mysql_fetch_assoc($rs_mod_pub);
$totalRows_rs_mod_pub = mysql_num_rows($rs_mod_pub);
?>
<h3>Modifier la pub</h3>
<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Image:</td>
      <td>
        <input type="file" name="userfile" value="<?php echo htmlentities($row_rs_mod_pub['image'], ENT_COMPAT, ''); ?>" size="32" />
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
       <br />
       <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
       <input type="submit" value="Valider" name="img_up" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="Id" value="<?php echo $row_rs_mod_pub['Id']; ?>" />
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($rs_mod_pub);
?>
<p><a href="javascript:history.back()">Retour</a></p>
