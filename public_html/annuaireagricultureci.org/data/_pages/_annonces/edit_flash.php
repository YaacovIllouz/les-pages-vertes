<?php

$id=$_GET['com'];
//-------------- -------------------//
$select_pub="SELECT * from flash WHERE Id = '".$id."' ";
$exe_reqpub = mysql_query($select_pub);
$result_bande=mysql_fetch_array($exe_reqpub);
//--------------- -----------------//
$fichier_actuel = $result_pub['image'];

$titre = addslashes($_POST['titre']);
$contenu = addslashes($_POST['contenu']);

if($_POST['valider'])
{
		
	$modif = "UPDATE flash SET titre='".$titre."', contenu='".$contenu."' WHERE Id='".$id."' ";
	//echo $insertion;
	//echo $insertion.' extension='.$extension.' '.$format_img.' '.$ok1;
	
	$exe_modif = mysql_query($modif);
	
	if($exe_modif)
	{		
		$msge = '<font class="confirm">&nbsp; ANNONCE MODIFIEE AVEC SUCCES</font>';
		
		}
	else
	 {
		 $msge = '<font class="refuse"> IMPOSSIBLE D\'ENREGISTRER CETTE ANNONCE</font>';
		 }

	
}
?>

<article class="module width_full">
<table width="100%" border="0">
  <tr>
    <td width="42%" align="left"><h3 class="titre_page">
  <h3><b><span style="color: #090; font-size:14px;">MODIFICATION DE LA BANDE ANNONCE : <?php echo $row_rs_mod_flash['titre']; ?></span></b></h3>
</h3></td>
    <td width="25%" align="center"><?php echo $msge?></td>
    <td width="33%" align="right"><a href="accueil.php?page=?.liste_flash" class="ajout">[Liste des bandes annonces]</a></td>
  </tr>
</table>  
<p>&nbsp;</p>  
  <div class="module_content">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center" style="width: 70%;">
    <tr valign="baseline">
      <td nowrap align="right" style="width: 20%;">Titre : &nbsp;</td>
      <td style="width: 80%;">
        <input type="text" name="titre" value="<?php echo htmlentities($result_bande['titre'], ENT_COMPAT, ''); ?>" class="champ_zoneb" style="width:90%;"></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Contenu : &nbsp;</td>
      <td><textarea name="contenu" cols="50" rows="5" id="editor1"  style="width: 70%;"><?php echo htmlentities($result_bande['contenu'], ENT_COMPAT, ''); ?></textarea></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Valider" name="valider" class="valider"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="Id" value="<?php echo $row_rs_mod_flash['Id']; ?>">
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($rs_mod_flash);
?>
<script type="text/javascript" src="../js/ajax.js"></script>

<script>
       // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor1' );
</script>
    </div>
  </article>