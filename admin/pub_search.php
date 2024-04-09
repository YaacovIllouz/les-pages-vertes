<article class="module width_full">
    <header>
        <h3><b>AJOUTER UNE PUBLICITE</b></h3>
    </header>
    <div class="module_content">
        <?php
        $msg = '';
        if(isset($_GET['del']) && !empty($_GET['del'])){
            $par = $db->query("SELECT * FROM pub_site WHERE Id=".$_GET['del'])->fetch();
            if($par){
                if(file_exists('../userfiles/image/'.$par['image'])){
                    unlink('../userfiles/image/'.$par['image']);
                }
                $del = $db->query("DELETE FROM pub_site WHERE Id=".$_GET['del']);
                if($del){
                    $msg .= "PUBLICITE SUPPRIMEE AVEC SUCCES";
                }
            }

        }
//post du formulaire
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$maintenant = time();
if (isset($_POST['img_up'])) {
     $Upload = new uploadImage(512,1500,1500,80,80,'../userfiles/image/');
     $Upload->SetExtension(".jpg;.jpeg;.gif;.png");
     $Upload->SetMimeType("image/jpg;image/gif;image/png");


     if($Upload->CheckUpload()) {
		if($Upload->WriteFile()) {
	   		$msg .= "<p>image chargée avec succès</p>";
	        $tableau = $Upload->GetSummary();
            $insertSQL = sprintf("INSERT INTO pub_site (image, date, position) VALUES (%s, %s, %s)",
                       GetSQLValueString(substr($tableau['chemin'],3), "text"),
                       GetSQLValueString($maintenant, "date"),
                       GetSQLValueString('Search', "text"));

            $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
            $msg .= 'Publicité ajoutée avec succès';
		}
		else {
	    	$msg = "<p>Echec 2 du transfert de l'image sur le serveur.</p>";
			$tableau = $Upload-> GetError();
			foreach ($tableau as $valeur)
			{
	        	$msg .= $valeur."<br />";
			}
		}
     }
     else{
	    $msg = "<p>Echec 1 du transfert de l'image sur le serveur.</p>";
        $tableau = $Upload-> GetError();
		foreach ($tableau as $valeur) {
	        $msg .= $valeur."<br />";
		}
     }
}

//select all partenaire
$maxRows_rs_pub = 20;
$pageNum_rs_pub = 0;
if (isset($_GET['pageNum_rs_pub'])) {
  $pageNum_rs_pub = $_GET['pageNum_rs_pub'];
}
$startRow_rs_pub = $pageNum_rs_pub * $maxRows_rs_pub;

$query_rs_pub = "SELECT * FROM pub_site WHERE position='Search'";
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

        //affichage du messaage
        if(!empty($msg)){
            echo '<h3 style="text-align: center; color:#090;">'.$msg.'</h3><hr/>';
        }
?>

<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
    <table align="center" style="width: 800px;">
        <tr valign="baseline">
              <td align="left" valign="middle" nowrap="nowrap"><b>Image [Taille max: 1200 x 270]</b></td>
              <td><input type="file" name="userfile" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
              <td nowrap="nowrap" align="right">&nbsp;</td>
              <td><br />
               <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
               <input type="submit" value="Ajouter la publicit&eacute;" name="img_up" class="alt_btn" />
              </td>
        </tr>
  </table>
  <input type="hidden" name="date" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p><br/></p><br/><br/>
<?php if($totalRows_rs_pub >0){ ?>
        <table width="100%" class="tablesorter" cellspacing="0">
            <thead>
            <tr>
                <th colspan="4" align="center"><h3><span style="color: #090; font-size:14px;">
                    <b>LA LISTE DES PUB RECHERCHE ACCUEIL</b></span></h3>
                </th>
            </tr>
          <tr>
            <th align="center" valign="middle"><b>Image</b></span></th>
            <th align="center" valign="middle"><b>Action</b></span></th>
          </tr>
            </thead>
            <tbody>
          <?php do { ?>
            <tr>
              <td align="center" valign="middle">
                  <img src="../<?php echo $row_rs_pub['image']; ?>"  width="900" height="100"/></td>
              <td align="center" valign="middle">
                  <a href="index.php?page=pub_search&del=<?php echo $row_rs_pub['Id']; ?>"><b>Supprimer</b></a></td>
            </tr>
            <?php } while ($row_rs_pub = mysql_fetch_assoc($rs_pub)); ?>
            </tbody>
        </table>
<?php } ?>