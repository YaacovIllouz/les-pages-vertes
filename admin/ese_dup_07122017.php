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

$msg = '';

if (isset($_POST['btn_dup'])) {
    $maintenant = time();
    $id_ese = (int) $_POST['id_ese'];
    $id_rub = (int) $_POST['Id_rubrique'];
    $id_sou = (int) $_POST['Id_sous_rubrique'];
    $rs = $db->query("SELECT * FROM entreprise WHERE Id_ese =".$id_ese)->fetch(PDO::FETCH_OBJ);
    if(!empty($id_rub) && !empty($id_sou) && $rs) {

        $insertSQL = sprintf("INSERT INTO entreprise (sigle, entreprise, image, date, tel1, tel2, cel1, fax, certification, marque, membre, email, web, bp, geoloclaisation, activite, Id_rubrique, Id_sous_rubrique) 
                              VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
            GetSQLValueString($rs->sigle, "text"),
            GetSQLValueString($rs->entreprise, "text"),
            GetSQLValueString($rs->image, "text"),
            GetSQLValueString($maintenant, "text"),
            GetSQLValueString($rs->tel1, "text"),
            GetSQLValueString($rs->tel2, "text"),
            GetSQLValueString($rs->cel1, "text"),
            GetSQLValueString($rs->fax, "text"),
            GetSQLValueString($rs->certification, "text"),
            GetSQLValueString($rs->marque, "text"),
            GetSQLValueString($rs->membre, "text"),
            GetSQLValueString($rs->email, "text"),
            GetSQLValueString($rs->web, "text"),
            GetSQLValueString($rs->bp, "text"),
            GetSQLValueString($rs->geoloclaisation, "text"),
            GetSQLValueString($rs->activite, "text"),
            GetSQLValueString($id_rub, "int"),
            GetSQLValueString($id_sou, "int"));

        $Result1 = mysql_query($insertSQL, $annuaire) or die(mysql_error());
        if($Result1) {
            $msg .= 'ENREGITREMENT REUSSI.';
        }
    }
    else{
        $msg .= 'ERREUR!! CERTAINES INFORMATIONS MANQUENT.';
    }
}
?>
<article class="module width_full">
    <header>
        <h3><b>Gestion des R&eacute;f&eacute;rencements - Ajouter une entreprise dans une autre rubrique</b></h3>
    </header>
    <div class="module_content">
        <?php
        //affichage du messaage
        if(!empty($msg)){
            echo '<h3 style="text-align: center; color:#090;">'.$msg.'</h3><hr/>';
        }
        ?>
        <form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="form1" id="form1">
            <table align="center" style="width: 100%;">

                <tr valign="baseline">
                    <td align="left" valign="middle" nowrap="nowrap" style="width:4%;">
                        <strong>Entreprise :</strong>
                    </td>
                    <td  style="width:80%;">
                        <select id="id_ese" name="id_ese" style="width:80%; padding: 5px;">
                            <option value="">-- s&eacute;lectionnez --</option>
                            <?php
                            $ese = $db->query("SELECT * FROM entreprise ORDER BY sigle ASC")->fetchAll(PDO::FETCH_OBJ);
                            if($ese){
                                foreach ($ese as $v){
                                    $rub = $db->query("SELECT * FROM rubrique WHERE Id = ".$v->Id_rubrique)->fetch(PDO::FETCH_OBJ);
                                    $sou = $db->query("SELECT * FROM sous_rubrique WHERE Id = ".$v->Id_sous_rubrique)->fetch(PDO::FETCH_OBJ);
                                    echo '<option value="'.$v->Id_ese.'" style="border-bottom:sloid 1px; padding:2px; overflow-x: hidden;  width:800px;">'.$v->sigle.' - '.$v->entreprise.' ('.$rub->rubrique.' / '.$sou->rubrique.')</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr valign="baseline">
                    <td align="left" valign="middle" nowrap="nowrap"><strong>Catégorie :</strong></td>
                    <td>
                        <select id="rubrique" name="Id_rubrique" style="width:70%; padding: 5px;">
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
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr valign="baseline">
                    <td align="left" valign="middle" nowrap="nowrap"><strong>Rubrique :</strong></td>
                    <td>
                        <div id="bloc-sousrub">
                            <select name="Id_sous_rubrique" style="width:70%; padding: 5px;">
                                <option value="">--Rubrique--</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr><td colspan="2">&nbsp;</td></tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">&nbsp;</td>
                  <td align="left">
                   <input type="hidden" name="dup" value="1" />
                   <input type="submit" value="Valider" name="btn_dup"  class="alt_btn" />
                  </td>
                </tr>
            </table>
        </form>
    </div>
</article>
<script type="text/javascript" src="../js/ajax.js"></script>