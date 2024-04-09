<?php

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM annonce WHERE Id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($deleteSQL, $annuaire) or die(mysql_error());
  echo 'Annonce supprimée avec succès';
}
?>
<p><a href="index.php?page=all_annonce">Retour</a></p>
