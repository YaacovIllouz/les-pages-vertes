<?php { session_start();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript">
<!--
function redirection()
{
	document.location.href = "accueil.php?page=?.liste_user";
}
//-->
</script>


<?php
//récupération de la variable d'URL,
//qui va nous permettre de savoir quel utilisateur dont il faut mettre à jour sa date de deconnexion
$login = $_GET['id'];
$date_decon=date("Y-m-d H:i:s");//date et heure de connexion  

if($login!='igoua')
	{
$sql1="SELECT * FROM users WHERE login_user='".$login."'";
$requete1 = mysql_query($sql1);
$result=mysql_fetch_array($requete1);

		if($result['actif_user']==1)
		{
		$sql2 = "UPDATE users SET statut_con='0', actif_user='0' WHERE login_user='".$login."'";
		  //exécution de la requête:
		  $requete2 = mysql_query( $sql2) or die(mysql_error());//mise à jour d'un user après deconnexion
			echo "<script>redirection();</script>";
			}
		else if($result['actif_user']==0)
		{
		$sql2 = "UPDATE users SET actif_user='1' WHERE login_user='".$login."'";
		  //exécution de la requête:
		  $requete2 = mysql_query( $sql2) or die(mysql_error());//mise à jour d'un user après deconnexion
			echo "<script>redirection();</script>";	
			}
	}
	else{echo "<script>redirection();</script>";}

}
?>
