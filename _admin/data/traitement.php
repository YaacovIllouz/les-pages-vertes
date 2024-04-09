		
<?php
//Numéro de la région
if(isset($_POST["region"]) && $_POST["region"] != 'vide'){
/*Si la variable $include n'existe pas c'est que le numéro de la région passe par AJAX. On a donc besoin d'avoir une connexion avec la base de données.*/
/*Quand on poste le formulaire, cette page est inclue directement dans le div "blocDepartements", donc la connexion est inutile.*/
/*Si on inlcue cette page au moment de la validation, c'est uniquement pour garder la sélection "selected" de la liste.*/
if(!isset($include)){
//On indique le Content-Type utilisé
header('Content-Type: text/html; charset="iso-8859-1"');
 
/*Variable de connexion BDD ON LINE
$nom_du_serveur ="mysql.hostinger.fr";
$nom_de_la_base ="u785734213_pages";
$nom_utilisateur ="u785734213_root";
$passe ="sql@2014";*/
 

 
//Variable de connexion BDD en local
$nom_du_serveur ="localhost";
$nom_de_la_base ="pagesvertes";
$nom_utilisateur ="root";
$passe ="sql@"; 
 
//Connexion à la base de données
mysql_connect("$nom_du_serveur","$nom_utilisateur","$passe");
//Vérification d'accès à la base de données
mysql_select_db("$nom_de_la_base") or die ('Erreur :'.mysql_error());

}

?>
 
<select name="departement" id="departement" data-placeholder="Choisir une rubrique" class="select_contrat">
<option value="vide">- - - Choisissez un rubrique - - -</option>
<?php
//On sélectionne les départements en fonction du numéro de la région
$selectdepartement = mysql_query("SELECT * FROM rubrique WHERE id_categ=".mysql_real_escape_string($_POST["region"])." ORDER BY libelle") or die (mysql_error());
//On boucle
while($donnees = mysql_fetch_assoc($selectdepartement))
{?>
<option value="<?php echo $donnees['id'];
if(isset($_POST["departement"]) && $_POST["departement"]==$donnees['id']){ echo " selected"; }?>"><?php echo $donnees['libelle'];?></option>
<?php } 
?>
</select><br/>
<?php } ?>