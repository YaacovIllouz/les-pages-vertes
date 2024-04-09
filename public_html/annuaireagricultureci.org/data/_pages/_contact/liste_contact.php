<?php
//if(!$_SESSION['login']) @header("Location: index.php");
//include("../../_connexion/link_bd.php");
// SUP ONE BY ONE ELEMENT
$table="contact";
$CKkey_ctt=$_GET['com'];
if($_GET['com'])
{ 
//echo "yes";
         $resu=mysql_query("DELETE FROM $table WHERE id ='".$CKkey_ctt."' LIMIT 1;" ) or die (mysql_error());
$msge='<font class="refuse">SUPPRESSION EFFECTUEE AVEC SUCCES</font>';
$msge.='<meta http-equiv="refresh" content="2; url=accueil.php?page=?.contact" />';		 
}
$statut=1;

$query_pag_data = "SELECT * from $table ORDER BY adresse ASC";
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
       if (confirm("Voulez-vous supprimer ce contact ?")) 
	   { // Clic sur OK
           document.location.href = "accueil.php?page=?.contact&com="+identifiant ;
       }
   }
</script>
<meta charset="iso-8859-1">
</head>
    <body>
<div style="margin:auto">
    <table width="100%" border="0">
      <tr>
        <td width="33%" align="left"><h3 class="titre_page">CONTACTS PAGESVERTES</h3></td>
        <td width="20%" align="center"><?php echo $msge;?></td>
        <td width="47%"><div align="right" class="text_bouton"><a href="accueil.php?page=?.add_contact" class="ajout">[Ajouter un contact]</a></div></td>
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
									  <th width="20" class="table_checkbox">
                                      <input type="checkbox" name="select_rows" class="select_rows" data-tableid="dt_gal" /></th>
                                      <th width="20">ADRESSE</th>
									  <th width="86">TELEPHONE</th>									  
									  <th width="84">EMAIL</th>                              
                                      <th width="84">DATE CREATION</th>                                     
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
									  <td><input type="checkbox" name="row_sel" class="row_sel" /></td>
                                      <td align="center"><?php echo $row['adresse'];?></td>
									  <td style="width:60px">
										  <!--<a href="../avatar/<?php //echo $row['avatar_user'];?>" title="<?php //echo $row['avatar_user'];?>" class="cbox_single thumbnail"></a>-->
											  <?php echo $row['tel'];?>
										  
									  </td>
								    <td class="gras maj"><?php echo $row['email'];?></td>
									  
								    <td><?php //echo $row['tel'].' <br/> '.$row['email'];?></td>
                                    <td align="center">
									    &nbsp;&nbsp;&nbsp;<a href="accueil.php?page=?.edit_contact&com=<?php echo $row['id'];?>" class="lien_com"><img src="img/modifier.png" border="0" title="MODIFIER"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									    <?php  echo("<a href=\"#\" onClick=\"ConfirmMessage('".$row['id']."')\" class=\"confirm_yes\"><img src='img/delete.png' border='0' title='SUPPRIMER'/></font></a>") ; ?>
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