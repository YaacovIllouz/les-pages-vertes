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
            $updateSQL = sprintf("UPDATE pub_site SET image=%s, `position`=%s, `fixe`=%s, `defilant`=%s, `etat`=%s WHERE Id=%s",
                       GetSQLValueString(substr($tableau['chemin'],3), "text"),
                       GetSQLValueString($_POST['position'], "text"),
					   GetSQLValueString($_POST['fixe'], "int"),
					   GetSQLValueString($_POST['slide'], "int"),
					   GetSQLValueString($_POST['statut'], "int"),
					   GetSQLValueString($_POST['Id'], "int")
					   					   
					   );

  //mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
echo '<br />Logo modifié';			
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
$colname_rs_mod_site = "-1";
if (isset($_GET['id'])) {
  $colname_rs_mod_site = $_GET['id'];
}
//mysql_select_db($database_annuaire, $annuaire);
$query_rs_mod_site = sprintf("SELECT * FROM pub_site WHERE Id = %s", GetSQLValueString($colname_rs_mod_site, "int"));
$rs_mod_site = mysql_query($query_rs_mod_site, $annuaire) or die(mysql_error());
$row_rs_mod_site = mysql_fetch_assoc($rs_mod_site);
$totalRows_rs_mod_site = mysql_num_rows($rs_mod_site);

?>
<h3>Modifier la pub</h3>
<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td width="30%" align="right" nowrap="nowrap"><b>Image :&nbsp;</b></td>
      <td width="70%"><input type="file" name="userfile"  value="<?php echo htmlentities($row_rs_mod_site['image'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>     
    <tr valign="baseline">
      
      <td nowrap="nowrap" align="right"><b>Position :&nbsp;</b></td>
      <td><select name="position">
        <option value="Milieu" <?php if (!(strcmp("Milieu", ""))) {echo "SELECTED";} ?>>Milieu</option>
        <option value="Gauche" <?php if (!(strcmp("Gauche", ""))) {echo "SELECTED";} ?>>Gauche</option>
        <option value="Entreprise" <?php if (!(strcmp("Entreprise", ""))) {echo "SELECTED";} ?>>Entreprise</option>
        <option value="Bas" <?php if (!(strcmp("Bas", ""))) {echo "SELECTED";} ?>>Bas</option>
        <option value="Contact" <?php if (!(strcmp("Contact", ""))) {echo "SELECTED";} ?>>Contact</option>
        <option value="Référencement" <?php if (!(strcmp("Référencement", ""))) {echo "SELECTED";} ?>>Référencement</option>
        <option value="Recherche" <?php if (!(strcmp("Recherche", ""))) {echo "SELECTED";} ?>>Recherche</option>
        <option value="Annonce" <?php if (!(strcmp("Annonce", ""))) {echo "SELECTED";} ?>>Annonce</option>
      </select></td>
    </tr> 
   <tr><td colspan="2">&nbsp;</td></tr>     
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
       <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
       <input type="submit" value="Valider" name="img_up" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="Id" value="<?php echo $row_rs_mod_site['Id']; ?>" />
</form>
<p>&nbsp;</p>
<div align="center">
<table width="400" border="0">
  <tr>
    <td><img src="<?php echo '../'.$row_rs_mod_site['image'];?>" alt="Image actuelle" /></td>
  </tr>
</table>

</div>
<?php
mysql_free_result($rs_mod_site);
?>
