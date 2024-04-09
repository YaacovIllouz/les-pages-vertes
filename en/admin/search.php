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
                GLOBAL $maxRows_rs_r_ese,$totalRows_rs_r_ese;
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
					if ($_get_name != "pageNum_rs_r_ese") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $pageNum_Recordset1+1;
			$precedente = $pageNum_Recordset1-1;
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_r_ese=$precedente$_get_vars\">$prev_Recordset1</a>" :  "$prev_Recordset1";
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_rs_r_ese) + 1;
					$max_l = ($a*$maxRows_rs_r_ese >= $totalRows_rs_r_ese) ? $totalRows_rs_r_ese : ($a*$maxRows_rs_r_ese);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_r_ese=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "$textLink"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_r_ese=$successivo$_get_vars\">$next_Recordset1</a>" : "$next_Recordset1";
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}


if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
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

$maxRows_rs_r_ese = 15;
$pageNum_rs_r_ese = 0;
if (isset($_GET['pageNum_rs_r_ese'])) {
  $pageNum_rs_r_ese = $_GET['pageNum_rs_r_ese'];
}
$startRow_rs_r_ese = $pageNum_rs_r_ese * $maxRows_rs_r_ese;

$colname_rs_r_ese = "-1";
if(isset($_POST['recherche'])) {
	$param = explode(' : ', $_POST['recherche']);
  $colname_rs_r_ese = $param[0];
}
mysql_select_db($database_annuaire, $annuaire);
$query_rs_r_ese = sprintf("SELECT * FROM entreprise WHERE sigle LIKE %s ORDER BY sigle ASC", GetSQLValueString("%" . $colname_rs_r_ese . "%", "text"));
$query_limit_rs_r_ese = sprintf("%s LIMIT %d, %d", $query_rs_r_ese, $startRow_rs_r_ese, $maxRows_rs_r_ese);
$rs_r_ese = mysql_query($query_limit_rs_r_ese, $annuaire) or die(mysql_error());
$row_rs_r_ese = mysql_fetch_assoc($rs_r_ese);

if (isset($_GET['totalRows_rs_r_ese'])) {
  $totalRows_rs_r_ese = $_GET['totalRows_rs_r_ese'];
} else {
  $all_rs_r_ese = mysql_query($query_rs_r_ese);
  $totalRows_rs_r_ese = mysql_num_rows($all_rs_r_ese);
}
$totalPages_rs_r_ese = ceil($totalRows_rs_r_ese/$maxRows_rs_r_ese)-1;
?>
<style>
	a{color: #090;}
</style>
<article class="module width_full">
	<header>
		<h3><b>Résultat de la recherche </b> : <b style="color:#090;"><?= $_POST['recherche']; ?></b></h3>
	</header>
	<div class="module_content">
   		<b>Résultat</b> <b style="color:#090;"><?php echo $totalRows_rs_r_ese; ?></b> entreprise(s) trouvée(s)<br /><br />
		<table class="tablesorter" cellspacing="0">
		<?php
		if($totalRows_rs_r_ese >0) {
			do { ?>
				<tr>
					<td align="center" valign="middle">
						<img src="../<?php echo $row_rs_r_ese['image']; ?>" width="75" height="75"/>
					</td>
					<td><b><?php echo $row_rs_r_ese['sigle']; ?></b></td>
					<td><b><?php echo $row_rs_r_ese['entreprise']; ?></b></td>
					<td><b><?php
							$req = "SELECT * FROM rubrique WHERE Id = '" . $row_rs_r_ese['Id_rubrique'] . "'";
							$res = mysql_query($req);
							$row = mysql_fetch_assoc($res);
							echo $row['rubrique'];
							?></b></td>
					<td align="center">
						<b><?php
							$req = "SELECT * FROM sous_rubrique WHERE Id = '" . $row_rs_r_ese['Id_sous_rubrique'] . "'";
							$res = mysql_query($req);
							$row = mysql_fetch_assoc($res);
							echo $row['rubrique'];
							?></b>
					</td>
					<td align="center" valign="middle"><a
							href="index.php?page=ajout_pub2&id=<?php echo $row_rs_r_ese['Id_ese']; ?>"><span
								style="color:#090;"><b>Ajouter une pub</b></span></a></td>

					<td align="center" valign="middle"><a
							href="index.php?page=ajout_agence&id=<?php echo $row_rs_r_ese['Id_ese']; ?>"
							style="color:#090;"><b>Ajouter une
								agence</b></a></td>
					<td align="center" valign="middle"><a
							href="index.php?page=mod_logo&id=<?php echo $row_rs_r_ese['Id_ese']; ?>" style="color:#090;"><b>Modifier le
								logo</b></a></td>
					<td><a href="index.php?page=mod_ese&id=<?php echo $row_rs_r_ese['Id_ese']; ?>">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
					<td><a href="index.php?page=sup_ese&id=<?php echo $row_rs_r_ese['Id_ese']; ?>">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
				</tr>
				<?php
			} while ($row_rs_r_ese = mysql_fetch_assoc($rs_r_ese));
		}else{
			echo '<tr><td><h1 style="text-align: center"><b>AUCUN RESULTAT TROUVE</b></h1></td></tr>';
		}
		?>
</table>
<?php 
# variable declaration
$prev_rs_r_ese = "";
$next_rs_r_ese = "";
$separator = " ";
$max_links = 15;
$pages_navigation_rs_r_ese = buildNavigation($pageNum_rs_r_ese,$totalPages_rs_r_ese,$prev_rs_r_ese,$next_rs_r_ese,$separator,$max_links,true); 

print $pages_navigation_rs_r_ese[0]; 
?>
<?php print $pages_navigation_rs_r_ese[1]; ?> <?php print $pages_navigation_rs_r_ese[2]; ?>

<div class="clear"></div>
</div>
</article>