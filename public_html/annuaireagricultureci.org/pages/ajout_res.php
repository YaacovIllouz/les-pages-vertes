<?php require_once('Connections/annuaire.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO dirigeant (nom, fonction, Id_ese) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['nom'], "text"),
                       GetSQLValueString($_POST['fonction'], "text"),
                       GetSQLValueString($_POST['Id_ese'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
  echo 'Responsable ajouté avec succès';
}

$colname_rs_ese = "-1";
if (isset($_GET['id'])) {
  $colname_rs_ese = $_GET['id'];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_ese = sprintf("SELECT * FROM entreprise WHERE entreprise = %s", GetSQLValueString($colname_rs_ese, "text"));
$rs_ese = mysql_query($query_rs_ese, $annuaire) or die(mysql_error());
$row_rs_ese = mysql_fetch_assoc($rs_ese);
$totalRows_rs_ese = mysql_num_rows($rs_ese);

mysql_free_result($rs_ese);
?>

<br />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<div class="container">
<div class="row">
	<div class="col-md-3">
       <div class="pub_gauche"></div><!--pub_gauche-->
    </div><!--col-md-3"-->
    
    <div class="col-md-6">
     <div class="titre_droit">REFERENCEMENT GRATUIT</div>
     <!--search-->
     <div class="box" style="padding:5px;">
     <h5>Ajouter un responsable</h5>
     <br />
     <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
       <table align="center">
         <tr valign="baseline">
           <td nowrap align="right">Nom:</td>
           <td><input type="text" name="nom" value="" size="32"></td>
         </tr>
         <tr valign="baseline">
           <td nowrap align="right">Fonction:</td>
           <td><input type="text" name="fonction" value="" size="32"></td>
         </tr>
         <tr valign="baseline">
           <td nowrap align="right">&nbsp;</td>
           <td><input type="submit" value="Insérer un enregistrement"></td>
         </tr>
       </table>
       <input type="hidden" name="Id_ese" value="<?php echo $row_rs_ese['Id_ese']; ?>">
       <input type="hidden" name="MM_insert" value="form1">
     </form>
     <p>&nbsp;</p>
     <p><a>Retour</a></p>
     </div>
     <!--box-->
    </div><!--col-md-6"-->
  
    <div class="col-md-3">
     <?php include('./pages/menu_droit.php'); ?>
    </div><!--col-md-3"-->
</div><!--row-->
</div><!--container-->
<br />
