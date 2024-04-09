<?php { session_start();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript">
<!--
function redirection()
{
	document.location.href = "accueil.php?page=?.liste_pubsite";
}
//-->
</script>


<?php
//Activation et Desactivation de pub

$secure_code = $_GET['id'];
$date_decon=date("Y-m-d H:i:s");//date et heure de connexion  
$table="pub_site";

$sql1="SELECT * FROM $table WHERE Id ='".$secure_code."'";
$exe_reqpub = mysql_query($sql1);
$result=mysql_fetch_array($exe_reqpub);
//$result=mysqli_fetch_array($requete1);

		if($result['defilant']==1)
		{
		$sql2 = "UPDATE $table SET defilant='0' WHERE Id = '".$secure_code."'";
		  //ex&eacute;cution de la requête:
		  $exe_reqpub = mysql_query($sql2);
			echo "<script>redirection();</script>";
			}
		else if($result['defilant']==0)
		{
		$sql2 = "UPDATE $table SET defilant='1' WHERE Id = '".$secure_code."'";
		  //ex&eacute;cution de la requête:
		  $exe_reqpub = mysql_query($sql2);
			echo "<script>redirection();</script>";	
			}
	}
?>
