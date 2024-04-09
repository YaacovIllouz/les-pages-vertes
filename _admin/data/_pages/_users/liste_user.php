<?php
if(!$_SESSION['login']) @header("Location: index.php");
//include("../_connexion/link_bd.php");
// SUP ONE BY ONE ELEMENT
$table="users";
$CKkey_ctt=$_GET['com'];
if($_GET['com'])
{ 
//echo "yes";
         $resu=mysql_query("DELETE FROM $table WHERE secure_code ='".$CKkey_ctt."' LIMIT 1;" ) or die (mysql_error());
$msge="SUPPRESSION EFFECTUEE AVEC SUCCES";		 
}
$statut=1;

$query_pag_data = "SELECT * from $table ORDER BY login_user ASC";
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
       if (confirm("Voulez-vous supprimer cet administrateur ?")) 
	   { // Clic sur OK
           document.location.href = "accueil.php?page=?.liste_user&com="+identifiant ;
       }
   }
</script>
<meta charset="iso-8859-1">
</head>
    <body>
<div>
    <table width="100%" border="0">
      <tr>
        <td align="left">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left"></td>
        <td><div align="right" class="text_bouton"><a href="accueil.php?page=?.add_user" class="ajout">[Ajouter un administrateur]</a></div></td>
      </tr>
    </table>   
    </div>
<br />
			<!-- header --><!-- main content -->
                  <div class="row-fluid">
				    <div class="span12">
					  <h3 class="heading ombre2">ADMINISTRATEURS PAGESVERTES</h3>
						  <table class="table table-bordered table-striped table_vam" id="dt_gal">
							  <thead>
								  <tr>
									 
									  <th>LOGIN</th>
									  <th>NOM & PRENOMS</th>
									  <th>DATE CREATION</th>
									  <th>DERNIERE CONNEXION</th>
                                      <th>DERNIERE DECONNEXION</th>
									  <th>ACTIONS</th>
								  </tr>
							  </thead>
							  
                                <?php
			$sf=0;
			$i=1;
			if ($result_pag_data = mysql_query($query_pag_data)){
			while ($row = mysql_fetch_array($result_pag_data)) {
					
		?> 
								  <tr>
									  
									  <td style="width:60px">
										  <!--<a href="../avatar/<?php //echo $row['avatar_user'];?>" title="<?php //echo $row['avatar_user'];?>" class="cbox_single thumbnail"></a>-->
											  <?php echo $row['login_user'];?>
										  
									  </td>
								    <td class="gras maj"><?php echo $row['nom_user'].' '.$row['pren_user'];?></td>
									  <td><?php echo date("d/m/Y",strtotime($row['date_crea']));?></td>
								    <td><?php if($row['date_con']!="0000-00-00 00:00:00") echo date("d/m/Y H:i:s",strtotime($row['date_con']));?></td>
                                    <td><?php if($row['date_decon']!="0000-00-00 00:00:00") echo date("d/m/Y H:i:s",strtotime($row['date_decon']));?></td>
									  <td align="center">
										  &nbsp;&nbsp;&nbsp;<a href="accueil.php?page=?.edit_user&com=<?php echo $row['secure_code'];?>" class="lien_com"><img src="img/modifier.png" border="0" title="MODIFIER"/></a>&nbsp;&nbsp;&nbsp;
										  <a href="accueil.php?page=?.statut_user&id=<?php echo $row['login_user'];?>"><?php if($row['actif_user']==1){echo '<img src="img/unlocked.png" title="Cliquer pour v&eacute;rouiller">';} else {echo '<img src="img/locked_.png" title="Cliquer pour d&eacute;v&eacute;rouiller">' ;}?></a>&nbsp;&nbsp;&nbsp;
										  <?php  echo("<a href=\"#\" onClick=\"ConfirmMessage('".$row[10]."')\"><img src='img/delete.png' border='0' title='SUPPRIMER'/></font></a>") ; ?>
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
								<a href="#" class="btn btn-gebo confirm_yes">Yes</a>
								<a href="#" class="btn confirm_no">No</a>
							</div>
						</div>
					</div>

	</body>
</html>