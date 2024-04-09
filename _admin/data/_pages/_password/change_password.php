<?php 
session_start();
if(!$_SESSION['login_user']) @header("Location: ../securite/index.php");
///
require("_sql/1.php");
$resupdate=mysql_query($sql_up) or die (mysql_error());
$data=mysql_fetch_row($resupdate);
$table="users";
///
//traitement du fichier si poster////////////////////////////////////////////////////////////////////
$mes="";
	if($_POST['updat']=='Modifier'){
		
		
					if(md5($_POST['old_pass'])==$_SESSION['pwd'])				
					{
					if($_POST['new_pass']!=$_POST['conf_NP']){
					$mes="<font class='txt_confirm'>Veuillez saisir le m&ecirc;me mot de passe SVP !</font>";
					$_POST['new_pass']="";
					$_POST['conf_NP']="";
					
					}else
						if((strlen($_POST['new_pass']) < 7 ) || (strlen($_POST['conf_NP']) < 7)){
						$mes="<font class='txt_confirm'>Sept caract&egrave;res sont r&eacute;quis pour les mots de passe !</font>";
						$_POST['new_pass']="";
						$_POST['conf_NP']="";
		            }else
					{
		// Insertion ds la bd
		$result = mysql_query("UPDATE `$table` SET `pass_user`='".md5($_POST['conf_NP'])."' WHERE login_user='".$_SESSION['login_user']."' LIMIT 1" ) or die (mysql_error());
		
		$msg="<script language='javascript'> alert('MISE A JOUR MOT DE PASSE EFFECTUEE !!!')</script>";
		$mes.='<br><font class="important">MODIFICATION MOT DE PASSE EFFECTUEE AVEC SUCCES !!</font><br><br>
			<font class="important">IMPORTANT!!<br /></font> <font class="txt_11">
				Vous devez vous d&eacute;connecter pour que les nouveaux param&egrave;tres soient pris en compte,<br /> 
				Dans le cas contraire, vous serez d&eacute;connect&eacute; automatiquement dans <font class="txt_confirm">5 secondes</font> <br/><br/><br>
				<meta http-equiv="refresh" content="5; url=../index.php?logout=101" />
			</font>
		';
		
			}
		
		}
		else{$mes="<font class='txt_confirm'>Mot de passe actuel incorrect !</font>";}
		
					
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<body>
<br>
<br>
<div align="center">
<h3>MODIFICATION DE MOT PASSE</h3>
<br>
<table width="644" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="644"><form action="" method="post" enctype="multipart/form-data" name="form1">
      <table width="615" border="0" align="center" cellpadding="0" cellspacing="3">
        <tr>
          <td height="22" colspan="4" valign="top" bgcolor="#CCCCCC"></td>
        </tr>
        <tr>
          <td height="39" colspan="4">
         
              <div align="center"><?php echo $mes; ?> </div>            </td>
          </tr>
        <tr>
          <td width="216" height="27" valign="middle" class="txt_norm2">Ancien mot de passe (*):</td>
          <td width="346" valign="middle">
          <label for="old_pass"></label>
          <input name="old_pass" type="password" id="old_pass" size="20" maxlength="15" required>
          </span></td>
          <td width="15" valign="top">&nbsp;</td>
          <td width="23" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="28" class="txt_norm2">Nouveau mot de passe (*):</td>
          <td>
            <label for="new_pass"></label>
            <input name="new_pass" type="password" id="new_pass" size="20" maxlength="15" required>
           </td>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="27" class="txt_norm2">Confirmer (*):</td>
          <td>
            <label for="conf_NP"></label>
            <input name="conf_NP" type="password" id="conf_NP" size="20" maxlength="15" required>
            </td>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="58" colspan="3">
            <!----><br />
            <div align="center">
              <input type="submit" name="updat" id="updat" value="Modifier" class="valider" />
          </div>           </td>
          <td width="23" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="20" colspan="4" bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
</div>