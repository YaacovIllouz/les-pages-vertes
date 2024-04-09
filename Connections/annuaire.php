<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_annuaire = "185.2.4.98 ";
$database_annuaire = "p12p7dm7_lespa580653";
$username_annuaire = "p12p7dm7_patrick";
$password_annuaire = "Dib0807@";

$annuaire = mysql_connect($hostname_annuaire, $username_annuaire, $password_annuaire) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_annuaire);
?>