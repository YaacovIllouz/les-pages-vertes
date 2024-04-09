<?php require_once('../_connexion/link_bd.php'); ?>
<?php
/*mysql_connect($hostname_BDD, $username_BDD, $password_BDD);
mysql_select_db($database_BDD);*/

$result = mysql_query("SELECT sigle FROM entreprise WHERE sigle ='".addslashes($_GET["sigle"])."'");
if(mysql_num_rows($result)>=1)
echo "1";
else
echo "2";
?>