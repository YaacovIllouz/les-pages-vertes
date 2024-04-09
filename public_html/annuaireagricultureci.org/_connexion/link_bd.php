<?php
/***********************************************************/

/***********************************************************
				Connexion à la base en ligne
***********************************************************

/*$host   = (string) '91.216.107.161';
$user   = (string) 'lespa580653';
$pass   = (string) 'fJGGACgQ';
$dbname = (string) 'lespa580653';


**********************************************************/
				/*Connexion à la base*/			

$hostname_annuaire = (string) '91.216.107.161';
$username_annuaire = (string) 'lespa580653';
$database_annuaire = (string) 'lespa580653';
$password_annuaire = (string) 'fJGGACgQ@';


$annuaire = mysql_connect($hostname_annuaire, $username_annuaire, $password_annuaire) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_annuaire);

?>

