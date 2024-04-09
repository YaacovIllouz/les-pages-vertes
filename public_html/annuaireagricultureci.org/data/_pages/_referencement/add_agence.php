<?php
##Debut Fonction php
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
##Fin Fonction php

if($_GET['com'])
{ 
$resu=mysql_query("DELETE FROM agence WHERE Id ='".$_GET['com']."' LIMIT 1;" ) or die (mysql_error());
$msge='<font class="refuse">SUPPRESSION EFFECTUEE</font>';
$msge.='<meta http-equiv="refresh" content="5; url=?page=?.add_agence&id='.$_GET['id'].'" />';
}

if (isset($_GET['id'])) {
  $colname_rs_ese = $_GET['id'];
  
  $select_ese = mysql_query("SELECT * FROM entreprise WHERE Id_ese = '".$colname_rs_ese."'");
  $row_rs_ese = mysql_fetch_array($select_ese);
  if($row_rs_ese['entreprise']!=""){$ese = $row_rs_ese['entreprise'];} else {$ese = $row_rs_ese['sigle'];} 
}

if ($_POST["valider"]) {
	
	
  $select_checkagce = mysql_query("SELECT * FROM agence WHERE agence = '".$_POST['agence']."' AND Id_ese = '".$colname_rs_ese."' ");
  $row_rs_agence = mysql_num_rows($select_checkagce);	
	
if($row_rs_agence==0){	
  $insertSQL = sprintf("INSERT INTO agence (agence, sit_geographique, tel, Id_ese, cel, fax, bp, email, dirigeant) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['agence'], "text"),
                       GetSQLValueString($_POST['sit_geographique'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['Id_ese'], "int"),
                       GetSQLValueString($_POST['cel'], "text"),
					   GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['bp'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString($_POST['dirigeant'], "text"));

  		$exe_insert = mysql_query($insertSQL);
  
		if($exe_insert)
		{		
			echo '<div align="center"><font style="color:#008C00; font-size:14px; font-weight:600">&nbsp; AGENCE AJOUTEE AVEC SUCCES </font></div>';
		}
	
	} else {echo '<div align="center"><font style="color:#D90000; font-size:14px; font-weight:600">&nbsp; AGENCE DEJA EXISTANTE !</font></div>';}
}

?>
<head>
<!--SUPPRESION USER -->
<script language=javascript>
   function ConfirmMessage( identifiant, identifiant2 ) 
   {
       if (confirm("Voulez-vous supprimer cette AGENCE ?")) 
	   { // Clic sur OK
           document.location.href = "accueil.php?page=?.add_agence&id="+identifiant+"&com="+identifiant2 ;
       }
   }
</script>
</head>
<div align="center"><span style="color: #090; font-size:14px; text-align:center"><?php echo $msge;?></span></div>
<article class="module width_full">
  <header>

    <table width="100%" border="0">
  <tr>
    <td width="32%" align="left"><h3 class="titre_page">
      <h3><b>Ajouter une agence pour l' entreprise <span style="color: #090; font-size:14px;"><?php echo $ese; ?></span></b></h3>
</h3></td>
    <td width="27%" align="right"><a href="accueil.php?page=?.liste_ref" class="ajout">[Liste des entreprises]</a></td>
  </tr>
</table>
  </header><br />
  <div class="module_content">

<form action="" method="post" name="form1" id="form1">
  <table align="center" style="width:80%;">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left" style="width:20%;"><b>Agence </b></td>
      <td style="width: 80%;"><input type="text" name="agence" value="" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Situation g&eacute;ographique </b></td>
      <td><input type="text" name="sit_geographique" value="" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>T&eacute;l&eacute;phone </b></td>
      <td><input type="text" name="tel" value="+225" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Celulaire </b></td>
      <td><input type="text" name="cel" value="+225" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
     <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Fax </b></td>
      <td><input type="text" name="fax" value="+225" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Boite postale :</b></td>
      <td><input type="text" name="bp" value="" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>E-mail</b></td>
      <td><input type="text" name="email" value="" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"><b>Dirigeant</b></td>
      <td><input type="text" name="dirigeant" value="" style="width: 70%;" /></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Valider" class="valider" name="valider" /></td>
    </tr>
  </table>
  <input type="hidden" name="Id_ese" value="<?php echo $row_rs_ese['Id_ese']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<br />

    <!-- main content -->
                  <div class="row-fluid">
				    <div class="span12">
						  <table class="table table-bordered table-striped table_vam" id="dt_gal">
							  <thead>
								  <tr>
									  <th width="20" class="table_checkbox">AGENCE</th>
									  <th width="50">CONTACT</th>
									  <th width="109">EMAIL</th>
                                      <th width="47">BOITE POSTALE</th>
									  <th width="34">SITUATION GEOGRAPHIQUE</th>
									  <th width="71">ACTIONS</th>
								  </tr>
							  </thead>
							  
                                <?php
			//LISTE DES AGENCES DE L'ENTREPRISE PASSEE EN URL								
  			$select_agence = "SELECT * FROM agence WHERE Id_ese = '".$colname_rs_ese."'";								
			$sf=0;
			$i=1;
			if ($result_pag_data = mysql_query($select_agence)){
			while ($row = mysql_fetch_array($result_pag_data)) {
					
		?> 
								  <tr>
									  <td align="center"><?php echo $row['agence'];?></td>
									  <td style="width:60px">
										  <?php echo $row['tel'];?>
											  
										  
									  </td>
								    <td class="gras maj"><?php echo $row['email'];?></td>
									  <td><?php echo $row['bp'];?></td>
								    <td><?php echo $row['sit_geographique'];?></td>
                                    
									  <td align="center">
										  &nbsp;&nbsp;&nbsp;<a href="accueil.php?page=?.edit_agence&com=<?php echo $row['Id'];?>" class="lien_com"><img src="img/modifier.png" border="0" title="MODIFIER"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  <?php  echo("<a href=\"#\" onClick=\"ConfirmMessage('".$colname_rs_ese."','".$row['Id']."')\" class=\"confirm_yes\"><img src='img/delete.png' border='0' title='SUPPRIMER'/></font></a>") ; ?>
									  </td>
								  </tr>
							  
                              <?php $i++;}}?>   
						  </table>
							
					  </div>
					</div>
</div>
  </article>
