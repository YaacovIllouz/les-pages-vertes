<?php
include '../_link/connexion.php';
### DEBUT GENERATION DE KEY TRANSFERT
function code_key_2(){
		$taille =12 ;
		$lettres = "1G345E7F90ABCHIJKML";
		srand(time());
		for ($i=0;$i<$taille;$i++){
			$key_alea.=substr($lettres,(rand()%(strlen($lettres))),1);
		}
		return ('ICT'.$key_alea.'T');
	}
	if($idex==''){
	$key_alea=code_key_2();
	}
	else{
	$key_alea='ICT'.$idex.'T';
	}
### FIN GENERATION DE KEY TRANSFERT

//On verifie l'existance du Type de contrat qu'on essai de creer	
	$Liste_tdmde = oci_parse($connect,"SELECT * FROM tdemande ORDER BY lib_tdmde");
	// Execution de la logique de la requête
	$exe_Ldmde= oci_execute($Liste_tdmde);


$table1="tcontrat";
$libelle=htmlspecialchars(strtoupper($_POST['libelle']));
$etat=$_POST['demande_E'];
$date_creation=date('d-m-Y H:i:s');//date systeme
$creat_by=$_SESSION['login'];
//$date_transf2=date('Y-m-d H:i:s',strtotime($_POST['date_transf']));
$secure_key=$key_alea;
$id="";



if($libelle!=""){
	
		//On verifie l'existance du Type de contrat qu'on essai de creer	
		$check_tcontrat = @oci_parse($connect,"SELECT * FROM tdemande WHERE lib_tdmde='".$libelle."'");
		// Execution de la logique de la requête
		$exe_tcontrat = @oci_execute($check_tcontrat);
		$rep_tcontrat = @oci_fetch_array($check_tcontrat, OCI_BOTH+OCI_RETURN_LOBS);	
		//$rows = oci_fetch($AGENT);
		$cpt_tcontrat = @oci_num_rows($check_tcontrat);
	
	if($cpt_tcontrat==0)//S'il n'existe pas on le crée
		{	
		//Ajout d'un type de contrat dans la table tcontrat
	$stmt = @ociparse($connect,"INSERT INTO tdemande (ID_TDMDE, LIB_TDMDE, DATE_TDMDE, FLAG_TDMDE, CREE_BY, SECURE_ID) VALUES (:id_tdmde,:lib_tdmde,TO_DATE(SYSDATE,'dd/mm/YYYY'),:flag_tdmde,:cree_by,:secure_id)");
		
oci_bind_by_name($stmt,":id_tdmde",$id);
oci_bind_by_name($stmt,":lib_tdmde",$libelle);
oci_bind_by_name($stmt,":flag_tdmde",$etat);
oci_bind_by_name($stmt,":cree_by",$creat_by);
oci_bind_by_name($stmt,":secure_id",$secure_key);

//Validation de l'enregistrement
@oci_execute($stmt);
	
$msge_valide=' - <font class="important">TYPE DE DEMANDE CREE AVEC SUCCES</font>';
		}
		else //Sinon on affiche un message pour prévenir qu'il existe dejà
		{$msge_valide=' - <font class="important2">CE TYPE DE DEMANDE EXISTE DEJA</font>';}
}
//On se déconnecte du serveur
@ocilogoff($connect); 

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gebo Admin Panel</title>
<script src="../js/scr/jquery.validate.js" type="text/javascript"></script>
<!-- Initialisation de la fonction -->		
<script type="text/javascript">

// les règles se fixent dans la partie "rules"
// exemple : password: {required: true,minlength: 5},
// 			password -> nom du champs
//			required=true -> obligatoire
//			minlength:5 -> la valeur saisie doit comporter 5 caractères au moins
// les messages associés se fixent dans la partie "messages"

