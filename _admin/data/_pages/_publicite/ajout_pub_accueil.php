<?php 
$maxRows_rs_all_pub = 50;
$pageNum_rs_all_pub = 0;
if (isset($_GET['pageNum_rs_all_pub'])) {
  $pageNum_rs_all_pub = $_GET['pageNum_rs_all_pub'];
}
$startRow_rs_all_pub = $pageNum_rs_all_pub * $maxRows_rs_all_pub;

mysql_select_db($database_annuaire, $annuaire);
$query_rs_all_pub = "SELECT * FROM pub_site WHERE position != 'Search' ORDER BY Id DESC";
$query_limit_rs_all_pub = sprintf("%s LIMIT %d, %d", $query_rs_all_pub, $startRow_rs_all_pub, $maxRows_rs_all_pub);
$rs_all_pub = mysql_query($query_limit_rs_all_pub, $annuaire) or die(mysql_error());
$row_rs_all_pub = mysql_fetch_assoc($rs_all_pub);

if (isset($_GET['totalRows_rs_all_pub'])) {
  $totalRows_rs_all_pub = $_GET['totalRows_rs_all_pub'];
} else {
  $all_rs_all_pub = mysql_query($query_rs_all_pub);
  $totalRows_rs_all_pub = mysql_num_rows($all_rs_all_pub);
}
$totalPages_rs_all_pub = ceil($totalRows_rs_all_pub/$maxRows_rs_all_pub)-1;

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$maintenant = time();
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
            $insertSQL = sprintf("INSERT INTO pub_site (image, `date`, `position`, `fixe`, `defilant`, `etat`) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(substr($tableau['chemin'],3), "text"),
                       GetSQLValueString($maintenant, "text"),
                       GetSQLValueString($_POST['position'], "text"),
					   GetSQLValueString($_POST['fixe'], "int"),
					   GetSQLValueString($_POST['slide'], "int"),
					   GetSQLValueString($_POST['statut'], "int")
					   );

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
<article class="module width_full">
    <header>
        <h3><b>Ajouter une pub sur la page d' accueil</b></h3>        
    </header>
    <div class="module_content"> 
        <form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
  <table align="center" style="width: 100%;">
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Image : </b></td>
      <td><input type="file" name="userfile" value="" size="32" style="width: 90%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
        <td style="width: 20%;" align="left" valign="middle" nowrap="nowrap"><b>Position : </b></td>
      <td style="width: 800%;"><select name="position" style="width:90%; padding: 5px;">
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
    <tr>
      <td><b>Fixe ?</b> </td>
      <td><div align="left">
                    <span class="important">Oui</span>
                    <input type="radio" name="fixe" id="radio1" value="1">
                    <span class="important">Non</span>
                    <input type="radio" name="fixe" id="radio2" value="0" checked="checked">
                    
                </div></td>
    </tr>
   <tr><td colspan="2">&nbsp;</td></tr>    
      <tr>
      <td><b>Défilante ?</b> </td>
      <td><div align="left">
                    <span class="important">Oui</span>
                    <input type="radio" name="slide" id="radio1" value="1">
                    <span class="important">Non</span>
                    <input type="radio" name="slide" id="radio2" value="0" checked="checked">
                    
                </div></td>
    </tr>  
   <tr><td colspan="2">&nbsp;</td></tr>    
          <tr>
      <td><b>Active ?</b> </td>
      <td><div align="left">
                    <span class="important">Oui</span>
                    <input type="radio" name="statut" id="radio1" value="1" checked="checked">
                    <span class="important">Non</span>
                    <input type="radio" name="statut" id="radio2" value="0" >
                    
                </div></td>
    </tr>  
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
       <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
       <input type="submit" value="Valider" name="img_up" class="alt_btn" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="date" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
        
        <p><hr/></p>
        <table class="tablesorter" cellspacing="0"> 
            <thead>
                <tr>
                    <th colspan="5"><b>LA LSITE DES PUBICITES PUBLIEES SUR LA PAGE D'ACCUEIL</th>
                </tr>
                <tr>
                  <th align="center" valign="middle">Image</th>
                  <th align="center" valign="middle">Date</th>
                  <th align="center" valign="middle">Position</th>
                  <th align="center" valign="middle">Fixe?</th> 
                  <th align="center" valign="middle">Défile?</th> 
                  <th align="center" valign="middle">Etat</th>                  
                  <th align="center" valign="middle">Modifier</th>
                  <th align="center" valign="middle">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php do { ?>
            <tr>
             <td align="center" valign="middle"><img src="../<?php echo $row_rs_all_pub['image']; ?>" class="img-responsive" width="50" height="75"/></td>
              <td align="center"><span style="color:#000;"><?php echo gestionDate::formatDate($row_rs_all_pub['date'],'fr'); ?></span></td>
              <td align="center"><span style="color:#000;"><?php echo $row_rs_all_pub['position']; ?></span></td>
              <td width="67" align="center"><a href="index.php?page=fixe_pubsite&id=<?php echo $row_rs_all_pub['Id']; ?>" title="<?php if($row_rs_all_pub['fixe']==1) echo 'Cliquez pour fixer l\'image '; else {echo 'Cliquez pour défixer l\'image';} ?>"><b><?php if($row_rs_all_pub['fixe']==1) echo 'Oui'; else {echo 'Non';} ?></b></a></td>
                            <td width="67" align="center"><a href="index.php?page=slide_pubsite&id=<?php echo $row_rs_all_pub['Id']; ?>" title="<?php if($row_rs_all_pub['defilant']==1) echo 'Cliquez pour faire défiler'; else {echo 'Cliquez pour arreter de défiler';} ?>"><b><?php if($row_rs_all_pub['defilant']==1) echo 'Oui'; else {echo 'Non';} ?></b></a></td>
               <td width="67" align="center"><a href="index.php?page=etat_pubsite&id=<?php echo $row_rs_all_pub['Id']; ?>" title="<?php if($row_rs_all_pub['etat']==1) echo 'Cliquez pour pour désactiver'; else {echo 'Cliquez pour pour activer';} ?>"><b><?php if($row_rs_all_pub['etat']==1) echo 'Active'; else {echo 'Inactive';} ?></b></a></td>
              <td width="67" align="center"><a href="index.php?page=mod_pub_accueil&id=<?php echo $row_rs_all_pub['Id']; ?>"><b>Modifier</b></a></td>              
              <td width="77" align="center"><a href="index.php?page=sup_accueil&id=<?php echo $row_rs_all_pub['Id']; ?>"><b>Supprimer</b></a></td>
            </tr>
            <?php } while ($row_rs_all_pub = mysql_fetch_assoc($rs_all_pub)); ?>
            </tbody> 
        </table>
    </div>
</article>

<?php
mysql_free_result($rs_all_pub);
?>
