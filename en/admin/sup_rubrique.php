<?php

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM rubrique WHERE Id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($deleteSQL, $annuaire) or die(mysql_error());
  echo "la rubrique a été supprimée";
}
?>
<p>&nbsp;</p>
<a href="index.php?page=liste_rubrique">Retour</a>