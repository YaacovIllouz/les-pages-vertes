
<script language="javascript">
<!--
function redirection()
{
	document.location.href = "accueil.php?page=?.liste_pubhaut";
}
//-->
</script>


<?php
//récupération de la variable d'URL,
//qui va nous permettre de savoir quel utilisateur dont il faut mettre à jour sa date de deconnexion
$id = $_GET['com']; 
//echo 'okok';
//exit();
if($id)
	{
$sql1="SELECT * FROM pub WHERE id_pub='".$id."'";
$requete1 = mysql_query($sql1);
$result=mysql_fetch_array($requete1);

$date_mod = date('Y-m-d H:s:i');

		if($result['flag_default']==0)
		{
		$sql2 = "UPDATE pub SET flag_default='1', login_user='".$_SESSION['login_user']."' WHERE id_pub='".$id."'";
		  //exécution de la requête:
		  $requete2 = mysql_query( $sql2) or die(mysql_error());//mise à jour d'un user après deconnexion
		  
		  $sql_up = "UPDATE pub SET flag_default='0', login_user='".$_SESSION['login_user']."' WHERE id_pub <>'".$id."' AND emplct_pub='HAUT' ";
		  //exécution de la requête:
		  $requete_up = mysql_query( $sql_up) or die(mysql_error());//mise à jour d'un après choix
		  
			echo "<script>redirection();</script>";	
			}
	}
	else{echo "<script>redirection();</script>";}
?>
