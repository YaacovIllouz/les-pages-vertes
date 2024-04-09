<?php

$id=$_GET['com'];
//-------------- -------------------//
$rqt1="SELECT * from contact WHERE id = '".$id."' ";
       $result1 = mysql_query($rqt1);
    $result=mysql_fetch_array($result1);
//--------------- -----------------//


$tel = addslashes($_POST['tel']);
$email = $_POST['email'];
$annonce = addslashes(($_POST['annonce']));

if($_POST['valider'])
{
	
	$modif = "UPDATE contact SET tel = '".$tel."', adresse = '".$annonce."', email = '".$email."' WHERE id = '".$id."' ";
	
	//echo $modif;

	$exe_update = mysql_query($modif);
	
			if($exe_update)
			{
				
				$msge = '<font class="confirm">&nbsp;VOS CONTACTS ONT ETE MODIFIES.</font>';
				$msge.='<meta http-equiv=refresh content="3; url=?page=?.contact">';
				
				}
			else
			 {
				 $msge = '<font class="refuse">&nbsp;IMPOSSIBLE DE MODIFIER VOS CONTACTS</font>';
				 
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
  MODIFICATION DE CONTACTS
</h3></td>
    <td width="36%" align="center"><?php echo $msge.' '.$erreur;?></td>
    <td width="33%" align="right"><a href="accueil.php?page=?.contact" class="ajout">[Liste contacts]</a></td>
  </tr>
</table>

        <form name="frm_bien" method="post" action="" enctype="multipart/form-data">
          <fieldset class="fieldset_1">
            <legend class="info_zone">Informations annonce</legend>
            <table width="60%" border="0" align="center"  cellspacing="6">
              <tr>
                <td width="32%" height="55" class="font_tab">&nbsp;T&eacute;l&eacute;phone : </td>
                <td width="68%"><input type="text" name="tel" class="champ_zoneb" placeholder="Votre t&eacute;l&eacute;phone" required autocomplete="off" value="<?php if($_POST['tel']) {echo $_POST['tel'];} else {echo $result['tel'];};?>"/></td>
              </tr>
              <tr>
                <td height="45" class="font_tab">&nbsp;E-mail :</td>
                <td><input type="email" name="email" class="champ_zoneb" placeholder="Votre adresse electronique" autocomplete="off" value="<?php if($_POST['email']) {echo $_POST['email'];} else {echo $result['email'];};?>" /></td>
              </tr>
              <tr>
                <td height="45" class="font_tab">&nbsp;Adresse :</td>
                <td><textarea name="annonce" placeholder="Ecrivez votre annonce" style="width:400px" cols="100" rows="6"><?php if($_POST['annonce']) {echo $_POST['annonce'];} else {echo $result['adresse'];};?></textarea></td>
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