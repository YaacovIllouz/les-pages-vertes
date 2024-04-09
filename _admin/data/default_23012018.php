<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body {
	background-color: #F9FDF7;
}
</style>
</head>

<body>
<?php 
    require_once('../../Connections/annuaire.php');	
?>

<div style="padding:10px;">
<h3>Compteur de visite : </h3>
</div>

<?php
//Voici le code PHP :

// Connexion à MySQL  
$timestamp_5min = time() - (60 * 5); // 60 * 5 = nombre de secondes écoulées en 5 minutes
$retour = mysql_query('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE timestamp>\'' . $timestamp_5min . '\'');
$donnees = mysql_fetch_array($retour);
  
if (($donnees['nbre_entrees'] == 0)||($donnees['nbre_entrees'] == 1) )// respect du singulier
{
  echo '<div style="margin-left:30px"><strong>' . $donnees['nbre_entrees'] . '</strong> visiteur connect&eacute;</div>';
}
else
{
  echo '<div style="margin-left:30px"><strong>' . $donnees['nbre_entrees'] . '</strong> visiteurs connect&eacute;s</div>';
}
  
$jour = date('d');
$mois = date('m');
$annee = date('Y');
$aujourd_hui = mktime(0, 0, 0, $mois, $jour, $annee);
$retour = mysql_query('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE timestamp>\'' . $aujourd_hui . '\'');
$donnees = mysql_fetch_array($retour);
  
if ($donnees['nbre_entrees'] == 1)// respect du singulier
{
  echo '<div style="margin-left:30px"><strong>' . $donnees['nbre_entrees'] . '</strong> visiteur aujourd\'hui</div>';
}
else
{
echo '<div style="margin-left:30px"><strong>' . $donnees['nbre_entrees'] . '</strong> visiteurs aujourd\'hui</div>';
} 
  
$retour = mysql_query('SELECT COUNT(*) AS nbre_entrees FROM connectes');
$donnees = mysql_fetch_array($retour);
  
echo '<div style="margin-left:30px"><strong>' . $donnees['nbre_entrees'] . '</strong> visites au total</div>';
  
?>

<div align="center">
<br />
  <br />
  <br />
<img src="../images/welcome2.jpg" width="845" height="360" /></div>
</body>
</html>