<?php 
	require_once('../Connections/annuaire.php'); 
	require_once('../classe/image.php');
    require_once('../classe/dat.php');
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_rs_pub = 10;
$pageNum_rs_pub = 0;
if (isset($_GET['pageNum_rs_pub'])) {
  $pageNum_rs_pub = $_GET['pageNum_rs_pub'];
}
$startRow_rs_pub = $pageNum_rs_pub * $maxRows_rs_pub;

mysql_select_db($database_annuaire, $annuaire);
$query_rs_pub = "SELECT * FROM pub_site ORDER BY Id DESC";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$maintenant = time();
if (isset($_POST['img_up']))
{
     $Upload = new uploadImage(512,700,700,80,80,'../userfiles/image/');
     $Upload->SetExtension(".jpg;.jpeg;.gif;.png");
     $Upload->SetMimeType("image/jpg;image/gif;image/png");

     $msg = '';
     if($Upload->CheckUpload())
     {
		if($Upload->WriteFile())
		{
	   		$msg = "<p>image chargée avec succès</p>";
	        $tableau = $Upload->GetSummary();
            $insertSQL = sprintf("INSERT INTO pub_site (images, `date`, `position`) VALUES (%s, %s, %s)",
                       GetSQLValueString(substr($tableau['chemin'],3), "text"),
                       GetSQLValueString($maintenant, "text"),
                       GetSQLValueString($_POST['position'], "text"));

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
?>
<h3><b>Ajouter une publicité</b></h3>
<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Images:</td>
      <td><input type="file" name="userfile" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Position:</td>
      <td><select name="position">
        <option value="Milieu" <?php if (!(strcmp("Milieu", ""))) {echo "SELECTED";} ?>>Milieu</option>
        <option value="Gauche" <?php if (!(strcmp("Gauche", ""))) {echo "SELECTED";} ?>>Gauche</option>
        <option value="Entreprise" <?php if (!(strcmp("Entreprise", ""))) {echo "SELECTED";} ?>>Entreprise</option>
      </select></td>
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
  <input type="hidden" name="date" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<h3><b>Listes des pub ajoutées</b></h3>
<table width="566" border="1">
  <tr>
    <td width="65" align="center" valign="middle" bgcolor="#009900"><b style="color:#000">Images</b></td>
    <td width="148" align="center" valign="middle" bgcolor="#009900"><b style="color:#000">Date</b></td>
    <td width="175" align="center" valign="middle" bgcolor="#009900"><b style="color:#000">Position</b></td>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center" valign="middle" bgcolor="#cae2ab"><img src="<?php echo $row_rs_pub['images']; ?>" class="img-responsive" /></td>
      <td align="center" bgcolor="#cae2ab"><span style="color:#000;"><?php echo gestionDate::formatDate($row_rs_pub['date'],'fr'); ?></span></td>
      <td align="center" bgcolor="#cae2ab"><span style="color:#000;"><?php echo $row_rs_pub['position']; ?></span></td>
      <td width="67" align="center" bgcolor="#cae2ab"><a href="index.php?page=mod_pub_accueil&id=<?php echo $row_rs_pub['Id']; ?>"><b style="color:#000;">Modifier</b></a></td>
      <td width="77" align="center" bgcolor="#cae2ab"><a href="index.php?page=sup_accueil&id=<?php echo $row_rs_pub['Id']; ?>"><b style="color:#000;">Supprimer</b></a></td>
    </tr>
    <?php } while ($row_rs_pub = mysql_fetch_assoc($rs_pub)); ?>
</table>
<?php
mysql_free_result($rs_pub);
?>
