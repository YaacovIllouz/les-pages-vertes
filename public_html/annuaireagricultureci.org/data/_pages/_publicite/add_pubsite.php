<?php 
$entreprise = addslashes($_POST['entreprise']);
$position_pub = addslashes($_POST['position']);
$fixe = addslashes($_POST['fixe']);
$defilant = addslashes($_POST['slide']);
$date_crea_pub=time();
$etat_pub = 1;

include 'upload1.php';

$fichier_logo = 'userfiles/image/'.$nomlogo;


if(($_POST['valider'])&&($ok1==1))
{

	
	/*if(($fichier!="")&&($format_img=='ok'))
	{*/			
	$insertion = "INSERT INTO pub_site VALUES
('', 
 '".$fichier_logo."',
 '".$date_crea_pub."', 
 '".$position_pub."', 
 '".$fixe."',
 '".$defilant."', 
 '".$etat_pub."'
 )";
	echo $insertion;
	//echo $insertion.' extension='.$extension.' '.$format_img.' '.$ok1;
	
	$exe_insert = mysql_query($insertion);
	
	if($exe_insert)
	{		
		$msge = '<font class="confirm">&nbsp; PUB ENREGISTREE AVEC SUCCES</font>';
		
		}
	else
	 {
		 $msge = '<font class="refuse"> IMPOSSIBLE D\'ENREGISTRER CETTE PUB</font>';
		 }
	/*}
	else $msge = '<font class="refuse"> FORMAT D\'IMAGE NON AUTORISE ('.$extension.')</font>';*/
	
}
//$buffer .= '</infos>';
echo $msge;

?>
<article class="module width_full">
    <header>
        <h3><b>Ajouter une pub sur le site</b></h3>        
    </header>
    <div class="module_content"> 
        <form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
  <table align="center" style="width: 60%;">
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Image : </b></td>
      <td>
      <div data-fileupload="image" class="fileupload fileupload-new">
        <input type="hidden" />
        <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail"></div>
        <div style="width: 200px; height: 150px; line-height: 80px;" class="fileupload-preview fileupload-exists thumbnail"></div>
        <span class="btn btn-file"><span class="fileupload-new">Choisir image</span><span class="fileupload-exists">Modifier</span><input type="file" id="fileinput" name="logo" required/></span>
        <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Supprimer</a>
	</div>
      </td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
        <td style="width: 20%;" align="left" valign="middle" nowrap="nowrap"><b>Position : </b></td>
      <td style="width: 800%;"><select name="position" class="select_contrat" style="width:50%; padding: 5px;">
      <option value="">--Choisir un emplacement--</option>
        
        <option value="Gauche" <?php if (!(strcmp("Gauche", ""))) {echo "SELECTED";} ?>>Gauche</option>  
        <option value="Milieu" <?php if (!(strcmp("Milieu", ""))) {echo "SELECTED";} ?>>Milieu</option>     
        <option value="Recherche" <?php if (!(strcmp("Recherche", ""))) {echo "SELECTED";} ?>>Resultat de Recherche</option>
        <option value="Search" <?php if (!(strcmp("Search", ""))) {echo "SELECTED";} ?>>Zone de recherche</option>
        
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
      <td><b>D&eacute;filante ?</b> </td>
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
       <input type="submit" value="Valider" name="valider" class="valider" />
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