$().ready(function() {
	$("#signupForm").validate({
		rules: {
			code: {required: true},
			libelle: {required: true},
			contrat_S: {required: true},
		},
		messages: {
			code: "Indiquer un numéro de carte",
			libelle: "Merci d'indiquer le libellé du type de contrat",
			contrat_S: "Faites un choix svp!",			
			
		}
	});
});
</script>   
		
		<script>
			//* hide all elements & show preloader
			document.documentElement.className += 'js';
		</script>
    <!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>
    <body>
		<div id="loading_layer" style="display:none"><img src="img/ajax_loader.gif" alt="" /></div>
		
			<!-- header --><!-- main content -->
            <div id="">
                <div class="">
                  <div class="row-fluid">
					  <div class="span12">

                      <div>
						<form name="form_trsf" class="form-horizontal well" id="signupForm" method="post" action="">
  <fieldset>
	<legend class="txt_rs2_bis">CREATION TYPE DE DEMANDE <?php echo $msge_valide?></legend>
    <div>
    <table width="50%" border="0" class="txt_rs2">
  <tr>
    <td height="55" align="right"><label for="carte" class="obl">Code Type demande : </label></td>
    <td width="48%" align="left"><input id="code" name="code" size="30" value="<?php {echo $secure_key;};?>" readonly /></td>
    <td width="25%" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td width="27%" height="20" align="right"><label for="nom" class="obl">Description : </label></td>
    <td align="left"><input id="libelle" name="libelle" size="30" value="<?php if(($nbre==1)&&($test==0)){echo $data_clt[1];}else if(($nbre==1)&&($test==1)){echo $user_name;}?>" required autocomplete="on"/></td>
    <td align="left"><input class="submit" type="submit" value="  Créer  " style="background-color:#B3CB2F"/></td>
  </tr>
  <tr>
    <td class="txt_norm2"><div align="right" class="obl">Actif ? : </div></td>
    <td colspan="2"><div align="left"><span class="txt_v">Oui </span>
      <input name="demande_E" type="radio" id="radio" value="1" checked="checked">
      <span>Non</span>
      <input type="radio" name="demande_E" id="radio2" value="0" >
      <label for="demande_E"> </label>
      </div>
      </label></td>
  </tr>

    </table>
    
	</fieldset>
 
</form>                      
                      </div>
						<h3 class="heading">Liste des types de demande</h3>
							<table class="table table-bordered table-striped table_vam" id="dt_gal">
								<thead>
									<tr>
										<th class="table_checkbox"><input type="checkbox" name="select_rows" class="select_rows" data-tableid="dt_gal" /></th>
										<th>Description</th>
										<th>Crée le</th>
										<th>Etat</th>
										<th>Date</th>
										<th>Actions</th>
									</tr>
								</thead>
<tbody>
<?php if($exe_Ldmde = oci_execute($Liste_tdmde)){
			while ($data = oci_fetch_array($Liste_tdmde)) {?>

    <tr>
	<td><input type="checkbox" name="row_sel" class="row_sel" /></td>
	<td><?php echo $data['LIB_TDMDE'];?></td>
    <td><?php echo $data['DATE_TDMDE'].' par <br>'.$data['CREE_BY'];?></td>
    <td><?php if($data['FLAG_TDMDE']==1) {echo "Actif";}else echo "Inactif";?></td>
    <td>28/06/2012</td>
    <td>
        <a href="#" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a>
        <a href="#" class="sepV_a" title="View"><i class="icon-eye-open"></i></a>
        <a href="#" title="Delete"><i class="icon-trash"></i></a>
    </td>
    </tr> 

<?php }}
//On se déconnecte du serveur
@ocilogoff($connect); 

?>   
</tbody>
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
									<li><a href="javascript:void(0)">Lorem ipsum</a></li>
									<li><a href="javascript:void(0)">Lorem ipsum</a></li>
								</ul>
							</div>
						</div>
						<!-- confirmation box -->
						<div id="confirm_dialog" class="cbox_content">
							<div class="sepH_c tac"><strong>Are you sure you want to delete this row(s)?</strong></div>
							<div class="tac">
								<a href="#" class="btn btn-gebo confirm_yes">Yes</a>
								<a href="#" class="btn confirm_no">No</a>
							</div>
						</div>
					</div>
                        
                </div>
            </div>
            
			<!-- sticky messages -->
            <script src="lib/sticky/sticky.min.js"></script>
			<!-- fix for ios orientation change -->
			<script src="js/ios-orientationchange-fix.js"></script>
			<!-- scrollbar -->
			<script src="lib/antiscroll/antiscroll.js"></script>
			<script src="lib/antiscroll/jquery-mousewheel.js"></script>
            <!-- common functions -->
			<script src="js/gebo_common.js"></script>
    
			<!-- colorbox -->
			<script src="lib/colorbox/jquery.colorbox.min.js"></script>
			<!-- datatable -->
			<script src="lib/datatables/jquery.dataTables.min.js"></script>
			<!-- additional sorting for datatables -->
			<script src="lib/datatables/jquery.dataTables.sorting.js"></script>
			<!-- tables functions -->
			<script src="js/gebo_tables.js"></script>
	
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1000);
				});
			</script>

	</body>
</html>