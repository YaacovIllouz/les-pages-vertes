<?php
//-------------- -------------------//
$rqt1="SELECT * from annonce WHERE flag_anc = 0 ORDER BY date_ance DESC LIMIT 0 ,10";
       $result1 = mysql_query($rqt1);
    $nbTsal=mysql_num_rows($result1);
//--------------- -----------------//



$tel = addslashes($_POST['tel']);
$email = $_POST['email'];
$annonce = addslashes(($_POST['annonce']));



if($_POST['valider'])
{
	$check_ctt=mysql_query("SELECT * FROM contact WHERE tel='".$tel."' AND adresse='".$annonce."' AND email='".$email."' ");
	$nbre_ctt = mysql_num_rows($check_ctt);
	
	if($nbre_ctt==0) {
	
	$insertion = "INSERT INTO contact VALUES
('',  
'".$tel."', 
'".$email."', 
'".$annonce."'
)";
	
	//echo $insertion;
	$defnumber=1;
	$exe_insert = mysql_query($insertion);
	
			if($exe_insert)
			{
				
				$msge = '<font class="confirm">&nbsp;VOS CONTACTS ONT ETE ENREGISTRES.</font>';
				
				}
			else
			 {
				 $msge = '<font class="refuse">&nbsp;IMPOSSIBLE D\'ENREGISTRER CES CONTACTS</font>';
				 }

	}else $erreur= '<h3 class="refuse">VOUS AVEZ DEJA AJOUTER CES CONTACTS !</h3>';
	
 }
?>

<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<body>
<div class="div_princ_ref">
<table width="100%" border="0">
  <tr>
    <td width="31%" align="left"><h3 class="titre_page">
  AJOUTER UN CONTACT
</h3></td>
    <td width="36%" align="center"><?php echo $msge.' '.$erreur;?></td>
    <td width="33%" align="right"><a href="accueil.php?page=?.contact" class="ajout">[Liste contacts]</a></td>
  </tr>
</table>

        <form name="frm_bien" method="post" action="" enctype="multipart/form-data">
          <fieldset class="fieldset_1">
            <legend class="info_zone">Informations contact</legend>
            <table width="60%" border="0" align="center"  cellspacing="6">
              <tr>
                <td width="32%" height="55" class="font_tab">&nbsp;T&eacute;l&eacute;phone : </td>
                <td width="68%"><input type="text" name="tel" class="champ_zoneb" placeholder="Votre t&eacute;l&eacute;phone" required autocomplete="off" value="<?php echo $_POST['tel'];?>"/></td>
              </tr>
              <tr>
                <td height="45" class="font_tab">&nbsp;Adresse :</td>
                <td><textarea name="annonce" class="large_txt" cols="100" rows="6"><?php echo $_POST['annonce'];?></textarea></td>
              </tr>
              <tr>
                <td height="45" class="font_tab">&nbsp;E-mail :</td>
                <td><input type="email" name="email" class="champ_zoneb" placeholder="Votre adresse electronique" autocomplete="off" value="<?php echo $_POST['email'];?>" /></td>
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