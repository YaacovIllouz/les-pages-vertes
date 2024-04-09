<?php
//-------------- -------------------//
$rqt1="SELECT * from annonce WHERE flag_anc = 0 ORDER BY date_ance DESC LIMIT 0 ,10";
       $result1 = mysql_query($rqt1);
    $nbTsal=mysql_num_rows($result1);
//--------------- -----------------//



$societe = addslashes($_POST['societe']);
$nom = addslashes($_POST['nom']);
$tel = addslashes($_POST['tel']);
$email = $_POST['email'];
$titre = addslashes(($_POST['titre']));
$annonce = addslashes(($_POST['annonce']));
$date_crea=date('Y-m-d H:s:i');
$date_crea=date('Y-m-d H:s:i',strtotime($date_crea));



if($_POST['valider'])
{
	$check_ance=mysql_query("SELECT * FROM annonce WHERE entreprise='".$societe."' AND titre='".$titre."' ");
	$nbre_ance = mysql_num_rows($check_ance);
	
	if($nbre_ance==0) {
	
	$insertion = "INSERT INTO annonce VALUES
('', 
'".$nom."', 
'".$societe."', 
'".$tel."', 
'".$email."', 
'".$titre."', 
'".$annonce."', 
'".$date_crea."', 
'')";
	
	//echo $insertion;
	$defnumber=1;
	$exe_insert = mysql_query($insertion);
	
			if($exe_insert)
			{
				
				$msge = '<font class="confirm">&nbsp;VOTRE ANNONCE A ETE ENREGISTREE.</font>';
				
				}
			else
			 {
				 $msge = '<font class="refuse">&nbsp;IMPOSSIBLE D\'ENREGISTRER CETTE ANNONCE</font>';
				 }

	}else $erreur= '<h3 class="refuse">VOUS AVEZ DEJA POSTE CETTE ANNONCE!</h3>';
	
 }
?>

<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<body>
<div class="div_princ_ref">
<table width="100%" border="0">
  <tr>
    <td width="31%" align="left"><h3 class="titre_page">
  POSTER UNE ANNONCE
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
                <td width="32%" height="55" class="font_tab">&nbsp;Nom ou structure : </td>
                <td width="68%"><input type="text" name="societe" class="champ_zoneb" placeholder="Votre nom ou structure" required autocomplete="off" autofocus value="<?php echo $_POST['societe'];?>" style="width:500px"/></td>
              </tr>
<tr>
                <td width="32%" height="55" class="font_tab">&nbsp;Nom : </td>
                <td width="68%"><input type="text" name="nom" class="champ_zoneb" placeholder="Votre nom ou structure" required autocomplete="off" autofocus value="<?php echo $_POST['nom'];?>" /></td>
              </tr>               
              <tr>
                <td width="32%" height="55" class="font_tab">&nbsp;T&eacute;l&eacute;phone : </td>
                <td><input type="text" name="tel" class="champ_zoneb" placeholder="Votre t&eacute;l&eacute;phone" required autocomplete="off" value="<?php echo $_POST['tel'];?>"/></td>
              </tr>
              <tr>
                <td height="45" class="font_tab">&nbsp;E-mail :</td>
                <td><input type="email" name="email" class="champ_zoneb" placeholder="Votre adresse electronique" autocomplete="off" value="<?php echo $_POST['email'];?>" /></td>
              </tr>
              <tr>
                <td height="59" class="font_tab">&nbsp;Titre annonce : </td>
                <td><input type="text" name="titre" class="champ_zoneb" style="width:400px" placeholder="Titre de votre annonce" required autocomplete="off" value="<?php echo $_POST['titre'];?>"/></td>
              </tr>
              <tr>
                <td height="45" class="font_tab">&nbsp;Votre annonce :</td>
                <td><textarea name="annonce" placeholder="Ecrivez votre annonce" class="large_txt" cols="100" rows="6"><?php echo $_POST['annonce'];?></textarea></td>
              </tr>

              <tr>
                <td height="55" colspan="2" class="font_tab"><div><input type="submit" name="valider" class="valider" value="Valider" /></div></td>
              </tr>
            </table>
          </fieldset>
          <br>
          
      </form>
        <br>
</div>

</body>