
<script language="javascript">
<!--
function redirection()
{
	document.location.href = "accueil.php?page=?.liste_part";
}
//-->
</script>


<?php
//récupération de la variable d'URL,
//qui va nous permettre de savoir quel utilisateur dont il faut mettre à jour sa date de deconnexion
$id = $_GET['id']; 
//echo 'okok';
//exit();
if($id)
	{
$sql1="SELECT * FROM partenaire WHERE id='".$id."'";
$requete1 = mysql_query($sql1);
$result=mysql_fetch_array($requete1);

$date_mod = date('Y-m-d H:s:i');

		if($result['flag_part']==1)
		{
		$sql2 = "UPDATE partenaire SET flag_part='0' WHERE id='".$id."'";
		  //exécution de la requête:
		  $requete2 = mysql_query( $sql2) or die(mysql_error());//mise à jour d'un user après deconnexion
			echo "<script>redirection();</script>";
			}
		else if($result['flag_part']==0)
		{
		$sql2 = "UPDATE partenaire SET flag_part='1' WHERE id='".$id."'";
		  //exécution de la requête:
		  $requete2 = mysql_query( $sql2) or die(mysql_error());//mise à jour d'un user après deconnexion
			echo "<script>redirection();</script>";	
			}
	}
	else{echo "<script>redirection();</script>";}
?>
