<?php
//if(!$_SESSION['login']) @header("Location: index.php");
//include("../../_connexion/link_bd.php");
// SUP ONE BY ONE ELEMENT
$table="rubrique";
$CKkey_ctt=$_GET['com'];
$date_mod = date('Y-m-d H:s:i');
if($_GET['com'])
{ 
//echo "yes";
         $resu=mysql_query("DELETE FROM $table WHERE Id ='".$CKkey_ctt."' LIMIT 1;" );// or die (mysql_error());
		 

$msge='<font class="refuse">SUPPRESSION EFFECTUEE AVEC SUCCES</font>';
$msge.='<meta http-equiv="refresh" content="2; url=accueil.php?page=?.liste_rub" />';		 
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
           document.location.href = "accueil.php?page=?.liste_rub&com="+identifiant ;
       }
   }
</script>
<meta charset="utf-8">
</head>
    <body>
<div style="margin:auto">
    <table width="100%" border="0">
      <tr>
        <td width="35%" align="left"><h3 class="titre_page">LISTE DES RUBRIQUES</h3></td>
        <td width="38%" align="center"><?php echo $msge;?></td>
        <td width="27%"><div align="right" class="text_bouton"><a href="accueil.php?page=?.add_rub" class="ajout">[Ajouter une rubrique]</a></div></td>
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
									  <th width="86">LIBELLE</th>
									  <th width="109">COULEUR</th>
									  <th width="84">MODIFICATION</th>
									  <th width="47">SUPPRESSION</th>
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
									  <td style="width:60px">
										  <!--<a href="../avatar/<?php //echo $row['avatar_user'];?>" title="<?php //echo $row['avatar_user'];?>" class="cbox_single thumbnail"></a>-->
											  <?php echo $row['rubrique'];?>
										  
									  </td>
								    <td class="gras maj"><input type="color" value="<?php echo $row['color']; ?>"></td>
									  <td style="text-align:center"><a href="accueil.php?page=?.edit_rub&com=<?php echo $row['Id'];?>" class="lien_com">Modifier</a></td>
								    <td><?php  echo("<a href=\"#\" onClick=\"ConfirmMessage('".$row['Id']."')\" class=\"confirm_yes\">Supprimer</font></a>") ; ?></td>
									  <td align="center">
										  <?php echo GetLibcateg($row['Id']);?>
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