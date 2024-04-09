<?php require_once('../Connections/annuaire.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE entreprise SET sigle=%s, entreprise=%s, image=%s, tel1=%s, tel2=%s, cel1=%s, fax=%s, certification=%s, marque=%s, membre=%s, email=%s, web=%s, bp=%s, geoloclaisation=%s, dirigeant=%s, activite=%s, Id_rubrique=%s, Id_sous_rubrique=%s WHERE Id_ese=%s",
                       GetSQLValueString($_POST['sigle'], "text"),
                       GetSQLValueString($_POST['entreprise'], "text"),
                       GetSQLValueString($_POST['image'], "text"),
                       GetSQLValueString($_POST['tel1'], "text"),
                       GetSQLValueString($_POST['tel2'], "text"),
                       GetSQLValueString($_POST['cel1'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['certification'], "text"),
                       GetSQLValueString($_POST['marque'], "text"),
                       GetSQLValueString($_POST['membre'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['web'], "text"),
                       GetSQLValueString($_POST['bp'], "text"),
                       GetSQLValueString($_POST['geoloclaisation'], "text"),
                       GetSQLValueString($_POST['dirigeant'], "text"),
                       GetSQLValueString($_POST['activite'], "text"),
                       GetSQLValueString($_POST['Id_rubrique'], "int"),
                       GetSQLValueString($_POST['Id_sous_rubrique'], "int"),
                       GetSQLValueString($_POST['Id_ese'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($updateSQL, $annuaire) or die(mysql_error());
  echo 'Entreprise modifiée avec succès';
}

$colname_rs_mod_ese = "-1";
if (isset($_GET['id'])) {
  $colname_rs_mod_ese = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_mod_ese = sprintf("SELECT Id_ese, sigle, entreprise, image, tel1, tel2, cel1, fax, certification, marque, membre, email, web, bp, geoloclaisation, dirigeant, activite, Id_rubrique, Id_sous_rubrique FROM entreprise WHERE Id_ese = %s", GetSQLValueString($colname_rs_mod_ese, "int"));
$rs_mod_ese = mysql_query($query_rs_mod_ese, $annuaire) or die(mysql_error());
$row_rs_mod_ese = mysql_fetch_assoc($rs_mod_ese);
$totalRows_rs_mod_ese = mysql_num_rows($rs_mod_ese);
?>
<h3>MODIFIER LES INFORMATIONS SUR l'ENTREPRISE <?php echo $row_rs_mod_ese['entreprise']; ?></h3>
<br />
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sigle:</td>
      <td><input type="text" name="sigle" value="<?php echo htmlentities($row_rs_mod_ese['sigle'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Entreprise:</td>
      <td><input type="text" name="entreprise" value="<?php echo htmlentities($row_rs_mod_ese['entreprise'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Logo:</td>
      <td><img src="../<?php echo $row_rs_mod_ese['image']; ?>" width="100" height="75" /></td>
      <td><input type="file" name="image" value="<?php echo htmlentities($row_rs_mod_ese['image'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tel1:</td>
      <td><input type="text" name="tel1" value="<?php echo htmlentities($row_rs_mod_ese['tel1'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tel2:</td>
      <td><input type="text" name="tel2" value="<?php echo htmlentities($row_rs_mod_ese['tel2'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cel1:</td>
      <td><input type="text" name="cel1" value="<?php echo htmlentities($row_rs_mod_ese['cel1'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fax:</td>
      <td><input type="text" name="fax" value="<?php echo htmlentities($row_rs_mod_ese['fax'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Certification:</td>
      <td><input type="text" name="certification" value="<?php echo htmlentities($row_rs_mod_ese['certification'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Marque:</td>
      <td><input type="text" name="marque" value="<?php echo htmlentities($row_rs_mod_ese['marque'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Membre:</td>
      <td><input type="text" name="membre" value="<?php echo htmlentities($row_rs_mod_ese['membre'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_rs_mod_ese['email'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Web:</td>
      <td><input type="text" name="web" value="<?php echo htmlentities($row_rs_mod_ese['web'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Bp:</td>
      <td><input type="text" name="bp" value="<?php echo htmlentities($row_rs_mod_ese['bp'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Geoloclaisation:</td>
      <td><input type="text" name="geoloclaisation" value="<?php echo htmlentities($row_rs_mod_ese['geoloclaisation'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Dirigeant:</td>
      <td><textarea name="dirigeant" cols="50" rows="5"><?php echo htmlentities($row_rs_mod_ese['dirigeant'], ENT_COMPAT, ''); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Activite:</td>
      <td><textarea name="activite" cols="50" rows="5"><?php echo htmlentities($row_rs_mod_ese['activite'], ENT_COMPAT, ''); ?></textarea></td>
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
      <br />
      <input type="submit" value="Modifier" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="Id_ese" value="<?php echo $row_rs_mod_ese['Id_ese']; ?>" />
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($rs_mod_ese);
?>

<script type="text/javascript" src="../js/ajax.js"></script>