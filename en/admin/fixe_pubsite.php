<?php { session_start();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript">
<!--
function redirection()
{
	document.location.href = "index.php?page=ajout_pub_accueil";
}
//-->
</script>


<?php
//Activation et Desactivation de pub

$secure_code = $_GET['id'];
$date_decon=date("Y-m-d H:i:s");//date et heure de connexion  
$table="pub_site";

$sql1="SELECT * FROM $table WHERE Id ='".$secure_code."'";
$result = $db->query($sql1)->fetch();
//$result=mysqli_fetch_array($requete1);

		if($result['fixe']==1)
		{
		$sql2 = "UPDATE $table SET fixe='0' WHERE Id = '".$secure_code."'";
		  //ex&eacute;cution de la requête:
		  $db->query($sql2);
			echo "<script>redirection();</script>";
			}
		else if($result['fixe']==0)
		{
		$sql2 = "UPDATE $table SET fixe='1' WHERE Id = '".$secure_code."'";
		  //ex&eacute;cution de la requête:
		  $db->query($sql2);
		  
		$sql3 = "UPDATE $table SET fixe='0' WHERE Id != '".$secure_code."' AND position = 'milieu' ";
		  //ex&eacute;cution de la requête:
		  $db->query($sql3);		  
			echo "<script>redirection();</script>";	
			}
	}
?>
