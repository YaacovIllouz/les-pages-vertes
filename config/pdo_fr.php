<?php
$host   = (string) '185.2.4.98';
//$host   = (string) 'AMEN';
$user   = (string) 'p12p7dm7_patrick';
$pass   = (string) 'Dib0807@';
$dbname = (string) 'p12p7dm7_lespa580653';


try{
    $db_fr = new PDO("mysql:host=".$host.";dbname=".$dbname."","".$user."" ,"".$pass."");
    //$db_fr->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}

catch (Exception $e){
    //throw new Exception('Erreur de connexion au serveur et/ou a la base de donnees', 0, $e->getMessage());  
	die('Erreur : '.$e->getMessage());
}
  
?>