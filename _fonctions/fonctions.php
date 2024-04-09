<?php

//include("url.inc.php");
###GET ALL CATEG RAND LIMIT 5
function GetAllCateg($id_categ)
{
	$getcateglib="SELECT libelle FROM categorie WHERE id='".$id_categ."' ORDER BY rand LIMIT 0,5";
	//echo $getcateglib;exit();
	$execateglib=mysql_query($getcateglib) or die(mysql_error());
	while($libcateg=mysql_fetch_object($execateglib)){
	return $libcateg->libelle;}
	@mysql_free_result($execateglib);
}
###

### GET ALL LIBCATEG
function GetLibcateg($id_categ)
{
	global $db;
	//include("config/pdo.php");
	$getcateglib = "SELECT rubrique FROM rubrique WHERE Id = '".$id_categ."'";
	$libcateg = $db->query($getcateglib)->fetch();
	return $libcateg['rubrique'];
	@mysqli_free_result($execateglib);
}
###


### GET ALL COULEURCATEG
function GetColcateg($id_categ)
{
	global $db;
	//include("_link/link_bd.php");
	//include("config/pdo.php");
	$getcategcolor="SELECT color FROM rubrique WHERE Id='".$id_categ."'";
	//echo $getcateglib;exit();
	$colorcateg = $db->query($getcategcolor)->fetch();
	return $colorcateg['color'];
	@mysqli_free_result($colorcateg);
}
###

### GET PUBENTREPRISE
function GetPubentr($id_categ)
{
	include("_link/link_bd.php");
	$getpubentr="SELECT * FROM pub WHERE Id_ese ='".$id_categ."'";
	//echo $getpubentr;exit();
	$exepubentr = mysqli_query($bdd, $getpubentr);
	$pubentr = mysqli_fetch_object($exepubentr);
	return $pubentr->image;
	@mysqli_free_result($exepubentr);
}
###



### GET ALL RUBRIQUE LIBELLE
function GetLibRub($id_rbq)
{
	global $db;
	//echo $getcateglib;exit();
	//include("config/pdo.php");
	$getrublib="SELECT rubrique FROM sous_rubrique WHERE Id = '".$id_rbq."'";
	$libcateg = $db->query($getrublib)->fetch();
	return $libcateg['rubrique'];
	@mysqli_free_result($execateglib);
}
###


### GET IMAGE SOUS RUBRIQUE
function GetImgSrub($id_sr)
{
	include("_link/link_bd.php");
	$getimgsrub="SELECT images FROM pub2 WHERE Id_sr ='".$id_sr."'";
	//echo $getcateglib;exit();
	$exesrimage = mysqli_query($bdd, $getimgsrub);
	$imagesr=mysqli_fetch_object($exesrimage);
	return $imagesr->images;
	@mysql_free_result($exesrimage);
}
###

#### GET ALL RUBRIQUE RAND LIMIT 5
function GetAllRub($id_categ)
{
	$getrublib="SELECT libelle FROM rubrique WHERE id_categ='".$id_categ."' ORDER BY libelle ASC LIMIT 5";
	//echo $getrublib;exit();
	$exerublib=mysql_query($getrublib) or die(mysql_error());
	while($librub=mysql_fetch_object($exerublib)){
	echo '&nbsp;-'.strtoupper($librub->libelle).'<br/>';}
	@mysql_free_result($exerublib);
}
###
###GET EACH RUB AND COUNT REF OF THIS RUBRIQUE
function GetAllRubRef($id_categ)
{
	$getrublib="SELECT id,libelle,id_categ FROM rubrique WHERE id_categ='".$id_categ."' ORDER BY libelle LIMIT 5";
	//echo $getrublib;exit();
	$exerublib=mysql_query($getrublib) or die(mysql_error());
	while($librub=mysql_fetch_object($exerublib)){
		#### Count reference of this rubrique
			$sql2="SELECT count(id_rbq) FROM reference
					WHERE id_categ='".$librub->id_categ."' AND id_rbq='".$librub->id."' AND flag_ste = 1"; 
			$exe2=@mysql_query($sql2);
			$num2=@mysql_num_rows($exe2);
			$prem2=@mysql_fetch_row($exe2);
			echo '
			&nbsp;-<a href="'.format_url(($librub->libelle)),'_',format_url(($librub->id_categ)),'_',format_url($librub->id),'_page',format_url(1).'.html" class="txtrub">'.(strtoupper($librub->libelle)).'</a>&nbsp;<br/>';
			
			echo '';
			}
			@mysql_free_result($exerublib);
			@mysql_free_result($exe2);
}

#### GET ALL RUBRIQUE RAND LIMIT 5
function GetSigleDenoRef($id_ste)
{
	$getsigldenoref="SELECT sigle_ste, deno_ste FROM reference WHERE id_ste='".$id_ste."' ";
	//echo $getrublib;exit();
	$exegetsigldenoref=mysql_query($getsigldenoref) or die(mysql_error());
	while($sigldenoref=mysql_fetch_object($exegetsigldenoref)){
	echo strtoupper($sigldenoref->sigle_ste).'-'.($sigldenoref->deno_ste).'<br/>';}
	@mysql_free_result($exegetsigldenoref);
}
###

#### GET ALL RUBRIQUE RAND LIMIT 5
function Gettitreance($id_ance)
{
	$getsigldenoref="SELECT id_ance, titre_ance, id_ste FROM annonce WHERE id_ance='".$id_ance."' ";
	//echo $getrublib;exit();
	$exegetsigldenoref=mysql_query($getsigldenoref) or die(mysql_error());
	while($sigldenoref=mysql_fetch_object($exegetsigldenoref)){
	echo strtoupper($sigldenoref->titre_ance).'-'.($sigldenoref->id_ste).'<br/>';}
	@mysql_free_result($exegetsigldenoref);
}
###

//Fonction de Redirection vers le formulaire de recherche
function rediriger2($url){
$recherche="recherche";
	  /*
	 $redirect ='<meta HTTP-EQUIV="REFRESH" CONTENT="0; URL='.format_url($recherche).'&'.format_url2($url).'.html">';
echo $redirect;*/

    echo '<script language="JavaScript">'; 

    echo 'window.location.href= "'.format_url($recherche).'&'.format_url2($url).'.html"';// Redirection JavaScript

    echo '</script>';

  }

?>