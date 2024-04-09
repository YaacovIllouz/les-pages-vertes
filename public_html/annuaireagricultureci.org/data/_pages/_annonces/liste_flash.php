<?php
//if(!$_SESSION['login']) @header("Location: index.php");
//include("../../_connexion/link_bd.php");
// SUP ONE BY ONE ELEMENT
$table="flash";
$CKkey_ctt=$_GET['com'];
if($_GET['com'])
{ 
//echo "yes";
         $resu=mysql_query("DELETE FROM $table WHERE Id ='".$CKkey_ctt."' LIMIT 1;" ) or die (mysql_error());
$msge='<font class="refuse">SUPPRESSION EFFECTUEE AVEC SUCCES</font>';
$msge.='<meta http-equiv="refresh" content="3; url=accueil.php?page=?.liste_flash" />';		 
}
$statut=1;

$query_pag_data = "SELECT * from $table ORDER BY date DESC";
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
       if (confirm("Voulez-vous supprimer cette reference ?")) 
	   { // Clic sur OK
           document.location.href = "accueil.php?page=?.liste_flash&com="+identifiant ;
       }
   }
</script>
<meta charset="iso-8859-1">
</head>
    <body>
<div style="margin:auto">
  <table width="100%" border="0">
      <tr>
        <td width="40%" align="left"><h3 class="titre_page">LISTE BANDE ANNONCE </h3></td>
        <td width="35%" align="center"><?php echo $msge;?></td>
        <td width="25%" align="right"><div align="right" class="text_bouton"><a href="accueil.php?page=?.add_flash" class="ajout">[Ajouter une bande annonce]</a></div></td>
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
                                      <th width="20">DATE</th>
                                      <th width="120">TITRE</th>
									  <th width="86">CONTENU</th>
                                      <th width="86">MODIFICATION</th>								
									  <th width="71">ACTIONS</th>
								  </tr>
							  </thead>
							  
                                <?php
			$sf=0;
			$i=1;
			if ($result_pag_data = mysql_query($query_pag_data)){
			while ($row = mysql_fetch_array($result_pag_data)) {
			
			if($row['fixe']=='1'){$fixe='Oui';}else{$fixe='Non';}
			if($row['defilant']=='1'){$defile='Oui';}else{$defile='Non';}		
					
		?> 
      <tr>
          <td><input type="checkbox" name="row_sel" class="row_sel" /></td>
          <td align="center"><?php echo date('d/m/Y', $row['date']);?></td>
          <td><?php echo $row['titre'];?></td>
        
        <td ><?php echo $row['contenu'];?></td>
        <td style="text-align:center"><a href="accueil.php?page=?.edit_flash&com=<?php echo $row['Id'];?>" class="lien_com">Modifier</a></td>                            
									  <td align="center">
										  &nbsp;&nbsp;&nbsp;
										  <a href="accueil.php?page=?.statut_flash&id=<?php echo $row['Id'];?>"><?php if($row['etat']==1){echo '<img src="img/unlocked.png" title="Cliquer pour v&eacute;rouiller">';} else {echo '<img src="img/locked_.png" title="Cliquer pour d&eacute;v&eacute;rouiller">' ;}?></a>&nbsp;&nbsp;&nbsp;
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