<?php 

session_start();
include("../Connections/annuaire.php");


if(($_SESSION['login']) && ($_SESSION['password'])){

			
			mysql_select_db($database_annuaire, $annuaire);	
 		 	//header("Location:accueil.php");
			$sql_user= "SELECT * FROM lespa580653.users WHERE login_user = '".$_SESSION['login']."' LIMIT 1";
			//echo $sql_user;
			
			$exe_findU=@mysql_query($sql_user);
			
			$myuser=mysql_fetch_object($exe_findU);
			#### MISE EN SESSION DE VALEUR POUR LE USER CONNECTE
			
			$_SESSION['login_user']=$myuser->login_user;
			$_SESSION['pwd']=$myuser->pass_user;
			$_SESSION['nom_user']=$myuser->nom_user;
			$_SESSION['pren_user']=$myuser->pren_user;
			$_SESSION['date_last']=$myuser->date_decon;
			
			if($_SESSION['date_last']=="0000-00-00 00:00:00"){
				$_SESSION['date_last']=$dat_con; }
					
			$_SESSION['id_profil']=$myuser->id_profil;							
			$_SESSION['avatar']=$myuser->avatar_user;
			$_SESSION['idsecur']=$myuser->idsecure;
			$_SESSION['user_email']=$myuser->email_user;		
			$_POST['go']='';
			### FIN SESSION		

echo '<script language="Javascript">
				<!--
				window.location.href="data/accueil.php";
				// -->
				</script>';}

else {
header ("Location: securite/index.php"); }
