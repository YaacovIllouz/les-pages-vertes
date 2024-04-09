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
$maintenant = time();
if (isset($_POST['img_up'])) { 
    $msg = '';
   /* //verifie si l'entreprise est deja  enregistree
    $verif = $db->query('SELECT * FROM entreprise 
                        WHERE (sigle="'.$_POST['sigle'].'") OR (entreprise ="'.$_POST['entreprise'].'") ')->fetch();
    if($verif){
        $msg .= 'CETTE ENTREPRISE EST DEJA ENREGISTREE';
    }
    else {*/

        $Upload = new uploadImage(512, 500, 500, 80, 80, '../userfiles/image/');
        $Upload->SetExtension(".jpg;.jpeg;.gif;.png");
        $Upload->SetMimeType("image/jpg;image/gif;image/png");

        $msg = '';
        if ($Upload->CheckUpload()) {
            if ($Upload->WriteFile()) {
                $msg = "<p>image chargée avec succès</p>";
                $tableau = $Upload->GetSummary();
				$entre = utf8_decode($_POST['entreprise']);
                $insertSQL = sprintf("INSERT INTO entreprise (sigle, entreprise, image, `date`, tel1, tel2, cel1, fax, certification, marque, membre, email, web, bp, geoloclaisation, activite, Id_rubrique, Id_sous_rubrique) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                    GetSQLValueString($_POST['sigle'], "text"),
                    GetSQLValueString($entre, "text"),
                    GetSQLValueString(substr($tableau['chemin'], 3), "text"),
                    GetSQLValueString($maintenant, "text"),
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
                    GetSQLValueString($_POST['activite'], "text"),
                    GetSQLValueString($_POST['Id_rubrique'], "int"),
                    GetSQLValueString($_POST['Id_sous_rubrique'], "int"));

                mysql_select_db($database_annuaire, $annuaire);
                $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
                echo '<br />Enregistrement Réussi.';
            } else {
                $msg = "<p>Echec 2 du transfert de l'image sur le serveur.</p>";
                $tableau = $Upload->GetError();
                foreach ($tableau as $valeur) {
                    $msg .= $valeur . "<br />";
                }
            }
        } else {
            $msg = "<p>Echec 1 du transfert de l'image sur le serveur.</p>";
            $tableau = $Upload->GetError();
            foreach ($tableau as $valeur) {
                $msg .= $valeur . "<br />";
            }
        }
    //}
    //affichage du messaage
    if(!empty($msg)){
        echo '<h3 style="text-align: center; color:#090;">'.$msg.'</h3><hr/>';
    }
}
?>
<article class="module width_full">
    <header>
        <h3><b>Gestion des R&eacute;f&eacute;rencements - Ajouter une entreprise</b></h3>
    </header>
    <div class="module_content">
        <form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
            <table align="center" >
                <tr valign="baseline">
                    <td align="left" valign="middle" nowrap="nowrap"><b>Logo :</b></td>
                    <td><input type="file" name="userfile" size="60" /></td>
                </tr>

                <tr valign="baseline">
                  <td  align="left" valign="middle" nowrap="nowrap"><b>Sigle :</b></td>
                  <td><input type="text" name="sigle" id="sigle" size="60" /></td>
                </tr>

                 <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Entreprise :</b></td>
                  <td><input type="text" name="entreprise" size="60" /></td>
                </tr>

                <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Téléphone 1 :</td>
                  <td><input type="text" name="tel1" value="+225" size="60" /></td>
                </tr>

                <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Téléphone 2 :</b></td>
                  <td><input type="text" name="tel2" value="+225" size="60" /></td>
                </tr>

                <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Cellulaire 1 :</b></td>
                  <td><input type="text" name="cel1" value="+225" size="60" /></td>
                </tr>

                    <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Fax :</td>
                  <td><input type="text" name="fax" value="+225" size="60" /></td>
                </tr>

                <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Certification :</b></td>
                  <td><textarea id="editor1" name="certification"></textarea></td>
                </tr>

                 <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Marque :</b></td>
                  <td><textarea id="editor2" name="marque" cols="50" rows="5"></textarea></td>
                </tr>

                <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Membre :</b></td>
                  <td><input type="text" name="membre" size="60" /></td>
                </tr>

                <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>E-mail :</b></td>
                  <td><input type="text" name="email" size="60" /></td>
                </tr>

                <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Site web :</b></td>
                  <td><input type="text" name="web" value="http://" size="60" /></td>
                </tr>

                <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Boite postale :</b></td>
                  <td><input type="text" name="bp" size="60" /></td>
                </tr>

                <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Situation géographique :</b></td>
                  <td><input type="text" name="geoloclaisation" size="60" /></td>
                </tr>
                <!--<tr><td colspan="2">&nbsp;</td></tr>
                <tr valign="baseline">
                  <td align="left" valign="middle" nowrap="nowrap"><b>Dirigeant :</b></td>
                  <td><textarea id="editor2" name="dirigeant" cols="50" rows="3"></textarea></td>
                </tr>-->

                <tr valign="baseline">
                  <td nowrap="nowrap" align="left" valign="middle"><b>Activite :</b></td>
                  <td><textarea id="editor3" name="activite" cols="50" rows="3"></textarea></td>
                </tr>

                <tr valign="baseline">
                    <td align="left" valign="middle" nowrap="nowrap"><strong>Catégorie :</strong></td>
                    <td>
                        <select id="rubrique" name="Id_rubrique" style="width: 300px;">
                            <option value="">-- s&eacute;lectionnez --</option>
                            <?php
                            $cat = $db->query("SELECT * FROM rubrique ORDER BY rubrique ASC")->fetchAll();
                            if($cat){
                                foreach ($cat as $v){
                                    echo '<option value="'.$v['Id'].'">'.$v['rubrique'].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr valign="baseline">
                    <td align="left" valign="middle" nowrap="nowrap"><strong>Rubrique :</strong></td>
                    <td>
                        <div id="bloc-sousrub">
                            <select name="Id_sous_rubrique" style="width: 300px;">
                                <option value="">--Rubrique--</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr><td colspan="2">&nbsp;</td></tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td align="left">
                   <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
                   <input type="submit" value="Valider le r&eacute;f&eacute;rencement" name="img_up"  class="alt_btn" />
                  </td>
                </tr>
            </table>
            <input type="hidden" name="date" />
            <input type="hidden" name="MM_insert" value="form1" />
        </form>
    </div>
</article>
<script type="text/javascript" src="../js/ajax.js"></script>

<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    CKEDITOR.replace( 'editor3' );
    //CKEDITOR.replace( 'editor4' );
</script>