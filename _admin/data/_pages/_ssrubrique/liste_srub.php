<?php
//if(!$_SESSION['login']) @header("Location: index.php");
//include("../../_connexion/link_bd.php");
// SUP ONE BY ONE ELEMENT
$table="sous_rubrique";
$CKkey_ctt=$_GET['com'];
if($_GET['com'])
{ 
$sql_selectsrub = "SELECT * FROM pub2 WHERE Id_sr ='".$CKkey_ctt."' ";	
$srub_selectsrub = mysql_query($sql_selectsrub);
$data_lastsrub = mysql_fetch_array($srub_selectsrub);

@unlink('../../'.$data_lastsrub['images']);

$del_data=mysql_query("DELETE FROM pub2 WHERE Id_sr ='".$CKkey_ctt."'" ) or die (mysql_error());

//echo "yes";
         $resu=mysql_query("DELETE FROM $table WHERE Id ='".$CKkey_ctt."' LIMIT 1;" ) or die (mysql_error());
$msge='<font class="refuse">SUPPRESSION EFFECTUEE AVEC SUCCES</font>';
$msge.='<meta http-equiv="refresh" content="4; url=accueil.php?page=?.liste_srub" />';		 
}
$statut=1;

$query_pag_data = "SELECT * from $table ORDER BY rubrique ASC";
//echo $query_pag_data;
$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
$msg = "";
$nb_ctt = mysql_num_rows($result_pag_data);
//$data = mysql_fetch_row($result_pag_data);
?>
<!DOCTYPE html>
<html lang="fr">
<head>

<!--SUPPRESION USER -->
<script language=javascript>
   function ConfirmMessage( identifiant ) 
   {
       if (confirm("Voulez-vous supprimer cette rubrique ?")) 
	   { // Clic sur OK
           document.location.href = "accueil.php?page=?.liste_srub&com="+identifiant ;
       }
   }
</script>
</head>
    <body>
<div style="margin:auto">
    <table width="100%" border="0">
      <tr>
        <td width="40%" align="center"><h3 class="heading ombre2">LISTE DES SOUS-RUBRIQUES ET LEUR PUB</h3></td>
        <td width="35%" align="center"><?php echo $msge;?></td>
        <td width="25%"><div align="right" class="text_bouton"><a href="accueil.php?page=?.add_srub" class="ajout">Ajouter une sous-rubrique</a></div></td>
      </tr>
    </table>   
    </div>
<br />
			<!-- header --><!-- main content -->
                  <div class="row-fluid">
				    <div class="span12">
					  
						  <table class="table table-bordered table-striped table_vam" id="dt_gal">
							  <thead>
								  <tr>
									  <th width="20" class="table_checkbox"><input type="checkbox" name="select_rows" class="select_rows" data-tableid="dt_gal" /></th>
									  <th width="50">IMAGE</th>
									  <th width="109">DESCRIPTION</th>
									  <th width="84">RUBRIQUE</th>
									  <th width="47">PUB AJOUTEE LE</th>
									  <th width="51">ACTIONS</th>
								  </tr>
							  </thead>
							  
                                <?php
			$sf=0;
			$i=1;
			if ($result_pag_data = mysql_query($query_pag_data)){
			while ($row = mysql_fetch_array($result_pag_data)) {
				
				$info_pub2 = Getimage_ssrub($row['Id']);
				$data_pub = explode("--",$info_pub2);
				$count_param=count($data_pub);
					
		?> 
								  <tr>
									  <td><input type="checkbox" name="row_sel" class="row_sel" /></td>
									  <td style="width:60px">
                                      <?php if($count_param==1){echo '<strong>Pas de pub</strong>';} else {?>
									<img src="../../<?php echo $data_pub[0];?>" height="50px" width="30px" alt=""><?php }?>												  
									  </td>
								    <td class="gras maj"><?php echo $row['rubrique'];?></td>
									  <td><?php echo GetLibcateg($row['Id_rubrique']);?></td>
								    <td><?php if($count_param==1){echo '<strong>Pas de pub</strong>';} else { echo date("d/m/Y", $data_pub[1]);}?></td>
									  <td align="center">
										  &nbsp;&nbsp;&nbsp;<a href="accueil.php?page=?.edit_srub&com=<?php echo $row['Id'];?>" class="lien_com"><img src="img/modifier.png" border="0" title="MODIFIER"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  
										  <?php  echo("<a href=\"#\" onClick=\"ConfirmMessage('".$row['Id']."')\" class=\"confirm_yes\"><img src='img/delete.png' border='0' title='SUPPRIMER'/></font></a>") ; ?>
									  </td>
								  </tr>
							  
                              <?php $i++;}}?>   
						  </table>
							
					  </div>
					</div>
					
					<!-- hide elements (for later use) -->
					<div class="hide">
						<!-- actions for datatables -->
						<div class="dt_gal_actions">
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="#" class="delete_rows_dt" data-tableid="dt_gal"><i class="icon-trash"></i> Delete</a></li>									
								</ul>
							</div>
						</div>
						<!-- confirmation box -->
						<div id="confirm_dialog" class="cbox_content">
							<div class="sepH_c tac"><strong>Etes vous sure de vouloir supprimer cette ligne?</strong></div>
							<div class="tac">
								<a href="#" class="btn btn-gebo confirm_yes" >Yes</a>
								<a href="#" class="btn confirm_no">No</a>
							</div>
						</div>
					</div>

	</body>
</html>