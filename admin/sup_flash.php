<?php

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM flash WHERE Id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_annuaire, $annuaire);
  $Result1 = mysql_query($deleteSQL, $annuaire) or die(mysql_error());
  echo 'Flash supprimé avec succès';
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Document sans titre</title>
</head>
<body>
<p><a href="index.php?page=all_flash">Retour</a></p>
</body>
</html>