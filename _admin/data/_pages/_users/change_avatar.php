<?php 
session_start();
if(!$_SESSION['login_user']) @header("Location: ../index.php");
///
require_once('../../_link/link_bd.php');

$table="users";

if($_POST['updat']=="MODIFIER")
		 {
//upload imgfile
$uploaddir = '../../_avatar/'; //fichier source
$uploadrep = '../../_avatar/'; //fichier destinataire.
$ext=".jpg";
$type=$_FILES['userfile']['type'];
$ext=strstr($_FILES['userfile']["name"],".");
$taille=$_FILES['userfile']['size'];
// v&eacute;rification de la taille de photo
if($_FILES['userfile']['name']=='')
		$msg = "<table width='290'><tr><td bgcolor='red'><font class='blan2'>Veuillez T&eacute;l&eacute;cherger votre photo S.V.P !!!</font></td></tr></table>";		
		else{
if(($_FILES['userfile']['size']<=50000)){
    // v&eacute;rification du type de la photo
	     if((@preg_replace('`jpeg`',$type))||(@preg_replace('`jpg`',$type))||(@preg_replace('`gif`','$type')))
            {
	         // move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $_FILES['userfile']['name']);
	          //telecharge le fichier image et le renom avec le num_tab suivi de l'extension.jpg 
	          move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$_SESSION['login_user'].$ext); 
	          $name_avatar=$_SESSION['login_user'].$ext; 	 
		      //insertion de la photo dans une table
		        $sql0="UPDATE `$table` SET avatar_user='".$name_avatar."' WHERE login_user='".$_SESSION['login_user']."' LIMIT 1";
				//echo $sql0;
				$result=mysql_query($sql0);
				$msg="<font class='important'>MODIFICATION EFFECTUEE AVEC SUCCES.</font>";
		    }
         else
          {
           $msg= " <br><font class='error' >Mauvais format de fichier , votre fichier est au format :</font> <font class='important'><b> ( $ext )</font></b><br><br>";
           $img_etu='../photo/noimage.jpg';
          }
}
else
{
$msg="<br><font class='error'>La Taille de photo est trop grande : &nbsp;</font><font class='important'><b> $taille </b>&nbsp;octets </font><br> <font class='text'>Votre photo ne doit pas exc&eacute;der</font> <font class='important'>50000 octets (50 Ko)</font><br><br>";
$img_etu='../photo/noimage.jpg';

}	
}
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../../_css/style.css" type="text/css" media="screen" charset="iso-8859-1" />
<body>
<table width="382" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="382"><form action="" method="post" enctype="multipart/form-data" name="form1">
      <table width="383" border="0" align="center" cellpadding="0" cellspacing="3">
        <tr>
          <td height="22" colspan="3" valign="top" bgcolor="#1FA055"><div align="center" class="noir">MISE A JOUR AVATAR &nbsp;&nbsp;&nbsp; | <a href="#" onClick="javascript:parent.opener.location.reload();window.close();">FERMER</a></div></td>
        </tr>
        <tr>
          <td height="22" colspan="3">
         
              <div align="center"><?php echo $msg; ?> </div>            </td>
          </tr>
        <tr>
          <td height="27" colspan="3" valign="middle" class="txt_norm2"><span class="txt_11">Taille Maximum :</span> <span class="important">50000 </span><span class="txt_11">Octets ou</span> <span class="important">50Ko</span></td>
          </tr>
        <tr>
          <td height="27" colspan="3" valign="middle" class="txt_norm2"><span class="txt_11">Photo bachelier | Format</span><span class="txt_norm"> <span class="important">JPG</span> </span><span class="txt_11">ou</span><span class="txt_norm"> <span class="important">jpg</span> </span><span class="txt_11">|</span><span class="txt_norm"> <span class="important">GIF</span> </span><span class="txt_11">ou</span><span class="txt_norm"> <span class="important">gif</span></span></td>
          </tr>
        <tr>
          <td width="141" height="27" valign="middle" class="txt_11">T&eacute;l&eacute;charger : </td>
          <td colspan="2" valign="middle"><label for="userfile"></label>
            <input name="userfile" type="file" id="userfile" size="25"></td>
          </tr>
        <tr>
          <td height="40" colspan="3">
            <!--<label for="select_multi"></label>
            <select name="select_multi[]" id="select_multi" multiple size="5">
        			<option value="Abidjan">Abidjan ville</option>
        			<option value="Paris">Paris village</option>
        			<option value="Ambassade">Ambassade de norvège</option>
            </select>--><br />
            <div align="center">
              <input type="submit" name="updat" id="updat" value="MODIFIER" class="buton_activ" />
            </div>           </td>
          </tr>
        <tr>
          <td colspan="3" bgcolor="#1FA055">&nbsp;</td>
          </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
