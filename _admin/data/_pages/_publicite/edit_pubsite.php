<?php 
$id=$_GET['com'];
//-------------- -------------------//
$select_pub="SELECT * from pub_site WHERE Id = '".$id."' ";
$exe_reqpub = mysql_query($select_pub);
$result_pub=mysql_fetch_array($exe_reqpub);
//--------------- -----------------//
$fichier_actuel = $result_pub['image'];



$position_pub = addslashes($_POST['position']);
$fixe = addslashes($_POST['fixe']);
$defilant = addslashes($_POST['slide']);
$etat_pub = addslashes($_POST['statut']);


include 'upload1.php';

$fichier_logo = 'userfiles/image/'.$nomlogo;


if($_POST['valider'])
{

	if(($fichier!="")&&($ok1=1)){
		$chemin_fichier = $fichier_logo;
		@unlink('../../'.$fichier_actuel);
		} else {$chemin_fichier = $fichier_actuel;}
				
	$modif = "UPDATE pub_site SET position = '".$position_pub."', image = '".addslashes($chemin_fichier)."', fixe = '".$fixe."', defilant = '".$defilant."', etat = '".$etat_pub."'  WHERE Id ='".$id."' ";
	//echo $insertion;
	//echo $insertion.' extension='.$extension.' '.$format_img.' '.$ok1;
	
	$exe_modif = mysql_query($modif);
	
	if($exe_modif)
	{		
		$msge = '<font class="confirm">&nbsp; PUB MODIFIEE AVEC SUCCES.</font>';
		
		//-------------- -------------------//
		$select_pub="SELECT * from pub_site WHERE Id = '".$id."' ";
		$exe_reqpub = mysql_query($select_pub);
		$result_pub=mysql_fetch_array($exe_reqpub);
		//--------------- -----------------//
		
		}
	else
	 {
		 $msge = '<font class="refuse"> IMPOSSIBLE D\'ENREGISTRER CETTE PUB.</font>';
		 }

	
}
//$buffer .= '</infos>';


?>
<article class="module width_full">
<div align="center"><?php echo $msge;?></div>
    <header>
        <h3><b>Modifier la pub sur le site</b></h3>        
    </header>
    <div class="module_content"> 
        <form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
  <table align="center" style="width: 60%;">
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Image : </b></td>
      <td>
      <div data-fileupload="image" class="fileupload fileupload-new">
        <input type="hidden" />
        <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail"><img src="<?php echo '../../'.$result_pub['image']; ?>" /></div>
        <div style="width: 200px; height: 150px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
        <span class="btn btn-file"><span class="fileupload-new">Choisir image</span><span class="fileupload-exists">Modifier</span><input type="file" id="fileinput" name="logo" /></span>
        <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Supprimer</a>
	</div>
      </td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
        <td style="width: 20%;" align="left" valign="middle" nowrap="nowrap"><b>Position : </b></td>
      <td style="width: 800%;"><select name="position" class="select_contrat" style="width:50%; padding: 5px;">
      <option value="">--Choisir un emplacement--</option>
        
        <option value="Gauche" <?php if ($result_pub['position']=="Gauche") {echo "selected";} ?>>Gauche</option>  
        <option value="Milieu" <?php if ($result_pub['position']=="Milieu") {echo "selected";} ?>>Milieu</option>     
        <option value="Recherche" <?php if ($result_pub['position']=="Recherche") {echo "selected";} ?>>Resultat de Recherche</option>
        <option value="Search" <?php if ($result_pub['position']=="Search") {echo "selected";} ?>>Zone de recherche</option>
        
      </select></td>
    </tr>
   <tr><td colspan="2">&nbsp;</td></tr>    
    <tr>
      <td><b>Fixe ?</b> </td>
      <td><div align="left">
                    <span class="important">Oui</span>
                    <input name="fixe" type="radio" id="radio" value="1" <?php if($result_pub['fixe']=="1") echo 'checked';?>>
                    <span class="important">Non</span>
                    
                    <input name="fixe" type="radio" id="radio2" value="0" <?php if($result_pub['fixe']=="0") echo 'checked';?>>
                    
                </div></td>
    </tr>
   <tr><td colspan="2">&nbsp;</td></tr>    
      <tr>
      <td><b>D&eacute;filante ?</b> </td>
      <td><div align="left">
                    <span class="important">Oui</span>
                    <input name="slide" type="radio" id="radio" value="1" <?php if($result_pub['defilant']=="1") echo 'checked';?>>
                    <span class="important">Non</span>
                    <input name="slide" type="radio" id="radio2" value="0" <?php if($result_pub['defilant']=="0") echo 'checked';?>>
                    
                </div></td>
    </tr>  
   <tr><td colspan="2">&nbsp;</td></tr>    
          <tr>
      <td><b>Active ?</b> </td>
      <td><div align="left">
                    <span class="important">Oui</span>
                    <input name="statut" type="radio" id="radio" value="1" <?php if($result_pub['etat']=="1") echo 'checked';?>>
                    <span class="important">Non</span>
                    <input name="statut" type="radio" id="radio2" value="0" <?php if($result_pub['etat']=="0") echo 'checked';?>>
                    
                </div></td>
    </tr>  
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
       <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
       <input type="submit" value="Modifier" name="valider" class="valider" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="date" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
        
        <p><hr/></p>
    </div>
</article>

<?php
mysql_free_result($rs_all_pub);
?>
