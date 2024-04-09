<head>
<script type="text/javascript">
function writediv(texte)
{
document.getElementById('loginbox').innerHTML = texte;
}

function verifsigle(sigle)
{
if(sigle != '')
{
if(sigle.length<2)
writediv('<span style="color:#cc0000; font-size:14px"><b>'+sigle+' :</b> Sigle trop court</span>');
else if(sigle.length>15)
writediv('<span style="color:#cc0000; font-size:14px"><b>'+sigle+' :</b> Sigle est trop long</span>');
else if(texte = file('../../verif_sigle.php?sigle_ste='+escape(sigle)))
{
if(texte == 1)
writediv('<span style="color:#cc0000; font-size:14px"><b>'+sigle+' :</b> Sigle d&eacute;j&agrave; r&eacute;f&eacute;renc&eacute;</span>');
else if(texte == 2)
writediv('<span style="color:#1A7917; font-size:14px"><b>'+sigle+' :</b> Sigle non r&eacute;f&eacute;renc&eacute;</span>');
else
writediv(texte);
}
}

}

function file(fichier)
{
if(window.XMLHttpRequest) // FIREFOX
xhr_object = new XMLHttpRequest();
else if(window.ActiveXObject) // IE
xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
else
return(false);
xhr_object.open("GET", fichier, false);
xhr_object.send(null);
if(xhr_object.readyState == 4) return(xhr_object.responseText);
else return(false);
}
</script>

<script type="text/javascript" src="fonctions.js"></script>
</head>
 
<body>
 
<div id="centre" class="div_princ_ref">

<table width="100%" border="0">
  <tr>
    <td width="42%" align="left"><h3 class="titre_page">
  AJOUT D'UNE NOUVELLE REFERENCE
</h3></td>
    <td width="25%" align="center"><?php echo $msge.' '.$erreur;?></td>
    <td width="33%" align="right"><a href="accueil.php?page=?.liste_ref" class="ajout">[Liste des r&eacute;f&eacute;rencements]</a></td>
  </tr>
</table>

<!-- NEW BLOCK -->

<form name="frm_bien" method="post" action="" enctype="multipart/form-data">
<fieldset class="fieldset_1">
<legend class="info_zone">Informations de base</legend>
<table width="99%" border="0" align="center"  cellspacing="8">

<tr>
    <td height="59" class="font_tab">&nbsp;Cat&eacute;gorie : </td>
    <td>
    <select name="region" id="region" onChange="Departements(this.value);">
<option value="vide">- - - Choisissez une région - - -</option>
<?php
//Variable de connexions BDD
$nom_du_serveur ="localhost";
$nom_de_la_base ="pagesvertes";
$nom_utilisateur ="root";
$passe ="sql@";
 
//Connexion à la base de données
mysql_connect("$nom_du_serveur","$nom_utilisateur","$passe");
//Vérification d'accès à la base de données
mysql_select_db("$nom_de_la_base")  or die ('Erreur :'.mysql_error());
 
//On sélectionne toutes les régions
$selectregion = mysql_query("SELECT * FROM categorie ORDER BY libelle") or die (mysql_error());
while($donnees = mysql_fetch_array($selectregion))
{
    echo '<option value="'.$donnees['id'].'"';
    if(isset($_POST["region"]) && $_POST["region"]==$donnees['id']){echo " selected";}
    echo '>'.$donnees['libelle'].'</option>';
}
?>
</select></td>
  </tr>
  <tr>
    <td height="59" class="font_tab">&nbsp;Rubrique : </td>
    <td>
    <div id="blocDepartements">
<?php
/*Pour garder la sélection de la seconde liste, on l'inclue directement dans la page lors de la validation du formulaire*/
if(isset($_POST['region'])){
//on créer une variable utilisé dans la page "traitement.php"
$include = 1;
//on inclue la page
include('traitement.php');
}
?>
</div>
    </td>
  </tr> 
<tr>
    <td width="36%" height="55" class="font_tab">&nbsp;Sigle : </td>
    <td width="64%">
    <input type="text" name="sigle" class="champ_zonea" placeholder="Votre sigle" id="sigle" accesskey="t" tabindex="1" value=""  maxlength="25" onKeyUp="verifsigle(this.value)" required autocomplete="off"/>&nbsp;<span id="loginbox"></span>
    </td>
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;D&eacute;nomination : </td>
    <td><input type="text" name="denomi" class="champ_zonec" placeholder="Votre d&eacute;nomination compl&egrave;te" required autocomplete="off"/></td>
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;Dirigeant d'Entreprise 1 :</td>
    <td><input type="text" name="dirigeant1" class="champ_zonec" placeholder="Votre 1er dirigeant" required autocomplete="off"/></td>
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;Dirigeant d'Entreprise 2 :</td>
    <td><input type="text" name="dirigeant2" class="champ_zonec" placeholder="Votre 2&egrave;me dirigeant" autocomplete="off"/></td>
    
  </tr>
  <tr>
   <td height="45" class="font_tab">&nbsp;Marque :</td>
    <td><input type="text" name="marque" class="champ_zoneb" placeholder="Votre marque" autocomplete="off"/></td> 
  </tr>
  <tr>
   <td height="45" class="font_tab">&nbsp;Activit&eacute;s Principales :</td>
    <td><textarea name="activite" cols="40" rows="8" required class="textarea_insertb" placeholder="D&eacute;crivez vos activit&eacute;s principales"></textarea></td> 
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;Votre logo (100x95)</td>
    <td><input type="file" name="logo"></td>
  </tr>
</table>
</fieldset>
<br>
<fieldset class="fieldset_1">
<legend class="info_zone">Informations Contacts</legend>
<table width="95%" border="0" align="center"  cellspacing="8"> 
<tr>
    <td width="30%" height="55" class="font_tab">&nbsp;T&eacute;l&eacute;phone : </td>
    <td width="70%">
    <input type="text" name="tel" class="champ_zoneb" placeholder="Votre t&eacute;l&eacute;phone" autocomplete="off" required/>
    </td>
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;Fax : </td>
    <td><input type="text" name="fax" class="champ_zoneb" placeholder="Votre fax" autocomplete="off"/></td>
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;Cel :</td>
    <td><input type="text" name="cel" class="champ_zoneb" placeholder="Votre mobile" autocomplete="off"/></td>
   
  </tr>
  <tr>
    <td height="45" class="font_tab">&nbsp;E-mail :</td>
    <td><input type="email" name="email" class="champ_zoneb" placeholder="Votre email" required autocomplete="off"/></td>
    
  </tr>
  <tr>
    <td height="59" class="font_tab">&nbsp;Site internet : </td>
    <td><input type="text" name="site" class="champ_zoneb" placeholder="http://www.votresite.ext" value="http://" autocomplete="off"/></td>
    
  </tr>
  <tr>
   <td height="45" class="font_tab">&nbsp;Adresse Succursale</td>
    <td><textarea name="adr_suc" cols="40" rows="8" class="textarea_insertb" placeholder="Adresse de votre succursale"></textarea>
</td> 
  </tr>
</table>
</fieldset>
<br>
<div><input type="submit" name="valider" class="valider" value="Valider" /></div>

</form>
</div>
 
</body>
