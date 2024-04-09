<?php
if(!$_SESSION['pseudo']) @header("Location: index.php");
?>

<?php 
$table="users";
$nom_U=addslashes(strtoupper($_POST['nom_U']));
$pren_U=addslashes(strtoupper($_POST['pren_U']));
$email_U=$_POST['email_U'];
if($_POST['ok_ajouter'])
{
$act=$_GET['lookat'];
$sqlupdat="UPDATE $table SET nom_user='".$nom_U."', pren_user='".$pren_U."', email_user='".$email_U."' WHERE login_user='".$_SESSION['login_user']."' LIMIT 1;";
$resupdat=mysql_query($sqlupdat) or die (mysql_error());
$msg="<script language='javascript'> alert('MODIFICATION EFFECTUEE AVEC SUCCES !!!')</script>";
$msg.="MODIFICATION EFFECTUEE AVEC SUCCES";
}
?>
<?php
//require("_sql/1.php");
$sql_up="SELECT * FROM users WHERE login_user='".$_SESSION['login_user']."'";
//echo $sql_up;
$resupdate=mysql_query($sql_up) or die (mysql_error());
$data_USR=mysql_fetch_row($resupdate);

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- SCRIPT POUR  -->
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript">
</script>
<script language="JavaScript" type="text/javascript">
var win = null;

function NewWindow(mypage,myname,w,h,scroll,pos,niveau)
{
	
	if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
	if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
	else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
	settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
	
	if((win == null || win.closed)&&(mypage!='#'))
	{ win=window.open(mypage,myname,settings); win.focus(); } else
	{win.close(); if ((mypage!='#')) { win=window.open(mypage,myname,settings);win.focus();}}
	
}
</script>
<!-- FIN -->
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<body>
<table width="616" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="616"><form action="" method="post" enctype="multipart/form-data" name="form1">
      <table width="607" border="0" align="center" cellpadding="0" cellspacing="3">
        <tr>
          <td height="22" colspan="2" valign="top">
          <img src="../../images/dev_info.png" width="20" height="20"> <a href="#" onClick="NewWindow('_page/_user/change_avatar.php','sous_form','410','240','yes','center',0);">Modifier mon avatar </a><!--| <a href="index.php?page=?.histo_user">Historique de mes connexions</a>--></td>
        </tr>
        <tr>
          <td height="22" colspan="2" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="20" colspan="2" valign="top" bgcolor="#1FA055"><div align="center" class="txt_saisie">INFORMATIONS PERSONNELLES</div></td>
        </tr>
        <tr>
          <td height="26" colspan="2">
         
              <div align="center" class="roug_gra"><?php echo $msg; ?> </div>            </td>
          </tr>
        <tr>
          <td height="28" colspan="2" align="center" valign="middle" >
          <fieldset>
          	<legend class="txt_rs2_bis">PARAMETRES UTILISATEUR </legend>
          	<table width="600" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td height="25" class="txt_norm2"><div align="right">Identifiant :</div></td>
                <td><label for="id_user"></label>
                  <div align="left">
                    <input name="id_user" type="text" disabled id="id_user"  value="<?php echo $data_USR[0];?>">
                  </div></td>
              </tr>
              <tr>
                <td width="174" height="25" class="txt_norm2"><div align="right">Agence : </div></td>
                <td width="417"><label for="ent_user"></label>
                  <div align="left">
                    <input name="ent_user" type="text" disabled id="ent_user" value="<?php echo $_SESSION['agence']; ?>">
                  </div></td>
              </tr>
              <tr>
                <td height="25" class="txt_norm2"><div align="right">Profil : </div></td>
                <td><label for="profil_user"></label>
                  <div align="left">
                    <input name="profil_user" type="text" disabled id="profil_user" value="<?php echo $_SESSION['profil']; ?>" >
                  </div></td>
              </tr>
          </table>
          </fieldset></td>
        </tr>
        <tr>
          <td height="28" colspan="2" align="center" valign="middle">
          <fieldset>
          	<legend class="txt_rs2_bis">INFORMATIONS COMPLEMENTAIRES </legend>
          	<table width="600" border="0" cellspacing="3" cellpadding="0">
          	  <tr>
                <td width="172" height="25" class="txt_norm2"><div align="right">Nom :</div></td>
                <td width="419"><span id="sprytextfield3_U">
                  <label for="nom_U"></label>
                </span>
                  <div align="left">
                    <input name="nom_U" type="text" id="nom_U" size="20" value="<?php echo $data_USR[2];?>" autocomplete="off">
                    <span class="textfieldRequiredMsg">Une valeur est requise.</span></div></td>
              </tr>
              <tr>
                <td height="25" class="txt_norm2"><div align="right">Pr&eacute;nom(s) :</div></td>
                <td><div align="left">
                  <label for="pren_U2"></label>
                  <input name="pren_U" type="text" id="pren_U2" size="25" value="<?php echo $data_USR[3];?>" autocomplete="off">
                  <span class="textfieldRequiredMsg">Une valeur est requise.</span></div></td>
              </tr>
              <tr>
                <td height="25" class="txt_norm2"><div align="right">E-mail :</div></td>
                <td><div align="left">
                  <label for="email_U2"></label>
                  <input name="email_U" type="text" id="email_U2" value="<?php echo $data_USR[11];?>" size="30" autocomplete="off">
                  <span class="textfieldRequiredMsg">Une valeur est requise.</span><span class="textfieldInvalidFormatMsg">Format non valide.</span></div></td>
              </tr>
              <tr>
                <td height="25" class="txt_norm2"><div align="right">Date cr&eacute;ation du compte :</div></td>
                <td><label for="date_crea"></label>
                  <div align="left">
                    <input name="date_crea" type="text" disabled id="date_crea" value="<?php echo date("d-m-Y H:i:s",strtotime($data_USR[7])); ?>">
                  </div></td>
              </tr>
              <tr>
                <td height="25" class="txt_norm2"><div align="right">Actif ? : </div></td>
                <td><div align="left"><span class="important"><span class="txt_v">Oui </span>
                      <input type="radio" name="actif_U" id="radio" value="1" <?php if($data_USR[9]==1) echo "checked" ?>  disabled>
                      <label for="actif_U"></label>
                      Non</span>
                  <input type="radio" name="actif_U" id="radio2" value="0" <?php if($data_USR[9]==0) echo "checked" ?> disabled>
                  </div>
                  </label></td>
              </tr>
          </table>
          </fieldset></td>
        </tr>
        <tr>
          <td width="577" height="43"><label>
            <div align="center">
              <input type="submit" name="ok_ajouter" id="ok_ajouter" value="MODIFIER" class="" />
            </div></label></td>
          <td width="15" colspan="-1" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="20" colspan="2" bgcolor="#1FA055">&nbsp;</td>
          </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
<script type="text/javascript">
var sprytextfield3_U = new Spry.Widget.ValidationTextField("sprytextfield3_U");
</script>