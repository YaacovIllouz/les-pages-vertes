<?php { session_start();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript">
<!--
function redirection()
{
	document.location.href = "accueil.php?page=?.liste_rub";
}
//-->
</script>


<?php
//récupération de la variable d'URL,
//qui va nous permettre de savoir quel utilisateur dont il faut mettre à jour sa date de deconnexion
$id = $_GET['id']; 
//echo $secure_code;
//exit();
if($id)
	{
$sql1="SELECT * FROM rubrique WHERE id='".$id."'";
$requete1 = mysql_query($sql1);
$result=mysql_fetch_array($requete1);

		if($result['flag_rub']==1)
		{
		$sql2 = "UPDATE rubrique SET flag_rub='0' WHERE id='".$id."'";
		  //exécution de la requête:
		  $requete2 = mysql_query( $sql2) or die(mysql_error());//mise à jour d'un user après deconnexion
			echo "<script>redirection();</script>";
			}
		else if($result['flag_rub']==0)
		{
		$sql2 = "UPDATE rubrique SET flag_rub='1' WHERE id='".$id."'";
		  //exécution de la requête:
		  $requete2 = mysql_query( $sql2) or die(mysql_error());//mise à jour d'un user après deconnexion
			echo "<script>redirection();</script>";	
			}
	}
	else{echo "<script>redirection();</script>";}

}
?>
