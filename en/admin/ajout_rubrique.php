<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

?>
<article class="module width_full">
    <header>
        <h3><b>Ajouter une cat&eacute;gorie</b></h3>        
    </header>
    <div class="module_content">
        <div>
            <?php
            if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
   $rubrique = GetSQLValueString($_POST['rubrique'], "text");
   $req = "SELECT rubrique FROM rubrique WHERE  rubrique =  '".$rubrique."'";	
   $res = mysql_query($req);
  // $total = mysql_num_rows($res);
   echo 'Rubrique ajout&eacute;e avec succ&egrave;s';  
}
            ?>
        </div>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <table align="center" style="width:100%;">
              <tr valign="baseline">
                  <td nowrap="nowrap" align="right" style="width: 20%;"><b>Cat&eacute;gorie :</b>&nbsp;&nbsp;&nbsp;</td>
                    <td  style="width:80%;">
                        <input type="text" name="rubrique" value="" required="required"  style="width: 90%; padding:5px;"/>
                    </td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">&nbsp;</td>
                <td>
                    <br /><input type="submit" value="Ajouter" class="alt_btn" />
                    <input type="hidden" name="MM_insert" value="form1" />
                </td>
              </tr>
            </table>
            
            </fieldset>
        </form>
    </div>
</article>
