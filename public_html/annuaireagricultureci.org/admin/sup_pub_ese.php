<?php
if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM pub WHERE Id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($deleteSQL, $annuaire) or die(mysql_error());
  echo 'Suppression effectuée avec succès';
}
?>
<p><a href="javascript:history.back()">Retour</a></p>
