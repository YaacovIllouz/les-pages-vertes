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
                GLOBAL $maxRows_rs_ese,$totalRows_rs_ese;
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
					if ($_get_name != "pageNum_rs_ese") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $pageNum_Recordset1+1;
			$precedente = $pageNum_Recordset1-1;
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_ese=$precedente$_get_vars\">$prev_Recordset1</a>" :  "$prev_Recordset1";
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_rs_ese) + 1;
					$max_l = ($a*$maxRows_rs_ese >= $totalRows_rs_ese) ? $totalRows_rs_ese : ($a*$maxRows_rs_ese);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_ese=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "$textLink"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_ese=$successivo$_get_vars\">$next_Recordset1</a>" : "$next_Recordset1";
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}

$maxRows_rs_ese = 15;
$pageNum_rs_ese = 0;
if (isset($_GET['pageNum_rs_ese'])) {
  $pageNum_rs_ese = $_GET['pageNum_rs_ese'];
}
$startRow_rs_ese = $pageNum_rs_ese * $maxRows_rs_ese;

	$colname_rs_ese = 0;

mysql_select_db($database_annuaire, $annuaire);
$query_rs_ese = sprintf("SELECT * FROM entreprise WHERE Id_sous_rubrique = %s ORDER BY sigle ASC", GetSQLValueString($colname_rs_ese, "int"));
$query_limit_rs_ese = sprintf("%s LIMIT %d, %d", $query_rs_ese, $startRow_rs_ese, $maxRows_rs_ese);
$rs_ese = mysql_query($query_limit_rs_ese, $annuaire) or die(mysql_error());
$row_rs_ese = mysql_fetch_assoc($rs_ese);

