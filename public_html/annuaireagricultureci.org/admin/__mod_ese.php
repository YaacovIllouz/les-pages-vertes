<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
            $updateSQL = sprintf("UPDATE entreprise SET sigle=%s, entreprise=%s, tel1=%s, tel2=%s, cel1=%s, fax=%s, certification=%s, marque=%s, membre=%s, email=%s, web=%s, bp=%s,       geoloclaisation=%s, dirigeant=%s, activite=%s, Id_rubrique=%s, Id_sous_rubrique=%s WHERE Id_ese=%s",
                       GetSQLValueString($_POST['sigle'], "text"),
                       GetSQLValueString($_POST['entreprise'], "text"),
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
   echo 'Modification effectuée avec succès';

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
<script src="ckeditor/ckeditor.js"></script>
<article class="module width_full">
  <header>
    <h3>MODIFIER LES INFORMATIONS SUR l'ENTREPRISE <span style="color: #090; font-size:14px;"><?php echo $row_rs_mod_ese['sigle']; ?> </span>de la catégorie <span style="color: #090; font-size:14px;"><?php
          mysql_select_db($database_annuaire, $annuaire);
          $req = "SELECT * FROM rubrique WHERE Id = '".$row_rs_mod_ese['Id_rubrique']."'";
          $res= mysql_query($req);
          $row= mysql_fetch_assoc($res);
          echo $row['rubrique'];
        ?> </span> et de la rubrique <span style="color: #090; font-size:14px;"><?php
          mysql_select_db($database_annuaire, $annuaire);
          $req = "SELECT * FROM sous_rubrique WHERE Id = '".$row_rs_mod_ese['Id_sous_rubrique']."'";
          $res= mysql_query($req);
          $row= mysql_fetch_assoc($res);
          echo $row['rubrique'];
        ?></span></h3>
  </header>
  <div class="module_content">

<br />
<form action="" method="post" name="form1" id="form1" enctype="multipart/form-data">
  <table align="center" style="width: 100%;">
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap" style="width:20%;"><b>Sigle</b></td>
      <td style="width: 80%;"><input type="text" name="sigle" value="<?php echo htmlentities($row_rs_mod_ese['sigle'], ENT_COMPAT, ''); ?>" style="width: 70%; padding: 3px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Entreprise</b></td>
      <td><input type="text" name="entreprise" value="<?php echo htmlentities($row_rs_mod_ese['entreprise'], ENT_COMPAT, ''); ?>"
                 style="width: 70%; padding: 3px; text-transform: uppercase;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Téléphone 1</b></td>
      <td><input type="text" name="tel1" value="<?php echo htmlentities($row_rs_mod_ese['tel1'], ENT_COMPAT, ''); ?>" style="width: 70%; padding: 3px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Téléphone 2</b> </td>
      <td><input type="text" name="tel2" value="<?php echo htmlentities($row_rs_mod_ese['tel2'], ENT_COMPAT, ''); ?>" style="width: 70%; padding: 3px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Cellulaire</b></td>
      <td><input type="text" name="cel1" value="<?php echo htmlentities($row_rs_mod_ese['cel1'], ENT_COMPAT, ''); ?>" style="width: 70%; padding: 3px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Fax</b></td>
      <td><input type="text" name="fax" value="<?php echo htmlentities($row_rs_mod_ese['fax'], ENT_COMPAT, ''); ?>" style="width: 70%; padding: 3px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Certification</b></td>
      <td><textarea name="certification" cols="50" rows="5" id="editor3"><?php echo htmlentities($row_rs_mod_ese['certification'], ENT_COMPAT, ''); ?></textarea></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Marque</b></td>
      <td><textarea id="editor4" name="marque" cols="50" rows="5"><?php echo htmlentities($row_rs_mod_ese['marque'], ENT_COMPAT, ''); ?></textarea></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Membre</b></td>
      <td><input type="text" name="membre" value="<?php echo htmlentities($row_rs_mod_ese['membre'], ENT_COMPAT, ''); ?>" style="width: 70%; padding: 3px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>E-mail</b></td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_rs_mod_ese['email'], ENT_COMPAT, ''); ?>" style="width: 70%; padding: 3px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Site web</b></td>
      <td><input type="text" name="web" value="<?php echo htmlentities($row_rs_mod_ese['web'], ENT_COMPAT, ''); ?>" style="width: 70%; padding: 3px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Boite postale</b></td>
      <td><input type="text" name="bp" value="<?php echo htmlentities($row_rs_mod_ese['bp'], ENT_COMPAT, ''); ?>" style="width: 70%; padding: 3px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><b>Situation géographique</b> </td>
      <td><input type="text" name="geoloclaisation" value="<?php echo htmlentities($row_rs_mod_ese['geoloclaisation'], ENT_COMPAT, ''); ?>" style="width: 70%; padding: 3px;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left" valign="middle"><b>Dirigeant</b></td>
      <td><textarea name="dirigeant" cols="50" rows="5" id="editor1"><?php echo htmlentities($row_rs_mod_ese['dirigeant'], ENT_COMPAT, ''); ?></textarea></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left" valign="middle"><b>Activités</b></td>
      <td><textarea name="activite" cols="50" rows="5" id="editor2"><?php echo htmlentities($row_rs_mod_ese['activite'], ENT_COMPAT, ''); ?></textarea></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><strong>Catégorie </strong></td>
      <td>
       <select id="regions" name="Id_rubrique" style="width: 70%; padding: 3px;">
            <option value="<?php echo htmlentities($row_rs_mod_ese['Id_rubrique'], ENT_COMPAT, ''); ?>">-- Catégorie --</option>
       </select>
     </td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td align="left" valign="middle" nowrap="nowrap"><strong>Rubrique </strong></td>
      <td>
   <select id="departements" name="Id_sous_rubrique" style="width: 70%; padding: 3px;">
   			 <option value="<?php echo htmlentities($row_rs_mod_ese['Id_sous_rubrique'], ENT_COMPAT, ''); ?>">--Rubrique--</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>
      <br />
        <input type="submit" name="Submit" value="valider" class="alt_btn" />
       </td>
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

<script>
       // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor1' );
      CKEDITOR.replace( 'editor2' );
      CKEDITOR.replace( 'editor3' );
      CKEDITOR.replace( 'editor4' );
</script>
    </div>
  </article>