<?php
session_start();
include("../../Connections/annuaire.php");
//include '../_connexion/link_bd.php';
include '../_fonctions/fonctions.php';
include '../_fonctions/url.inc.php';


if(!$_SESSION["login"]) @header("Location:../index.php");
//echo $_SESSION['prenom'];
$cpte1=mysql_query("SELECT * FROM entreprise WHERE flag_ese = 0");
$cpte1=@mysql_num_rows($cpte1);

/*$cpte2=mysql_query("SELECT * FROM annonce WHERE flag_anc=0");
$cpte2=@mysql_num_rows($cpte2);

$cpte3=mysql_query("SELECT * FROM annonce WHERE flag_defil=0");
$qte_pl=@mysql_num_rows($cpte3);*/

switch ($_GET['page']) {
####SCRIPT CAS MENU PARAM
	//UTILISATEUR
 	case '?.add_user':
			$titre_page = "Parametrage<li>Ajout Utilisateur</li>";			
    		break;
	
	case '?.add_rub':
			$titre_page = "Parametrage<li><a href=\"?page=?.liste_rub\">Liste des rubriques</a></li><li>Ajout d'une rubrique</li>";			
    		break;
	
	case '?.edit_rub':
			$titre_page = "Parametrage<li><a href=\"?page=?.liste_rub\">Liste des rubriques</a></li><li>Modifier une rubrique</li>";			
    		break;
			
			case '?.liste_rub':
			$titre_page = "Parametrage<li><a href=\"?page=?.liste_rub\">Liste des rubriques</a></li>";			
    		break;
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Panel Adminsitration Pagesvertes</title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
        <!-- jQuery UI theme-->
            <link rel="stylesheet" href="lib/jquery-ui/css/Aristo/Aristo.css" />
        <!-- gebo blue theme-->
            <link rel="stylesheet" href="css/blue.css" id="link_theme" />
        <!-- breadcrumbs-->
            <link rel="stylesheet" href="lib/jBreadcrumbs/css/BreadCrumb.css" />
        <!-- tooltips-->
            <link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />
        <!-- code prettify -->
            <link rel="stylesheet" href="lib/google-code-prettify/prettify.css" />    
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />    
        <!-- splashy icons -->
            <link rel="stylesheet" href="img/splashy/splashy.css" />
		<!-- datepicker -->
            <link rel="stylesheet" href="lib/datepicker/datepicker.css" />
        <!-- tag handler -->
            <link rel="stylesheet" href="lib/tag_handler/css/jquery.taghandler.css" />
        <!-- nice form elements -->
            <link rel="stylesheet" href="lib/uniform/Aristo/uniform.aristo.css" />
		<!-- 2col multiselect -->
            <link rel="stylesheet" href="lib/multiselect/css/multi-select.css" />
		<!-- enhanced select -->
            <link rel="stylesheet" href="lib/chosen/chosen.css" />
        <!-- upload -->
            <link rel="stylesheet" href="lib/plupload/js/jquery.plupload.queue/css/plupload-gebo.css" />
		<!-- colorbox -->
            <link rel="stylesheet" href="lib/colorbox/colorbox.css" />
		<!-- colorpicker -->
            <link rel="stylesheet" href="lib/colorpicker/css/colorpicker.css" />	
		    
        <!-- main styles -->
            <link rel="stylesheet" href="css/style.css" />
			
            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />
	
        <!-- Favicon -->
            <link rel="shortcut icon" href="favicon.ico" />
           

<!-- FIN LISTE LIEE CAT ET RUBRIQUE-->

		
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
        <![endif]-->
		
		<script>
			//* hide all elements & show preloader
			document.documentElement.className += 'js';
		</script>
    <!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  -->
    
    <!-- DEBUT AFFICHAGE DE L'HEURE EN TEMPS REEL -->

<script language="JavaScript">
var dd, delai;
function debuteTemps(delai1) {
var hhmmss = "", min, sec;
delai = delai1;
adate = new Date()

adate.getUTCHours() + (adate.getTimezoneOffset() / 60)
adate.getHours() + (adate.getTimezoneOffset() / 60)


hhmmss += adate.getUTCHours() + (adate.getTimezoneOffset() / 60) ;<!-- + 9 -->
if (hhmmss>=24){hhmmss=hhmmss-24;}
if (hhmmss < 10) hhmmss = "0" + hhmmss;
min = adate.getMinutes();
if (min < 10) hhmmss += ":0" + min;
else hhmmss += ":" + min;
sec = adate.getSeconds();
if (sec < 10) hhmmss += ":0" + sec;
else hhmmss += ":" + sec;
hhmmss = " " + hhmmss;
document.Temps1.heure.value = hhmmss;
dd = setTimeout("debuteTemps(delai)",delai1);
}

function dates()
{
<!--
var dDate = new Date() ;
var Jours = new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi") ;
var Mois = new Array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre");
document.write(Jours[dDate.getDay()] + " " + dDate.getDate() + " " + Mois[dDate.getMonth()] + " " + dDate.getFullYear()) ;
//-->
}
</script>
<script src="ckeditor/ckeditor.js"></script>
<!-- FIN AFFICHAGE DE L'HEURE EN TEMPS REEL -->
   <script type="text/javascript" src="jquery.js"></script>  
    </head>
    <body onLoad="debuteTemps(1000)" onUnload="clearTimeout(dd)">
	<div id="loading_layer" style="display:none"><img src="img/ajax_loader.gif" alt="" /></div>

		
		<div id="maincontainer" class="clearfix">
			<!-- header -->
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                        	
                        <a class="brand" href="accueil.php">
                        <div class="img_logo"></div><div style="margin-top:-40px; margin-left:35px">
                        PANEL ADMINISTRATION LESPAGESVERTESCI</div>
                        </a>
                            <ul class="nav user_menu pull-right">
                                <li class="hidden-phone hidden-tablet">
                                    <div class="nb_boxes clearfix">
                                        
                                       <!-- <a data-toggle="modal" data-backdrop="static" href="#myTasks" class="label ttip_b" title="Expiration Contrat">10 <i class="splashy-calendar_week"></i></a>-->
                                    </div>
                                </li>
                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['pren_user']." ".$_SESSION['nom_user'];?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                    <li><a href="user_profile.html"><?php echo $_SESSION['mail'];?></a></li>
                                    <li><a href="accueil.php?page=?.change_pwd">Changer mot de passe</a></li>
                                    <li class="divider"></li>
                                    <li><a href="../deconnexion.php">Se d&eacute;connecter</a></li>
                                    </ul>
                                </li>
                            </ul>
							<a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
								<span class="icon-align-justify icon-white"></span>
							</a>
                            <nav>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                        
                                       
                                      
                                        <li>
                                            <!--<a href="documentation.html"><i class="icon-book icon-white"></i> Aide</a>-->
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

            </header>
            
            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">
                    
					<nav>
                        <div id="jCrumbs" class="breadCrumb module">
                            <ul>
                                <li>
                                    <a href="#"><i class="icon-home"></i></a>
                                </li>
                                <li>
                                    <a href="#">Zone d'Administration des pages vertes : <strong>version française</strong></a>
                                </li>
                                <li>
                                    <a href="https://lespagesvertesci.net/_adminen" target="_blank">version anglaise</a>
                                </li>                                 
                                <li>
                                    <?php echo $titre_page;?> 
                                </li>
                            </ul>
                        </div>
                    </nav>          										

    <div style="visibility:hidden; margin-top:-20px" ><select name="ui_slider3_sel" id="ui_slider3_sel" >    </select></div>
   
					<div class="formSep">
						<div class="row-fluid">
                          
                    <?php
// inclusion et traitement des fichiers
switch ($_GET['page']) {
####SCRIPT CAS MENU PARAM
	//UTILISATEUR
 	case '?.add_user':

			include('_pages/_users/adduser.php');
    		break;
	
	case '?.liste_user':

			include('_pages/_users/liste_user.php');
			$titre_page = "Gestion des utilisateurs";
    		break;
			
	case '?.edit_user':

			include('_pages/_users/edit_user.php');
			$titre_page = "Gestion des utilisateurs";
    		break;
			
	case '?.statut_user':

			include('_pages/_users/statut_user.php');
			$titre_page = "Gestion des utilisateurs";
    		break;
			
	case '?.reset_pwd':

			include('_pages/_users/reset_pwd_user.php');
			$titre_page = "Gestion des utilisateurs";
    		break;
			
	case '?.change_pwd':

			include('_pages/_password/change_password.php');
			$titre_page = "Gestion des utilisateurs";
    		break;
	
	//CATEGORIE
	case '?.liste_categ':

			include('_pages/_categorie/liste_categ.php');
    		break;
	
	case '?.add_categ':

			include('_pages/_categorie/add_categ.php');
    		break;
			
	case '?.edit_categ':

			include('_pages/_categorie/edit_categ.php');
    		break;
	
			
	case '?.statut_categ':

			include('_pages/_categorie/statut_categ.php');
    		break;

	//RUBRIQUE
	case '?.liste_rub':

			include('_pages/_rubrique/liste_rub.php');
    		break;
	
	case '?.add_rub':

			include('_pages/_rubrique/add_rub.php');
    		break;
			
	case '?.edit_rub':

			include('_pages/_rubrique/edit_rub.php');
    		break;
	
			
	case '?.statut_rub':

			include('_pages/_rubrique/statut_rub.php');
    		break;
			
	//SOUS-RUBRIQUE
	case '?.liste_srub':

			include('_pages/_ssrubrique/liste_srub.php');
    		break;
	
	case '?.add_srub':

			include('_pages/_ssrubrique/add_srub.php');
    		break;
			
	case '?.edit_srub':

			include('_pages/_ssrubrique/edit_srub.php');
    		break;
	
			
	case '?.statut_srub':

			include('_pages/_ssrubrique/statut_srub.php');
    		break;			
			
	
	//REFERENCEMENT
	case '?.liste_refnact':

			include('_pages/_referencement/liste_refnact.php');
    		break;
			
	case '?.liste_ref':

			include('_pages/_referencement/liste_ref.php');
    		break;
	
	case '?.add_ref':

			include('_pages/_referencement/add_ref.php');
			//include('_pages/_referencement/ajout_ese.php');
			//include('test.php');
    		break;
			
	case '?.add_agence':

			include('_pages/_referencement/add_agence.php');
    		break;
			
	case '?.edit_agence':

			include('_pages/_referencement/edit_agence.php');
    		break;			
			
	case '?.edit_ref':

			include('_pages/_referencement/edit_ref.php');
    		break;
	
			
	case '?.statut_ref':

			include('_pages/_referencement/statut_ref.php');
    		break;
	
	case '?.statut_refinact':

			include('_pages/_referencement/statut_refnact.php');
    		break;
			
			
	case '?.ajout_pubgauche_ese':

			include('_pages/_referencement/ajout_pubgauche_ese.php');
    		break;			
	
	//ANNONCES
	case '?.add_ance':

			include('_pages/_annonces/add_ance.php');
    		break;
	
	case '?.liste_ancenact':

			include('_pages/_annonces/liste_ancenact.php');
    		break;			
			
	case '?.liste_flash':

			include('_pages/_annonces/liste_flash.php');
    		break;
			
	case '?.add_flash':

			include('_pages/_annonces/add_flash.php');
    		break;			

	case '?.edit_flash':

			include('_pages/_annonces/edit_flash.php');
    		break;	

	case '?.statut_flash':

			include('_pages/_annonces/statut_flash.php');
    		break;
			
			
	case '?.liste_ancenact_pl':

			include('_pages/_annonces/liste_ancenact_pl.php');
    		break;		
	
	case '?.liste_ance':

			include('_pages/_annonces/liste_ance.php');
    		break;
			
	case '?.liste_ancepl':

			include('_pages/_annonces/liste_ancepl.php');
    		break;
			
	case '?.edit_ance':

			include('_pages/_annonces/edit_ance.php');
    		break;
	
			
	case '?.statut_ance':

			include('_pages/_annonces/statut_ance.php');
    		break;
			
	case '?.statut_plum':

			include('_pages/_annonces/statut_plum.php');
    		break;		
		
	case '?.statut_pl':

			include('_pages/_annonces/statut_pl.php');
    		break;	
	
	case '?.statut_ancenact':

			include('_pages/_annonces/statut_ancenact.php');
    		break;
			
	//PARTENAIRES
	case '?.add_part':

			include('_pages/_partenaire/add_part.php');
    		break;
			
	case '?.liste_part':

			include('_pages/_partenaire/liste_part.php');
    		break;
			
	case '?.edit_part':

			include('_pages/_partenaire/edit_part.php');
    		break;
	
			
	case '?.statut_part':

			include('_pages/_partenaire/statut_part.php');
    		break;
		
	//PUBLICITE
	case '?.add_pub':

			include('_pages/_publicite/add_pub.php');
    		break;
			
	case '?.add_pubsite':

			include('_pages/_publicite/add_pubsite.php');
    		break;			
			
	case '?.liste_pubsite':

			//include('_pages/_publicite/liste_pubhaut.php');
			include('_pages/_publicite/liste_pub_generale.php');
    		break;
			
	case '?.liste_pubese':

			include('_pages/_publicite/liste_pubgche.php');
    		break;
			
	case '?.fixe_pubsite':

			include('_pages/_publicite/fixe_pubsite.php');
    		break;			
			
	case '?.slide_pubsite':

			include('_pages/_publicite/slide_pubsite.php');
    		break;	
			
	case '?.liste_pubrech':

			include('_pages/_publicite/liste_pubrech.php');
			break;
			
	case '?.edit_pub':

			include('_pages/_publicite/edit_pub.php');
    		break;
			
			
	case '?.edit_pubsite':

			include('_pages/_publicite/edit_pubsite.php');
    		break;	
			
	case '?.statut_pubhaut':

			include('_pages/_publicite/statut_pubhaut.php');
    		break;
			
	case '?.statut_pub_default':
			include('_pages/_publicite/statut_pubhaut_default.php');
    		break;
			
	case '?.statut_pubgche':

			include('_pages/_publicite/statut_pubgche.php');
    		break;
			
	case '?.statut_pubsite':

			include('_pages/_publicite/statut_pubsite.php');
    		break;			
	
	case '?.statut_pubrech':
			include('_pages/_publicite/statut_pubrech.php');
    		break;
			
			case '?.statut_pubrech_default':
			include('_pages/_publicite/statut_pubrech_default.php');
    		break;
			
			case '?.contact':
			include('_pages/_contact/liste_contact.php');
    		break;
			
			case '?.edit_contact':
			include('_pages/_contact/edit_contact.php');
    		break;
			
			case '?.add_contact':
			include('_pages/_contact/add_contact.php');
    		break;
			
			case '?.statut_contact':
			include('_pages/_contact/statut_contact.php');
    		break;
			
	default:

			include('default.php');
    		break;
	
	#### FIN SCRIPT DECONNEXION
	
}?> 
                            
						</div>
					</div>
                </div>
            </div>
            
			<!-- sidebar -->
            <a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
            <div class="sidebar">
				
				<div class="antiScroll">
					<div class="antiscroll-inner">
						<div class="antiscroll-content">
					
							<div class="sidebar_inner">
                            	<div align="right" class="timer" style="text-align:center">
              <FORM NAME="Temps1" style="border:none">
            <span></span><?php echo "<script>dates();</script>";?><br><input type="text" name="heure" class="style timer"  align="center" style="text-align:center">
            </FORM>  
      </div>
								
                               
								<div id="side_accordion" class="accordion">
									
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="accueil.php" class="accordion-toggle" ><!--icon-folder-close-->
												<i class="icon-home"></i> Accueil
											</a>
										</div>
										<div class="accordion-heading sdb_h_active">
											<a href="#collapseOne" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle"><!--icon-folder-close-->
												<i class="icon-cog"></i> Parametrage
											</a>
										</div>
										<div class="accordion-body collapse" id="collapseOne">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													
                                                    <li class="<?php if($_GET['page']=="?.liste_rub") echo "active";?>"><a href="accueil.php?page=?.liste_rub">Liste des Rubriques</a></li>
                                                    <li class="<?php if($_GET['page']=="?.liste_srub") echo "active";?>"><a href="accueil.php?page=?.liste_srub">Liste des Sous-rubriques</a></li>
                                                    <!--<li class="<?php //if($_GET['page']=="?.contact") echo "active";?>"><a href="accueil.php?page=?.contact">Contacts pagesvertes</a></li>-->
                                                    													
												</ul>
											</div>
										</div>
									</div>
									<div class="accordion-group">
										<div class="accordion-heading sdb_h_active">
											<a href="#collapseTwo" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="icon-th"></i> Gestion des modules
											</a>
										</div>
										<div class="accordion-body collapse" id="collapseTwo">
											<div class="accordion-inner">
												<ul class="nav nav-list">
                                                <li class="<?php if($_GET['page']=="?.liste_ance") echo "active";?>"><a href="accueil.php?page=?.liste_ance">Liste des Annonces</a></li>
                                                
                                                <li class="<?php if($_GET['page']=="?.liste_part") echo "active";?>"><a href="accueil.php?page=?.liste_part">Liste des Partenaires</a></li>
                                                
                                                <li class="<?php if($_GET['page']=="?.liste_ref") echo "active";?>"><a href="accueil.php?page=?.liste_ref">Liste des R&eacute;f&eacute;rencements</a></li>
											                                            </ul>
											</div>
										</div>
									</div>
									
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseFour" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="icon-cog"></i> Gestion de la publicit&eacute;
											</a>
										</div>
										<div class="accordion-body collapse" id="collapseFour">
											<div class="accordion-inner">
												<ul class="nav nav-list">											
                                                <li class="<?php if($_GET['page']=="?.liste_pubsite" || $_GET['page']=="?.add_pubsite") echo "active";?>"><a href="accueil.php?page=?.liste_pubsite">Liste Pub Site</a></li>
                                                	
													<li class="<?php if($_GET['page']=="?.liste_pubese") echo "active";?>"><a href="accueil.php?page=?.liste_pubese">Liste Pub Entreprise</a></li>
                                                    
                                                    <li class="<?php if($_GET['page']=="?.liste_flash") echo "active";?>"><a href="accueil.php?page=?.liste_flash">Liste Flash info</a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseThree" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="icon-user"></i> Gestion des utilisateurs
											</a>
										</div>
										<div class="accordion-body collapse" id="collapseThree">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													<li class="<?php if($_GET['page']=="?.liste_user") echo "active";?>"><a href="accueil.php?page=?.liste_user">Liste des utilisateurs</a></li>
													
													<li class="<?php if($_GET['page']=="?.reset_pwd") echo "active";?>"><a href="accueil.php?page=?.reset_pwd">R&eacute;initialiser mot de passe</a></li>
												</ul>
												
											</div>
										</div>
									</div>									
								</div>
							</div>
							   
							<div class="sidebar_info">
								<ul class="unstyled">
									<li>
										<span class="act act-warning"><?php echo $cpte1;?></span>
										<a href="?page=?.liste_refnact">R&eacute;f&eacute;rencements &agrave; activer</a>
									</li>
									<!--<li>
										<span class="act act-success"><?php echo $cpte2;?></span>
										<a href="?page=?.liste_ancenact" class="no">Annonces &agrave; activer</a>
									</li>
                                    
                                    <li>
										<span class="act act-danger"><?php echo $qte_pl;?></span>
										<a href="?page=?.liste_ancenact_pl" class="no">Panneau Lumineux.</a>
									</li>-->
									
								</ul>
							</div> 
						
						</div>
					</div>
				</div>
			
			</div>
			
			<!-- END PAGE CONTENT -->

            
            <script src="js/jquery.min.js"></script>
			<!-- DEBUT LISTE LIEE CAT ET RUBRIQUE -->
			   
			<script type="text/javascript" src="jquery.chained.js"></script>
			
			

			<!-- smart resize event -->
			<script src="js/jquery.debouncedresize.min.js"></script>
			<!-- hidden elements width/height -->
			<script src="js/jquery.actual.min.js"></script>
			<!-- js cookie plugin -->
			<script src="js/jquery.cookie.min.js"></script>
			<!-- main bootstrap js -->
			<script src="bootstrap/js/bootstrap.min.js"></script>
			<!-- bootstrap plugins -->
			<script src="js/bootstrap.plugins.min.js"></script>
			<!-- tooltips -->
			<script src="lib/qtip2/jquery.qtip.min.js"></script>
			<!-- jBreadcrumbs -->
			<script src="lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
			<!-- sticky messages -->
            <script src="lib/sticky/sticky.min.js"></script>
			<!-- fix for ios orientation change -->
			<script src="js/ios-orientationchange-fix.js"></script>
			<!-- scrollbar -->
			<script src="lib/antiscroll/antiscroll.js"></script>
			<script src="lib/antiscroll/jquery-mousewheel.js"></script>
			<!-- lightbox -->
            <script src="lib/colorbox/jquery.colorbox.min.js"></script>
            <!-- common functions -->
			<script src="js/gebo_common.js"></script>
	
            <script src="lib/jquery-ui/jquery-ui-1.8.20.custom.min.js"></script>
            <!-- touch events for jquery ui-->
            <script src="js/forms/jquery.ui.touch-punch.min.js"></script>
            <!-- masked inputs -->
            <script src="js/forms/jquery.inputmask.min.js"></script>
            <!-- autosize textareas -->
            <script src="js/forms/jquery.autosize.min.js"></script>
            <!-- textarea limiter/counter -->
            <script src="js/forms/jquery.counter.min.js"></script>
            <!-- datepicker -->
            <script src="lib/datepicker/bootstrap-datepicker.min.js"></script>
            <!-- timepicker -->
            <script src="lib/datepicker/bootstrap-timepicker.min.js"></script>
            <!-- tag handler -->
            <script src="lib/tag_handler/jquery.taghandler.min.js"></script>
            <!-- input spinners -->
            <script src="js/forms/jquery.spinners.min.js"></script>
            <!-- styled form elements -->
            <script src="lib/uniform/jquery.uniform.min.js"></script>
            <!-- animated progressbars -->
            <script src="js/forms/jquery.progressbar.anim.js"></script>
            <!-- multiselect -->
            <script src="lib/multiselect/js/jquery.multi-select.min.js"></script>
            <!-- enhanced select (chosen) -->
            <script src="lib/chosen/chosen.jquery.min.js"></script>
            <!-- TinyMce WYSIWG editor -->
            <script src="lib/tiny_mce/jquery.tinymce.js"></script>
			<!-- plupload and all it's runtimes and the jQuery queue widget (attachments) -->
			<script type="text/javascript" src="lib/plupload/js/plupload.full.js"></script>
			<script type="text/javascript" src="lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.full.js"></script>
            <!-- colorpicker -->
			<script src="lib/colorpicker/bootstrap-colorpicker.js"></script>
			<!-- form functions -->
            <script src="js/gebo_forms.js"></script>
            
            <script src="lib/datatables/jquery.dataTables.min.js"></script>
			<!-- additional sorting for datatables -->
			<script src="lib/datatables/jquery.dataTables.sorting.js"></script>
			<!-- tables functions -->
			<script src="js/gebo_tables.js"></script>
    
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1000);
				});
			</script>
		
		</div>
	</body>
</html>
<?php 
@mysql_free_result($cpte1);
@mysql_free_result($cpte2);
@mysql_free_result($cpte3);
?>