if (isset($_GET['totalRows_rs_ese'])) {
  $totalRows_rs_ese = $_GET['totalRows_rs_ese'];
} else {
  $all_rs_ese = mysql_query($query_rs_ese);
  $totalRows_rs_ese = mysql_num_rows($all_rs_ese);
}
$totalPages_rs_ese = ceil($totalRows_rs_ese/$maxRows_rs_ese)-1;
?>
<article class="module width_full">
    <header>
        <h3><b>La liste des entreprises </b></h3>        
    </header>
    <div class="module_content"> 
        <table class="tablesorter" cellspacing="0"> 
   <tr>
      <td width="70" align="center" valign="middle" bgcolor="#cae2ab"><b>Logo</b></td>
      <td width="99" align="center" valign="middle" bgcolor="#cae2ab"><b>Sigle</b></td>
      <td width="224" align="center" valign="middle" bgcolor="#cae2ab"><b>Entreprise</b></td>
      <td width="110" align="center" valign="middle" bgcolor="#cae2ab"><b>Catégorie</b></td>
      <td width="113" align="center" valign="middle" bgcolor="#cae2ab"><b>Rubrique</b></td>
      <td width="143" align="center" valign="middle" bgcolor="#cae2ab"><b>Ajouter agence</b></td>
      <td width="113" align="center" valign="middle" bgcolor="#cae2ab"><b>Ajouter une pub</b></td>
      <td width="143" align="center" valign="middle" bgcolor="#cae2ab"><b>Modifier le logo</b></td>
      <td width="50" align="center" valign="middle" bgcolor="#cae2ab"><b>Modif</b></td>
      <td width="40" align="center" valign="middle" bgcolor="#cae2ab"><b>Supp</b></td>
   </tr>
  <?php do { ?>
    <tr bgcolor="#F0F0F0">
      <td align="center" valign="middle" bgcolor="#E7E7E7"><img src="../<?php echo $row_rs_ese['image']; ?>"  width="75" height="50"/></td>
      <td><span style="padding:5px;"><b><?php echo $row_rs_ese['sigle']; ?></b></span></td>
      <td><span style="padding:5px;"><b><?php echo $row_rs_ese['entreprise']; ?></b></span></td>
      <td><b><?php 
       mysql_select_db($database_annuaire, $annuaire);
       $req = "SELECT * FROM rubrique WHERE Id = '".$row_rs_ese['Id_rubrique']."'";
	   $res= mysql_query($req);
	   $row= mysql_fetch_assoc($res);
	   echo $row['rubrique'];
      ?></b></td>
      <td align="center" bgcolor="#F0F0F0">
       <b><?php 
       mysql_select_db($database_annuaire, $annuaire);
       $req = "SELECT * FROM sous_rubrique WHERE Id = '".$row_rs_ese['Id_sous_rubrique']."'";
	   $res= mysql_query($req);
	   $row= mysql_fetch_assoc($res);
	   echo $row['rubrique'];
      ?></b>
      </td>
      <td align="center" valign="middle" bgcolor="#F0F0F0"><a href="index.php?page=ajout_agence&id=<?php echo $row_rs_ese['Id_ese']; ?>"><span style="color:#090;"><b>Ajouter une agence</b></span></a></td>
      
      
        <td align="center" valign="middle" bgcolor="#F0F0F0"><a href="index.php?page=ajout_pub2&id=<?php echo $row_rs_ese['Id_ese']; ?>"><span style="color:#090;"><b>Ajouter une pub</b></span></a></td>
      
        <td align="center" valign="middle"><a href="index.php?page=mod_logo&id=<?php echo $row_rs_ese['Id_ese']; ?>"><span style="color:#0c0;"><b>Modifier le logo</b></span></a></td>
      <td align="center" valign="middle" bgcolor="#F0F0F0"><a href="index.php?page=mod_ese&id=<?php echo $row_rs_ese['Id_ese']; ?>">Modifier</a></td>
      <td width="40" align="center" valign="middle" bgcolor="#F0F0F0"><a href="index.php?page=sup_ese&id=<?php echo $row_rs_ese['Id_ese']; ?>">Supprimeer</a></td>
    </tr>
    
     <?php if($row_rs_ese = mysql_fetch_assoc($rs_ese)) {?>
     
     
     
      <tr>
      <td align="center" valign="middle"><img src="../<?php echo $row_rs_ese['image']; ?>"  width="75" height="50"/></td>
      <td><span style="padding:5px;"><b><?php echo $row_rs_ese['sigle']; ?></b></span></td>
      <td><span style="padding:5px;"><b><?php echo $row_rs_ese['entreprise']; ?></b></span></td>
      <td><b><?php 
       mysql_select_db($database_annuaire, $annuaire);
       $req = "SELECT * FROM rubrique WHERE Id = '".$row_rs_ese['Id_rubrique']."'";
	   $res= mysql_query($req);
	   $row= mysql_fetch_assoc($res);
	   echo $row['rubrique'];
      ?></b></td>
      <td align="center">
       <b><?php 
       mysql_select_db($database_annuaire, $annuaire);
       $req = "SELECT * FROM sous_rubrique WHERE Id = '".$row_rs_ese['Id_sous_rubrique']."'";
	   $res= mysql_query($req);
	   $row= mysql_fetch_assoc($res);
	   echo $row['rubrique'];
      ?></b>
      </td>
      <td align="center" valign="middle"><a href="index.php?page=ajout_agence&id=<?php echo $row_rs_ese['Id_ese']; ?>"><span style="color:#0c0;"><b>Ajouter une agence</b></span></a></td>
      
     <td align="center" valign="middle"><a href="index.php?page=ajout_pub2&id=<?php echo $row_rs_ese['Id_ese']; ?>"><span style="color:#090;"><b>Ajouter une pub</b></span></a></td>
        
         <td align="center" valign="middle">
         <a href="index.php?page=mod_logo&id=<?php echo $row_rs_ese['Id_ese']; ?>"><span style="color:#0c0;"><b>Modifier le logo</b></span></a>
         </td>
      <td align="center" valign="middle"><a href="index.php?page=mod_ese&id=<?php echo $row_rs_ese['Id_ese']; ?>">Modifier</a></td>
      <td align="center" valign="middle"><a href="index.php?page=sup_ese&id=<?php echo $row_rs_ese['Id_ese']; ?>">Supprimer</a></td>
    </tr>
    
     <?php } ?>    
    
    <?php } while ($row_rs_ese = mysql_fetch_assoc($rs_ese)); ?>
</table>
<br />
<center>
<span style="color:#090;"><b>
<?php 
# variable declaration
$prev_rs_ese = "";
$next_rs_ese = "";
$separator = " ";
$max_links = 10;
$pages_navigation_rs_ese = buildNavigation($pageNum_rs_ese,$totalPages_rs_ese,$prev_rs_ese,$next_rs_ese,$separator,$max_links,true); 

print $pages_navigation_rs_ese[0]; 
?>
<?php print $pages_navigation_rs_ese[1]; ?> <?php print $pages_navigation_rs_ese[2]; ?>
</b>
</span>
</center>
<?php
mysql_free_result($rs_ese);
?>
    </div>
</article>


