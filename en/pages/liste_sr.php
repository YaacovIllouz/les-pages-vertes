<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_Recordset1,$totalPages_Recordset1,$prev_Recordset1,$next_Recordset1,$separator=" | ",$max_links=10, $show_page=true)
{
                GLOBAL $maxRows_rs_liste_sr,$totalRows_rs_liste_sr;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_Recordset1<=$totalPages_Recordset1 && $pageNum_Recordset1>=0)
	{
		if ($pageNum_Recordset1 > ceil($max_links/2))
		{
			$fgp = $pageNum_Recordset1 - ceil($max_links/2) > 0 ? $pageNum_Recordset1 - ceil($max_links/2) : 1;
			$egp = $pageNum_Recordset1 + ceil($max_links/2);
			if ($egp >= $totalPages_Recordset1)
			{
				$egp = $totalPages_Recordset1+1;
				$fgp = $totalPages_Recordset1 - ($max_links-1) > 0 ? $totalPages_Recordset1  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_Recordset1 >= $max_links ? $max_links : $totalPages_Recordset1+1;
		}
		if($totalPages_Recordset1 >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_rs_liste_sr") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $pageNum_Recordset1+1;
			$precedente = $pageNum_Recordset1-1;
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_liste_sr=$precedente$_get_vars\">$prev_Recordset1</a>" :  "$prev_Recordset1";
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_rs_liste_sr) + 1;
					$max_l = ($a*$maxRows_rs_liste_sr >= $totalRows_rs_liste_sr) ? $totalRows_rs_liste_sr : ($a*$maxRows_rs_liste_sr);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_liste_sr=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "$textLink"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_liste_sr=$successivo$_get_vars\">$next_Recordset1</a>" : "$next_Recordset1";
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}
?>
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

$maxRows_rs_liste_sr = 20;
$pageNum_rs_liste_sr = 0;
if (isset($_GET['pageNum_rs_liste_sr'])) {
  $pageNum_rs_liste_sr = $_GET['pageNum_rs_liste_sr'];
}
$startRow_rs_liste_sr = $pageNum_rs_liste_sr * $maxRows_rs_liste_sr;

mysql_select_db($database_annuaire, $annuaire);
$query_rs_liste_sr = "SELECT Id, rubrique FROM sous_rubrique ORDER BY rubrique ASC";
$query_limit_rs_liste_sr = sprintf("%s LIMIT %d, %d", $query_rs_liste_sr, $startRow_rs_liste_sr, $maxRows_rs_liste_sr);
$rs_liste_sr = mysql_query($query_limit_rs_liste_sr, $annuaire) or die(mysql_error());
$row_rs_liste_sr = mysql_fetch_assoc($rs_liste_sr);

if (isset($_GET['totalRows_rs_liste_sr'])) {
  $totalRows_rs_liste_sr = $_GET['totalRows_rs_liste_sr'];
} else {
  $all_rs_liste_sr = mysql_query($query_rs_liste_sr);
  $totalRows_rs_liste_sr = mysql_num_rows($all_rs_liste_sr);
}
$totalPages_rs_liste_sr = ceil($totalRows_rs_liste_sr/$maxRows_rs_liste_sr)-1;
?>
<h3>LISTE DES SOUS RUBRIQUES</h3>
<table width="425" align="center">
  <tr>
    <td align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF; font-size:14px;"><b>Les sous-rubriques</b></span></td>
    <td align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF; font-size:14px;"><b>Modification</b></span></td>
    <td align="center" valign="middle" bgcolor="#009900"><span style="color:#FFF; font-size:14px;"><b>Sppression</b></span></td>
  </tr>
  <?php do { ?>
    <tr>
      <td align="left" valign="middle" bgcolor="#99CC66"><b><?php echo $row_rs_liste_sr['rubrique']; ?></b></td>
      <td align="center" valign="middle" bgcolor="#99CC66"><a href="index.php?page=mod_sr&id=<?php echo $row_rs_liste_sr['Id']; ?>"><b>Modifier</b></a></td>
      <td align="center" valign="middle" bgcolor="#99CC66"><a href="index.php?page=sup_sr&id=<?php echo $row_rs_liste_sr['Id']; ?>"><b>Supprimer</b></a></td>
    </tr>
    <?php } while ($row_rs_liste_sr = mysql_fetch_assoc($rs_liste_sr)); ?>
</table>

<p><center>
  <?php 
# variable declaration
$prev_rs_liste_sr = "";
$next_rs_liste_sr = "";
$separator = " | ";
$max_links = 10;
$pages_navigation_rs_liste_sr = buildNavigation($pageNum_rs_liste_sr,$totalPages_rs_liste_sr,$prev_rs_liste_sr,$next_rs_liste_sr,$separator,$max_links,true); 

print $pages_navigation_rs_liste_sr[0]; 
?>
  <?php print $pages_navigation_rs_liste_sr[1]; ?> <?php print $pages_navigation_rs_liste_sr[2]; ?>
</center></p>
<?php
mysql_free_result($rs_liste_sr);
?>
