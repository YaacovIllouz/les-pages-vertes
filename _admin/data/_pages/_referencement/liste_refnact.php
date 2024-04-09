<?php
//if(!$_SESSION['login']) @header("Location: index.php");
//include("../../_connexion/link_bd.php");
// SUP ONE BY ONE ELEMENT
$table="entreprise";
$CKkey_ctt=$_GET['com'];
if($_GET['com'])
{ 

$query = "SELECT logo FROM $table WHERE Id_ese ='".$CKkey_ctt."' LIMIT 1"; 
	$result = mysql_query($query); 
	$row = mysql_fetch_array($result);  	
	$ImageName = $row['logo'];
	
	if($ImageName!="img_indispo.jpg")
	{
	  @unlink("../../userfiles/image/".$ImageName);
	}

//echo "yes";
         $resu=mysql_query("DELETE FROM $table WHERE Id_ese ='".$CKkey_ctt."' LIMIT 1;" ) or die (mysql_error());
$msge='<font class="refuse">SUPPRESSION EFFECTUEE</font>';
$msge.='<meta http-equiv="refresh" content="2; url=?page=?.liste_ref" />';		 
}
$statut=1;

$query_pag_data = "SELECT * from $table WHERE flag_ese = 0 ORDER BY sigle ASC";
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
       if (confirm("Voulez-vous supprimer cette entreprise ?")) 
	   { // Clic sur OK
           document.location.href = "accueil.php?page=?.liste_ref&com="+identifiant ;
       }
   }
</script>
<meta charset="iso-8859-1">
</head>
    <body>
<div style="margin:auto">
  <table width="100%" border="0">
      <tr>
        <td width="46%" align="left"><h3 class="titre_page">LISTE DES REFERENCEMENTS INACTIFS</h3></td>
        <td width="22%" align="center"><?php echo $msge;?></td>
        <td width="32%" align="right"><div align="right" class="text_bouton"><a href="accueil.php?page=?.add_ref" class="ajout">[Ajouter un referencement]</a></div></td>
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
									  <th width="20" class="table_checkbox">LOGO</th>
									  <th width="50">SIGLE</th>
									  <th width="109">ENTREPRISE</th>
                                      <th width="47">CATEGORIE</th>
									  <th width="34">PUBLICITE</th>
									  <th width="71">ACTIONS</th>
								  </tr>
							  </thead>
							  
                                <?php
			$sf=0;
			$i=1;
			if ($result_pag_data = mysql_query($query_pag_data)){
			while ($row = mysql_fetch_array($result_pag_data)) {
					
		?> 
								  <tr>
									  <td align="center"><img src="../../<?php echo $row['image'];?>" width="45" height="40"></td>
									  <td style="width:60px">
										  <!--<a href="../avatar/<?php //echo $row['avatar_user'];?>" title="<?php //echo $row['avatar_user'];?>" class="cbox_single thumbnail"></a>-->
											  <?php echo $row['sigle'];?>
										  
									  </td>
								    <td class="gras maj"><?php echo $row['entreprise'];?></td>
									  <td><?php echo GetLibcateg($row['Id_rubrique']);?></td>
								    <td><a href="accueil.php?page=?.add_pub&id=<?php echo $row['Id_ese'];?>" class="lien_com"><b>Ajouter une pub</b></a></td>
                                    
									  <td align="center">
										  &nbsp;&nbsp;&nbsp;<a href="accueil.php?page=?.edit_ref&com=<?php echo $row['Id_ese'];?>" class="lien_com"><img src="img/modifier.png" border="0" title="MODIFIER"/></a>&nbsp;&nbsp;&nbsp;
										  <a href="accueil.php?page=?.statut_refinact&id=<?php echo $row['Id_ese'];?>"><?php if($row['flag_ese']==1){echo '<img src="img/unlocked.png" title="Cliquer pour v&eacute;rouiller">';} else {echo '<img src="img/locked_.png" title="Cliquer pour d&eacute;v&eacute;rouiller">' ;}?></a>&nbsp;&nbsp;&nbsp;
										  <?php  echo("<a href=\"#\" onClick=\"ConfirmMessage('".$row['Id_ese']."')\" class=\"confirm_yes\"><img src='img/delete.png' border='0' title='SUPPRIMER'/></font></a>") ; ?>
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
							<div class="sepH_c tac"><strong>Etes vous sûre de vouloir supprimer cette ligne?</strong></div>
							<div class="tac">
								<a href="#" class="btn btn-gebo confirm_yes" >Yes</a>
								<a href="#" class="btn confirm_no">No</a>
							</div>
						</div>
					</div>

	</body>
</html>