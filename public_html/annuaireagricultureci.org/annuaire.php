<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_annuaire = "lhcp1098.webapps.net";
$database_annuaire = "p12p7dm7_patrick";
$password_annuaire = "Dib0807@";

//$annuaire = mysql_connect($hostname_annuaire, $username_annuaire, $password_annuaire) or trigger_error(mysql_error(),E_USER_ERROR);

if($bdd = mysqli_connect($hostname_annuaire, $username_annuaire, $password_annuaire, $database_annuaire))
{
	// Si la connexion a réussi, rien ne se passe.
	echo 'connexion reussie<br>';
}
else // Mais si elle rate…
{
	echo 'Erreur, impossible de se connecter'; // On affiche un message d'erreur.
}


mysqli_close($bdd);
?>