<?php

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM pub_site WHERE Id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($deleteSQL, $annuaire) or die(mysql_error());
  echo 'Publicité supprimé avec succès';
}
?>
<br>
<p><a href="index.php?page=ajout_pub_accueil">Retour</a></p>