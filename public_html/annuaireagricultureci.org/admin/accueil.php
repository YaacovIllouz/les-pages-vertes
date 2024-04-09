<?php 
    require_once('../Connections/annuaire.php');	
?>
<div style="padding:10px;">
<h3>Bienvenue dans la zone d'administration des pages vertes : version française</h3>
</div>

<div style="padding:10px;">
<!-- www.webtutoriaux.com Compteur de visiteurs 
Jusqu'à présent, il y a eu : 
<script type='text/javascript' src='http://www.webtutoriaux.com/services/compteur-visiteurs/index.php?client=156686'></script> visiteurs sur cette page.
<!-- End Compteur de visiteurs -->
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
  echo '<div style="margin-left:30px"><strong>' . $donnees['nbre_entrees'] . '</strong> visiteur connecté</div>';
}
else
{
  echo '<div style="margin-left:30px"><strong>' . $donnees['nbre_entrees'] . '</strong> visiteurs connectés</div>';
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
