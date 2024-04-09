<?php include_once("analyticstracking.php") ?>
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

  $insertSQL = sprintf("INSERT INTO entreprise (sigle, entreprise, image, `date`, tel1, tel2, cel1, cel2, fax, certification, marque, email, web, bp, geoloclaisation, dirigeant, activite, Id_rubrique, Id_sous_rubrique) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['sigle'], "text"),
					   GetSQLValueString($_POST['entreprise'], "text"),
                       GetSQLValueString(substr($tableau['chemin'],3), "text"),
                       GetSQLValueString($maintenant, "text"),
                       GetSQLValueString($_POST['tel1'], "text"),
                       GetSQLValueString($_POST['tel2'], "text"),
                       GetSQLValueString($_POST['cel1'], "text"),
                       GetSQLValueString($_POST['cel2'], "text"),
					   GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['certification'], "text"),
					   GetSQLValueString($_POST['marque'], "text"),   
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['web'], "text"),
                       GetSQLValueString($_POST['bp'], "text"),
					   GetSQLValueString($_POST['geoloclaisation'], "text"),
					   GetSQLValueString($_POST['dirigeant'], "text"),  
                       GetSQLValueString($_POST['activite'], "text"),
                       GetSQLValueString($_POST['Id_rubrique'], "int"),
                       GetSQLValueString($_POST['Id_sous_rubrique'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
echo '<br />Enregistrement Réussi.';			
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
<script src="ckeditor/ckeditor.js"></script>
<h3>Ajouter une entreprise</h3>
<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Sigle :</b></td>
      <td><input type="text" name="sigle" value="" size="32" /></td>
    </tr>
     <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Entreprise :</b></td>
      <td><input type="text" name="entreprise" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Logo :</b></td>
      <td><input type="file" name="userfile" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Téléphone 1 :</td>
      <td><input type="text" name="tel1" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Téléphone 2 :</b></td>
      <td><input type="text" name="tel2" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Cellulaire 1 :</b></td>
      <td><input type="text" name="cel1" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Cellulaire 2 :</b></td>
      <td><input type="text" name="cel2" value="" size="32" /></td>
    </tr>
        <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Fax :</td>
      <td><input type="text" name="fax" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Certification :</b></td>
      <td><input type="text" name="certification" value="" size="32" /></td>
    </tr>
     <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Marque :</b></td>
      <td><input type="text" name="marque" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>E-mail :</b></td>
      <td><input type="text" name="email" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Site web :</b></td>
      <td><input type="text" name="web" value="http://" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Boite postale :</b></td>
      <td><input type="text" name="bp" value="" size="32" /></td>
    </tr> 
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Situation géographique :</b></td>
      <td><input type="text" name="geoloclaisation" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Dirigeant :</b></td>
      <td><input type="text" name="dirigeant" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left" valign="middle"><b>Activite :</b></td>
      <td><textarea id="editor1" name="activite" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><strong>Catégorie :</strong></td>
      <td>
       <select id="regions" name="Id_rubrique">
            <option value="">-- Catégorie --</option>
       </select>
     </td>
    </tr>
    
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><strong>Rubrique :</strong></td>
      <td>
      <select id="departements" name="Id_sous_rubrique">
   			 <option value="">--Rubrique--</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
       <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
       <input type="submit" value="Valider" name="img_up" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="date" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>

<script type="text/javascript" src="../js/ajax.js"></script>

<script>
       // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor1' );
</script>