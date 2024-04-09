<?php
// traitement de la variable .
$message=$_POST['specif'];
$txt =htmlentities($message);
$txt =preg_replace('`\\\n`','<br>\n',$txt);//eregi_replace
$txt =preg_replace('`\\\'`',"'",$txt);//eregi_replace
$txt =addslashes($txt);
$message=$txt;
// fichier de reket

$sql_user= "SELECT * FROM users WHERE login_user = '".$_SESSION['login']."' AND actif_user=1 LIMIT 1";

$sql_agence= "SELECT * FROM agence WHERE code_ag = '".$_SESSION['code_ag']."' LIMIT 1";

$sql_profil= "SELECT * FROM profil WHERE id = '".$_SESSION['id_profil']."' LIMIT 1";

$sql_Lagence= "SELECT * FROM agence ORDER BY libelle_ag";

$sql_Lprofil= "SELECT * FROM profil ORDER BY libelle_profil";


$sql_1='SELECT * FROM `users` WHERE `id_user` LIKE CONVERT( _utf8 "'.$_POST['pseudo'].'" USING latin1 ) COLLATE latin1_swedish_ci AND `pass_user` LIKE CONVERT( _utf8 "'.(md5($_POST['pass'])).'" USING latin1 ) COLLATE latin1_swedish_ci AND `id_ent` ='.$_POST['entite'].' AND `actif_user` =1';

$sql_up='SELECT * FROM `users` WHERE `login_user`="'.$_SESSION['pseudo'].'" AND `actif_user` =1';

$sql_up_pass='SELECT * FROM `users` WHERE `idsecure` LIKE CONVERT( _utf8 "'.$_GET['id_user'].'" USING latin1 ) COLLATE latin1_swedish_ci AND `actif_user` =1';


$sql_2="UPDATE `users` SET `date_deconn` = '".$date_day."' WHERE login_user ='".$_SESSION['login']."' LIMIT 1 ;";

// Requete select entite
$sql_ent="SELECT * FROM entite ORDER BY nom_ent ASC ";
$find_ent="SELECT nom_ent FROM entite WHERE id_ent='".$_SESSION['entite']."' ";

// Requete select type_contact
$sql_Tctt="SELECT * FROM type_contact";

// Requete select contact
$sql_CTT="SELECT * FROM contact";
$sql_CTT1="SELECT * FROM contact AS a, societe AS b ";

// Requete select type_event
$sql_Tevent="SELECT * FROM type_event";


// Requete select type_event
$sql_event="SELECT * FROM event";

// Requete select secteur
$sql_str="SELECT * FROM secteur ";

// Requete select société
$sql_ste="SELECT * FROM societe ";

// Requete select utilisateur
$sqlopera="SELECT * FROM admin ";

// Requete select article
$sqlart="SELECT * FROM article";

// Requete select connexion user
$sqlvie_cpt="SELECT * FROM vie_compte";

/////////////#############################
////STATISTIQUES ///////
//pour visites
$sqlvisi="SELECT * FROM `visiteurs` ";
$sqlconn="SELECT * FROM connectes";
//fin stat article

//SQL STAT SUR CLIENT
$sqlcltnoactiv="SELECT * FROM `client` WHERE `active_clt` ='0'  AND `susp_clt` ='0' AND `dat_inscri_clt` ='0000-00-00 00:00:00'";
$sqlcltactiv="SELECT * FROM `client` WHERE `active_clt` ='1'  AND `susp_clt` ='0' AND `dat_inscri_clt` ";
$sqlcltdesactiv="SELECT * FROM `client` WHERE `active_clt` ='0'  AND `susp_clt` ='0' AND `dat_inscri_clt` <>'0000-00-00 00:00:00'";
$sqlcltsusp="SELECT * FROM `client` WHERE `active_clt` ='0'  AND `susp_clt` ='1'";

//FIN

//SQL STAT SUR LES PRODUITS
$sqlprdactiv="SELECT * FROM `produit` WHERE `statut_prod` ='Activé' ";
$sqlprdnoactiv="SELECT * FROM `produit` WHERE `statut_prod` ='Désactivé' ";
$morfamprd="SELECT `famille_prod` , COUNT(famille_prod) 
FROM `produit` 
GROUP BY `famille_prod` 
ORDER BY `COUNT(famille_prod)` DESC ";

//FIN

//SQL STAT SUR LES COMMANDES
$morstatcmd="SELECT `statut_cmd` , COUNT(statut_cmd) 
FROM `commande` 
GROUP BY `statut_cmd` 
ORDER BY `COUNT(statut_cmd)` DESC ";

$sqlmaxmnt="SELECT MAX(mnt_cmd) 
FROM `commande` 
ORDER BY `mnt_cmd` DESC";

//FIN


//pour presse
$sqlpresse="SELECT * FROM `presse` ";
$sqlpresseno="SELECT * FROM `presse` WHERE `en_ligne` ='non' ";
$sqlpresseok="SELECT * FROM `presse` WHERE `en_ligne` ='oui' ";
$morstat="SELECT `jrnal_presse` , COUNT(jrnal_presse) 
FROM `presse` 
GROUP BY `jrnal_presse` 
ORDER BY `COUNT(jrnal_presse)` DESC ";
//fin stat presse

//Pour best product
$sql_best="SELECT ref_prod, titre, COUNT(ref_prod) FROM `ligne_commande`
GROUP BY (ref_prod)
ORDER BY COUNT(ref_prod) DESC";

//Pour paiement ok
$sql_paie_ok="SELECT valid_paie,COUNT(valid_paie) FROM `paiement`
WHERE valid_paie='1'";

//Pour paiement no_ok
$sql_paie_no="SELECT valid_paie,COUNT(valid_paie) FROM `paiement`
WHERE valid_paie='0'";

//Best customer in paiement
$sql_best_cust="SELECT email_clt,COUNT(email_clt) FROM `paiement`
GROUP BY `email_clt` 
ORDER BY `COUNT(email_clt)` DESC ";

?>