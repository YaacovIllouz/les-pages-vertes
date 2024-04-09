<?php { session_start();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript">
<!--
function redirection()
{
	document.location.href = "index.php";
}
//-->
</script>

<?php

    require_once('../Connections/annuaire.php');	

	//$_SESSION = array();	
	
	$date_day = date("Y-m-d H:i:s");
	$sql_2="UPDATE users SET date_decon = ".$date_day." WHERE login_user = ".$_SESSION['login_user']."";
	//echo $sql_2;
	mysql_query($sql_2);
	//exit();
	session_unset();
	session_destroy();
	echo "<script>redirection();</script>";
	//header('Location:index.php');
	
}
?>  