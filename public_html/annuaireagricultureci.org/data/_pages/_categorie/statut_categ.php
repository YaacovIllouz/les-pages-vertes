<?php { session_start();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript">
<!--
function redirection()
{
	document.location.href = "accueil.php?page=?.liste_categ";
}
//-->
</script>


<?php
//récupération de la variable d'URL,
//qui va nous permettre de savoir quel utilisateur dont il faut mettre à jour sa date de deconnexion
$secure_code = $_GET['id'];
$date_decon=date("Y-m-d H:i:s");//date et heure de connexion  
echo $secure_code;
if($secure_code)
	{
$sql1="SELECT * FROM categorie WHERE secure_code='".$secure_code."'";
$requete1 = mysql_query($sql1);
$result=mysql_fetch_array($requete1);

		if($result['flag_categ']==1)
		{
		$sql2 = "UPDATE categorie SET flag_categ='0' WHERE secure_code='".$secure_code."'";
		  //exécution de la requête:
		  $requete2 = mysql_query( $sql2) or die(mysql_error());//mise à jour d'un user après deconnexion
			echo "<script>redirection();</script>";
			}
		else if($result['flag_categ']==0)
		{
		$sql2 = "UPDATE categorie SET flag_categ='1' WHERE secure_code='".$secure_code."'";
		  //exécution de la requête:
		  $requete2 = mysql_query( $sql2) or die(mysql_error());//mise à jour d'un user après deconnexion
			echo "<script>redirection();</script>";	
			}
	}
	else{echo "<script>redirection();</script>";}

}
?>
