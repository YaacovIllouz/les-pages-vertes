<?php 
session_start();
include("../../Connections/annuaire.php");
//include("../_connexion/link_bd.php");
//include("../../_sql/1.php");
$_SESSION['login']=$_POST['login'];
$_SESSION['password']=$_POST['password'];

?>
<?php
if($_GET['logout']==101){
	//Marquage derniere connexion
	$date_day=date("Y-m-d H:i:s");
	$sql_2="UPDATE `users` SET `date_deconn` = '".$date_day."' WHERE login_user ='".$_SESSION['login']."' LIMIT 1 ;";
	mysql_query($sql_2);
	// Détruit toutes les variables de session
	session_unset();
	// Finalement, détruit la session
	session_destroy();
	
	header ("Location: ../index.php");
}

?>
<?php

if ($_POST['connect']) // Si la variable existe
	{
	$log = $_SESSION['login'];
	$pwd = md5($_SESSION['password']);
	 
	//$pwd2=($pwd);
	
	//echo $log.' '.$pwd.'<br>';
	//$www="accueil.php";
	$req=mysql_query("SELECT * FROM users WHERE login_user='".$log."' AND pass_user='".$pwd."' ");
	//echo ("SELECT * FROM users WHERE login_user='".$log."' AND pass_user='".$pwd."' ");
	$tab=mysql_fetch_array($req);
	$nbre=mysql_num_rows($req);
	//echo $nbre;
	
		if ($nbre==1)		
			{
				
				
				if($tab['actif_user']!=1){
					$msge="[--- Echec de l'authentification ---]<br/> Vous n'êtes plus actif, veuillez contacter votre hierarchie";
					include("auth.php");
							}
			
			else
			
			mysql_select_db($database_annuaire, $annuaire);	
 		 	//header("Location:accueil.php");
			$sql_user= "SELECT * FROM users WHERE login_user = '".$log."' LIMIT 1";
			//echo $sql_user;
			
			$exe_findU=@mysql_query($sql_user);
			$nbre_user=@mysql_num_rows($exe_findU);
			$_SESSION['nombre'] = $nbre_user;
			
			//if($nbre_user==1)
			$dat_con=date("Y-m-d H:i:s");//date et heure de connexion
			$exe_majU=mysql_query("UPDATE users SET statut_con='1', date_con='".$dat_con."' where (login_user='".$log."');");//mise à jour du statut de connexion du user
			//echo $exe_majU;
			
			$myuser=mysql_fetch_object($exe_findU);
			#### MISE EN SESSION DE VALEUR POUR LE USER CONNECTE
			
			$_SESSION['login_user']=$myuser->login_user;
			$_SESSION['pwd']=$myuser->pass_user;
			$_SESSION['nom_user']=$myuser->nom_user;
			$_SESSION['pren_user']=$myuser->pren_user;
			$_SESSION['date_last']=$myuser->date_decon;
			
			if($_SESSION['date_last']=="0000-00-00 00:00:00"){
				$_SESSION['date_last']=$dat_con;
															}
					
			$_SESSION['id_profil']=$myuser->id_profil;							
			$_SESSION['avatar']=$myuser->avatar_user;
			$_SESSION['idsecur']=$myuser->idsecure;
			$_SESSION['user_email']=$myuser->email_user;		
			$_POST['go']='';
			### FIN SESSION
			
			echo '<script language="Javascript">
				<!--
				window.location.href="../data/accueil.php";
				// -->
				</script>';
				/*include 'admin_accueil.php';*/
			
								

			}
			else{
		$msge="[--- Echec de l'authentification ---]<br/> Login/Mot de passe incorrecte.";
		include("auth.php");}
				
}

else{
		include("auth.php");	
}

?>
<style type="text/css">
.footer{ font-family:Verdana, Geneva, sans-serif; color:#666; font-size:12px}
</style>
<br />
<div id="footer-left2" align="center"> [:. <a href="../../index.php" target="_blank" class="footer"> Acc&egrave;s direct &agrave; l'annuaire pagesvertesci</a> .:]</div>
<br /><br />
<!--  start footer-left -->
	<div id="footer-left" align="center">
    Copyright &copy; <font style="font-size:11px">LESPAGESVERTESCI</font>, 2013-<?php echo date("Y");?>. Tous  droits r&eacute;serv&eacute;s.
  </div>
	<!--  end footer-left -->
