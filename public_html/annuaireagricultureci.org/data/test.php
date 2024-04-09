<?php 
require_once('../_connexion/link_bd.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>


<!-- DEBUT LISTE LIEE CAT ET RUBRIQUE -->
	<script type="text/javascript" src="jquery.js"></script> 
    <!--<script type="text/javascript" src="jquery.chained.js"></script>-->
</head>

<body>

<select name="rubrique" id="rubrique" data-placeholder="Choisir une catégorie" class="select_contrat">
<option value="vide">- Choisissez une rubrique -</option>
<?php
// Appel des regions
$req = "SELECT Id, rubrique FROM rubrique ORDER BY rubrique ASC";
$rep = mysql_query($req)or die (mysql_error());

while ($row = mysql_fetch_array($rep)) {
	echo "<option value=".$row['Id'].">".$row['rubrique']."</option>";
} 
@mysql_free_result($req);
?>
</select>
<br />
<select name="sous_rubrique" id="sous_rubrique" data-placeholder="Choisir une rubrique" class="select_contrat_">
<option value="vide">- Choisissez une rubrique -</option>

<?php
// Appel des regions
$req = "SELECT * FROM sous_rubrique ORDER BY rubrique ASC";
$rep = mysql_query($req);
while ($row = mysql_fetch_array($rep)) {
	echo "<option value=".$row['Id']." class=".$row['Id_rubrique'].">".$row['rubrique']."</option>";
} 
@mysql_free_result($req);
?>
</select>

</body>


<script type="text/javascript">$(function(){
    $("#sous_rubrique").chained("#rubrique");
	/*$("#article").chained("#produit");
	$("#ssarticle").chained("#article");
	$("#element").chained("#ssarticle");*/
});
</script>

<script src="js/jquery.min.js"></script>
			<!-- DEBUT LISTE LIEE CAT ET RUBRIQUE -->
			   
<script type="text/javascript" src="jquery.chained.js"></script>




</html>