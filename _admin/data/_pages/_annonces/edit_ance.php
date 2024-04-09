<?php

$id=$_GET['com'];
//-------------- -------------------//
$rqt1="SELECT * from annonce WHERE Id = '".$id."' ";
       $result1 = mysql_query($rqt1);
    $result=mysql_fetch_array($result1);
//--------------- -----------------//



$societe = addslashes($_POST['societe']);
$nom = addslashes($_POST['nom']);
$tel = addslashes($_POST['tel']);
$email = $_POST['email'];
$titre = addslashes(($_POST['titre']));
$annonce = addslashes(($_POST['annonce']));


if($_POST['valider'])
{
	
	$modif = "UPDATE annonce SET titre='".$titre."', contenu='".$annonce."', contact='".$tel."', email='".$email."', nom='".$nom."', entreprise='".$societe."' WHERE Id='".$id."' ";
	
	//echo $modif;

	$exe_update = mysql_query($modif);
	
			if($exe_update)
			{
				
				$msge = '<font class="confirm">&nbsp;VOTRE ANNONCE A ETE MODIFIEE.</font>';
				$msge.='<meta http-equiv=refresh content="3; url=?page=?.liste_ance">';
				
				}
			else
			 {
				 $msge = '<font class="refuse">&nbsp;IMPOSSIBLE DE MODIFIER CETTE ANNONCE</font>';
				 
	}
	
 }
?>

<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<body>
<div class="div_princ_ref">
<table width="100%" border="0">
  <tr>
    <td width="31%" align="left"><h3>
  MODIFICATION D'UNE ANNONCE
</h3></td>
    <td width="36%" align="center"><?php echo $msge.' '.$erreur;?></td>
    <td width="33%" align="right"><a href="accueil.php?page=?.liste_ance" class="ajout">[Liste des annonces]</a></td>
  </tr>
</table>

        <form name="frm_bien" method="post" action="" enctype="multipart/form-data">
          <fieldset class="fieldset_1">
            <legend class="info_zone">Informations annonce</legend>
            <table width="60%" border="0" align="center"  cellspacing="6">
              <tr>
                <td width="32%" height="55" class="font_tab">&nbsp;Structure : </td>
                <td width="68%"><input type="text" name="societe" class="champ_zoneb" placeholder="Votre nom ou structure" required autocomplete="off" autofocus value="<?php if($_POST['societe']) {echo $_POST['societe'];} else {echo $result['entreprise'];};?>" style="width:500px"/></td>
              </tr>
              <tr>
                <td width="32%" height="55" class="font_tab">&nbsp;Nom : </td>
                <td width="68%"><input type="text" name="nom" class="champ_zoneb" placeholder="Votre nom ou structure" required autocomplete="off" autofocus value="<?php if($_POST['nom']) {echo $_POST['nom'];} else {echo $result['nom'];};?>" /></td>
              </tr>              
              <tr>
                <td width="32%" height="55" class="font_tab">&nbsp;T&eacute;l&eacute;phone : </td>
                <td><input type="text" name="tel" class="champ_zoneb" placeholder="Votre t&eacute;l&eacute;phone" required autocomplete="off" value="<?php if($_POST['tel']) {echo $_POST['tel'];} else {echo $result['contact'];};?>"/></td>
              </tr>
              <tr>
                <td height="45" class="font_tab">&nbsp;E-mail :</td>
                <td><input type="email" name="email" class="champ_zoneb" placeholder="Votre adresse electronique" autocomplete="off" value="<?php if($_POST['email']) {echo $_POST['email'];} else {echo $result['email'];};?>" /></td>
              </tr>
              <!--<tr>
                <td height="59" class="font_tab">&nbsp;Que souhaitez-vous faire?</td>
                <td><select name="qsfaire" id="categorie" class="champ_insertb">
                  <option value="">-- Que souhaitez-vous faire? --</option>
                  <option value="VENTE/OFFRE" <?php //if(($_POST['qsfaire']=="VENTE/OFFRE")||($result['qsfaire']=="VENTE/OFFRE")) echo 'selected';?>>VENTE/OFFRE</option>
                  <option value="RECHERCHE/DEMANDE" <?php //if(($_POST['qsfaire']=="RECHERCHE/DEMANDE")||($result['qsfaire']=="RECHERCHE/DEMANDE")) echo 'selected';?>>RECHERCHE/DEMANDE</option>
                </select></td>
              </tr>-->
              <tr>
                <td height="59" class="font_tab">&nbsp;Titre annonce : </td>
                <td><input type="text" name="titre" class="champ_zoneb" style="width:400px" placeholder="Titre de votre annonce" required autocomplete="off" value="<?php if($_POST['titre']) {echo $_POST['titre'];} else {echo $result['titre'];};?>"/></td>
              </tr>
              <tr>
                <td height="45" class="font_tab">&nbsp;Votre annonce :</td>
                <td><textarea name="annonce" placeholder="Ecrivez votre annonce" style="width:400px" cols="100" rows="6"><?php if($_POST['annonce']) {echo $_POST['annonce'];} else {echo $result['contenu'];};?></textarea></td>
              </tr>

              <tr>
                <td height="55" colspan="2" class="font_tab"><div><input type="submit" name="valider" class="valider" value="Modifier" /></div></td>
              </tr>
            </table>
          </fieldset>
          <br>
          
      </form>
        <br>
</div>

</body>