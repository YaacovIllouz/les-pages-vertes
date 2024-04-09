<?php

 session_start();
 require_once('Connections/annuaire.php');
 require_once('config/main_include.inc');
 require_once('class/class.inc');
 require_once('_fonctions/fonctions.php');
 require_once('_fonctions/url.inc.php');
  //menu
    $menu1 = $db->query("SELECT * FROM sous_rubrique WHERE (Id_rubrique = 28 OR Id_rubrique = 79) ORDER BY rubrique ASC ")->fetchAll();
    $menu2 = $db->query("SELECT * FROM sous_rubrique WHERE (Id_rubrique = 29 OR Id_rubrique = 113) ORDER BY rubrique ASC")->fetchAll();
    $menu3 = $db->query("SELECT * FROM sous_rubrique WHERE (Id_rubrique = 30 OR Id_rubrique = 130 OR Id_rubrique = 23) ORDER BY rubrique ASC")->fetchAll();
    $menu4 = $db->query("SELECT * FROM sous_rubrique WHERE (Id_rubrique = 31 OR Id_rubrique = 131 OR Id_rubrique = 25) ORDER BY rubrique ASC")->fetchAll();
    $menu5 = $db->query("SELECT * FROM sous_rubrique WHERE (Id_rubrique = 32 OR Id_rubrique = 140) ORDER BY rubrique ASC")->fetchAll();

//pub haur a afficher au dessus de la zone de recherche		
	if($_GET['page']=='det_ese'){
	$position_pub = "haut";	
	//echo 'Requete : '."SELECT * FROM pub WHERE Id_ese = '".$_GET['id']."' AND position_pub = '".$position_pub."' AND etat_pub = 1 LIMIT 0,1";
	$pub_ese =  $db->query("SELECT * FROM pub WHERE Id_ese = '".$_GET['id']."' AND position_pub = '".$position_pub."' AND etat_pub = 1 LIMIT 0,1")->fetch();
	$bande_ese =  $db->query("SELECT * FROM entreprise WHERE Id_ese = '".$_GET['id']."' AND etat_bandean = 1 LIMIT 1")->fetch();
	$video_ese =  $db->query("SELECT * FROM entreprise WHERE Id_ese = '".$_GET['id']."' AND etat_video = 1 LIMIT 1")->fetch();
	
	//$nbre_pub_ese = $pub_ese['image'];
	
		if($pub_ese['image']!=''){
		$zpub_search = $pub_ese['image'];		
		}
		else {		
	    $pub_search =  $db->query("SELECT * FROM pub_site WHERE position = 'Recherche' AND etat = 1 ORDER BY Id DESC LIMIT 0,1")->fetch();
		if($pub_search['image']!=''){$zpub_search = $pub_search['image'];} 
		else {$zpub_search = 'images/pub.jpg';}
		}
		
		$bande_annonce = $bande_ese['bande_annonce'];
	}
	else {
	    $pub_search =  $db->query("SELECT * FROM pub_site WHERE position = 'Recherche' AND etat = 1 ORDER BY Id DESC LIMIT 0,1")->fetch();
		if($pub_search['image']!=''){$zpub_search = $pub_search['image'];} 
		else {$zpub_search = 'images/pub.jpg';}
	}
	
//Affichage de la video
$videoese = $video_ese['lien_video'];
$etatvideo = $video_ese['etat_video'];	

//affichage bande annonce
$flash = $db->query("SELECT Id, contenu FROM flash WHERE etat = 1 ORDER BY date DESC")->fetchAll();	

//echo 'image zpub : '.$zpub_search;
//$pub_site =  $db->query("SELECT * FROM pub_site WHERE position = 'Bas' ORDER BY Id DESC")->fetch();

//echo 'mot recherché : '.$test = $_GET['entreprise'];

$date_visite = date("Y-m-d");
//echo 'INSERT INTO connectes VALUES(\'' . $_SERVER['REMOTE_ADDR'] . '\', ' . time() . ', "' . $date_visite . '")';
//Intégration du compteur de visite via l'adresse ip du visiteur
// ETAPE 1 : on vérifie si l'IP se trouve déjà dans la table
// Pour faire ça, on n'a qu'à compter le nombre d'entrées dont le champ "ip" est l'adresse ip du visiteur
$donnees = $db->query('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'')->fetchAll();
  
if ($donnees['nbre_entrees'] == 0) // L'ip ne se trouve pas dans la table, on va l'ajouter
{
    $db->query('INSERT INTO connectes VALUES(\'' . $_SERVER['REMOTE_ADDR'] . '\', ' . time() . ', "' . $date_visite . '")');
}
else // L'ip se trouve déjà dans la table, on met juste à jour le timestamp
{
    $db->query('UPDATE connectes SET timestamp=' . time() . ' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
}


?>
<!doctype html>
<html lang="fr">
<head>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106399100-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-106399100-1');
</script>



    <title>
	<?php 
	$default="Lespagesvertes - Annuaire de l'agriculture de Côte d'Ivoire";
	
	switch (@$_GET['page']) {
####SCRIPT CAS MENU PARAM
    case 'det_ese':
        include('pages/infoese_page.php');
    break;
	
	default:
	echo $default;
	}
	?>
	</title>
    <meta charset="utf-8">
    <META name="geo.country" content="CI" />
    <META name="country" content="CI" />
    <META NAME="TITLE" CONTENT="Les pages vertess - Annuaire des professionnels de l'agriculture de Cote d'Ivoire">
    <META NAME="AUTHOR" CONTENT="Dominique STAES">
    <META NAME="DESCRIPTION" CONTENT="Annuaire des professionnels de l'agriculture de cote d'ivoire. Référencement, agroalimentaire, agriculture, agroindustrie, filiere, formation">
    <META NAME="KEYWORDS" CONTENT="café, cacao, coton, huile, karité, vivrier, anacarde, miel, cola, coco, élevage, fruit, sucre, riz, agroalimentaire, agriculture cote d'ivoire, annuaire agriculture, pagesvertes, volaille, cajou, filière, transformation, hévéa, coopération internationale, financement agriculture, agroindustrie">
    <META NAME="OWNER" CONTENT="Dominique STAES">
    <META NAME="ROBOTS" CONTENT="index,all">
    <META NAME="Reply-to" CONTENT="pageverteci@gmail.com">
    <META NAME="REVISIT-AFTER" CONTENT="15 days">

    <!--fichier css-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/li-scroller.css">
    <link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/pagevertes.css">
    <link rel="stylesheet" type="text/css" href="css/tsc_pagination.css">
    <link href="css/colors/green.css" type="text/css" rel="stylesheet" id="color-style">

	<!-- carousel -->
    <link rel="stylesheet" href="js/carousel/flexslider.css" type="text/css" media="screen" />
 	<link rel="stylesheet" type="text/css" href="js/carousel/skin.css" />
    
	<!-- jquery jcarousel pub defilant -->
	<script src="js/jquery-1.11.2.min.js"></script>
	<script src="js/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/query.li-scroller.1.0.js"></script>
    <script src="js/code.js"></script>

    <!--googgle analytics-->
    <?php include_once("analyticstracking.php"); ?>

    <script>
        $(document).ready(function(){

          // hide #back-top first
          $("#back-top").hide();

          // fade in #back-top
          $(function () {
            $(window).scroll(function () {
              if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
              } else {
                $('#back-top').fadeOut();
              }
            });

            // scroll body to 0px on click
            $('#back-top a').click(function () {
              $('body,html').animate({
                scrollTop: 0
              }, 200);
              return false;
            });
          });

            //script recherche autocomplete
          $("#entreprise").autocomplete({
              source: 'pages/ajax.php',
              minLength: 1,
              select: function(event, ui) {
                    $('#entreprise').val(ui.item.value);
                    $("#searchForm").submit();

              },
              search: function(event, ui) {
                  $('.spinner').show();
              },
              open: function(event, ui) {
                  $('.spinner').hide();
              }
          });


            //script recherche autocomplete
            $("#search").autocomplete({
                source: 'pages/ajax.php',
                minLength: 1,
                select: function(event, ui) {
                    $('#search').val(ui.item.value);
                    $("#searchFormHome").submit();

                },
                search: function(event, ui) {
                    $('.spinner').show();
                },
                open: function(event, ui) {
                    $('.spinner').hide();
                }
            });
    });


        jQuery(document).ready(function($){
          // browser window scroll (in pixels) after which the "back to top" link is shown
          var offset = 300,
            //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
            offset_opacity = 1200,
            //duration of the top scrolling animation (in ms)
            scroll_top_duration = 700,
            //grab the "back to top" link
            $back_to_top = $('.cd-top');

          //hide or show the "back to top" link
          $(window).scroll(function(){
            ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
            if( $(this).scrollTop() > offset_opacity ) {
              $back_to_top.addClass('cd-fade-out');
            }
          });

          //smooth scroll to top
          $back_to_top.on('click', function(event){
            event.preventDefault();
            $('body,html').animate({
              scrollTop: 0 ,
               }, scroll_top_duration
            );
          });

        });

        tinymce.init({
          selector: '#textarea1',
          height: 250,
          menubar: false,  // removes the menubar
          toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ',
          content_css: '//www.tinymce.com/css/codepen.min.css'
        });

        function isNumeric(monChamp) {
            reg = new RegExp("[^0-9]", "i");
            if (!reg.test(monChamp.value)){
                //un traitement quelconque
            }else{
                alert('Vous devez saisir que des caracteres numeriques');
                monChamp.value = '';
            }
        }

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-64362902-1', 'auto');
          ga('send', 'pageview');


        //caroussel derniere entrepise
        $(function() {
            $(".lastentr-jcarousellite").jCarouselLite({
                vertical: true,
                hoverPause:true,
                visible: 1,
                auto:1500,
                speed:6000
            });
        });
    </script>
    <style type="text/css">
        a:link {
            text-decoration: none;
        }
        a:visited {
            text-decoration: none;
        }
        a:hover {
            text-decoration: none;
        }
        a:active {
            text-decoration: none;
        }

        /*recherche */
        .ui-widget{
            font-size: 14px;
            width: 260px;
            height: auto;
            max-height: 210px;
            display:none;
            margin-top:1px;
            border-top:0px;
            overflow:hidden;
            border:1px #CDCDCD solid;
            background-color: white;
            overflow: scroll;
            border: solid 1px #090;
            background-color: #ffffff;
            font-weight: bold;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .ui-menu .ui-menu-item a.ui-corner-all:hover,
        .ui-menu .ui-menu-item a.ui-corner-all:focus,
        .ui-menu .ui-menu-item a.ui-corner-all:active {
            background: #fff !important;
            color:#090;
            border-top: solid 1px;
            border-bottom: solid 1px;
            cursor: pointer;
            border-top: 1px dotted #f64535;
            transition: background-color .3s ease-in-out;
            -moz-transition: background-color .3s ease-in-out;
            -webkit-transition: background-color .3s ease-in-out;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .ui-state-hover,
        .ui-widget-content .ui-state-hover,
        .ui-widget-header .ui-state-hover,
        .ui-state-focus, .ui-widget-content .ui-state-focus,
        .ui-widget-header .ui-state-focus {
            background: #fff;
            color: #090;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            /*
            border-top: solid 1px;
            border-bottom: solid 1px;
            border-radius: 0;
            cursor: pointer;
            border-top: 1px dotted #f64535;
            transition: background-color .3s ease-in-out;
            -moz-transition: background-color .3s ease-in-out;
            -webkit-transition: background-color .3s ease-in-out;*/
        }

        .ui-menu-item {
            display: block;
            clear: both;
            font-weight: bold;
            /*line-height: 18px;*/
            color: #333;
            padding: 10px 15px;
            white-space: nowrap;
            font-weight: bold;
            cursor: pointer;
            border-top: 1px dotted #f64535;
            transition: background-color .3s ease-in-out;
            -moz-transition: background-color .3s ease-in-out;
            -webkit-transition: background-color .3s ease-in-out;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;


        &.ui-state-focus {
             color: #ffffff;
             text-decoration: none;
             background: #EEE;
             border-radius: 0px;
             -webkit-border-radius: 0px;
             -moz-border-radius: 0px;
             background-image: none;
         }
        }

        .ui-menu-item:first-letter{color: #090; font-weight: bold; font-size: 15px;}

        .ui-menu-item #results li:hover {
            background: none;
        }

        .ui-menu-item li:hover {
            background: none;
        }

        .ui-menu-item:hover {
            background: none;
        }

        h4#results-text {
            display: none;
        }
        ul#results {
            display: none;
            width: 43%;
            margin-top: 4px;
            border: 1px solid #ababab;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            -webkit-box-shadow: rgba(0, 0, 0, .15) 0 1px 3px;
            -moz-box-shadow: rgba(0,0,0,.15) 0 1px 3px;
            box-shadow: rgba(0, 0, 0, .15) 0 1px 3px;
            background-color: #fff;
            margin: auto auto auto 140px;
            z-index: 1000;
        }

        ul#results li {
            /*padding: 8px;*/
            cursor: pointer;
            border-top: 1px dotted #f64535;
            transition: background-color .3s ease-in-out;
            -moz-transition: background-color .3s ease-in-out;
            -webkit-transition: background-color .3s ease-in-out;
        }
        ul#results li:hover {
            background-color: #F7F7F7;
        }
        ul#results li:first-child {
            border-top: none;
        }
        ul#results li h3, ul#results li h4 {
            transition: color .3s ease-in-out;
            -moz-transition: color .3s ease-in-out;
            -webkit-transition: color .3s ease-in-out;
            color: #616161;
            line-height: 1.6em;
        }
        ul#results li:hover h3, ul#results li:hover h4  {
            color: #3b3b3b;
            font-weight: bold;
        }
        /*fin recherche */

    </style>

    <script src="js/modernizr.js"></script> <!-- Modernizr -->

    <link rel="shortcut icon" type="images/png" href="images/favicon.png">
</head>
<body>


<div class="container">
    <div class="row">
        <!-- Logo -->
        <div class="col-lg-12" style="padding:3px;">
            <div class="col-md-10">
                <a href="index.php"><img src="images/logo_slogan.png" class="img-responsive" alt="LOGO" /></a>
            </div>
            <div class="col-md-2" style="padding:5px 12px 0 0;">
                <div style="float:right; margin-top: -18px;">
                    <a href="index.php" title="Version Fran&ccedil;aise"><img src="images/fr.png" width="30" height="30" alt="FR" style="margin-bottom: -48px;margin-left: 40px"></a><br/>
                    <a href="en/index.php" title="Version Anglaise"><img src="images/en.png" width="30" height="30" alt="EN"></a>
                </div>
            </div><!--col-md-6-->
        </div><!--row-->
        <!-- Flash info -->
        <div class="col-md-12" style="margin:20px 0 20px 0;">
			<?php 
			//si nous sommes sur une page differente de l'accueil et que l'entrepise a une pub haute sur sa fiche, on presente la pub
			if(((!$_GET['page']) && (!$_GET['recherche'])) || ($pub_ese['image']!="")) {?>
                <div style=" max-height:270px; height:270px; background: <?php echo "url('".$zpub_search."')"; ?>  no-repeat center ;
                     text-align:center; border-radius: 5px; vertical-align: middle;">
                    
					<!-- zone de recherche par defaut -->
                </div>
			<?php }?>
				<div class="clearfix">&nbsp;</div>	
					<div class="widget widget-search search_fiche">
					
                        <form id="searchFormHome" method="get" action="resultat" class="form-horizontal">
                        <div class="form-group col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6" style="margin-top: 10%;">
                                <div class="col-lg-10">
                                    <input id="search" placeholder="Indiquer un sigle, une dénomination ou un mot clé ..."
                                           autocomplete="off" name="recherche" class="form-control col-lg-8" type="text" >
                                </div>
                                <div class=" col-lg-2">
                                    <input type="submit" class="btn btn-success" value="Rechercher"
                                           style="border-radius: 5px;" />
                                </div>
                            </div>
                            <div class="col-lg-3"></div>
                            <ul id="results" style="position:absolute; text-align:left"></ul>
                        </div>
                        </form>
					
                    </div>
                <div class="clearfix">&nbsp;</div>				
            <div class="flash">
                <marquee scrollamount="3" onMouseOut="this.start();" onMouseOver="this.stop();" >
                    <?php
					if((isset($bande_annonce))&&($bande_annonce!="")) {
						echo '<b style="font-size:18px;">'.$bande_annonce.' Les Pages Vertes de Côte d\'Ivoire, Annuaire des Professionnels du Secteur Agricole vous propose un Référencement gratuit de votre Entreprise.</b>';						
					}
						
                    else if($flash){
                        foreach ($flash as $f) { ?>
                       <b style="font-size:18px;"><?php echo $f['contenu']; ?></b>
                    <?php }}else{echo 'BIENVENUE SUR LE SITE LES PAGES VERTES';} ?>

                </marquee>
            </div><!--flash-->
        </div><!--col-md-12-->

        <!-- MENU PRINCIPPAL -->
        <div class="col-md-12">
            <nav class="navbar">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                            aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav">
                        <li class="dropdown" style="background:#72bf44;height:80px; padding-top:10px; width:228px; border-radius:5px 0px 0px 5px; text-align: center;">
                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle"  href="#">
                            <span class="rub_2" style="color:#FFF; background: none;">AGRICULTURE<br> ELEVAGE<br> <br></span>
                            </a>
                            <ul role="menu" class="dropdown-menu">
                             <?php foreach ($menu1 as $m1) { ?>
                             <li style="width:228px; border-top:1px solid #FFF; background:#72bf44; text-align:left; border-radius:5px 0px 0px 5px;">
                                 <a href="rubrique-<?php echo $m1['Id'].'&'.format_url(GetLibcateg($m1['Id_rubrique'])).'-'.format_url(GetLibRub($m1['Id'])).'-annuaire-agriculture-lespagesvertes'; ?>">
                                     <span style="color:#FFF; font-size:12px;"><?php echo $m1['rubrique']; ?></span>
                                 </a>
                             </li>
                              <?php }  ?>
                             </ul>
                        </li>             

                        <li class="dropdown" style="background:#1f6d3a;height:80px;border-left:1px solid #FFF;padding-top:10px; width:228px;">
                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="rub_2"><center> &nbsp;&nbsp;&nbsp;AGROINDUSTRIE<br>AGROALIMENTAIRE<br></center></span> 
                            </a>
                            <ul role="menu" class="dropdown-menu">
                                <?php foreach ($menu2 as $m2) { ?>
                                   <li style="width:227px; border-top:1px solid #FFF; background:#1f6d3a;text-align:left;">
                                       <a href="rubrique-<?php echo $m2['Id'].'&'.format_url(GetLibcateg($m2['Id_rubrique'])).'-'.format_url(GetLibRub($m2['Id'])).'-annuaire-agriculture-lespagesvertes'; ?>">
                                           <span style="color:#FFF; font-size:12px;"><?php echo $m2['rubrique']; ?></span></a>
                                   </li>
                                  <?php } ?>
                            </ul>
                       </li>

                        <li class="dropdown" style="background:#869c3c; border-left:1px solid #FFF; width:228px;">
                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="rub_3"><center>FILIERE <br> ASSOCIATION <br> STRUCTURE</center></span> 
                            </a>
                            <ul role="menu" class="dropdown-menu">
                                <?php foreach ($menu3 as $m3){ ?>
                                <li style="width:227px; border-top:1px solid #FFF; background:#869c3c;text-align:left;">
                                    <a href="rubrique-<?php echo $m3['Id'].'&'.format_url(GetLibcateg($m3['Id_rubrique'])).'-'.format_url(GetLibRub($m3['Id'])).'-annuaire-agriculture-lespagesvertes'; ?>">
                                        <span style="color:#FFF; font-size:13px;"><?php echo $m3['rubrique']; ?></span>
                                    </a></li>
                                  <?php } ?>
                            </ul>
                       </li>

                        <li class="dropdown" style="background:#f58220; border-left:1px solid #FFF;width:228px;">
                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="rub_2"><center>FORMATION <br> RECHERCHE <br> DEVELOPPEMENT</center></span> 
                            </a>
                            <ul role="menu" class="dropdown-menu">
                                <?php foreach ($menu4 as $m4){ ?>
                               <li style="width:227px; border-top:1px solid #FFF; background:#f58220;text-align:left;">
                                   <a href="rubrique-<?php echo $m4['Id'].'&'.format_url(GetLibcateg($m4['Id_rubrique'])).'-'.format_url(GetLibRub($m4['Id'])).'-annuaire-agriculture-lespagesvertes'; ?>">
                                       <span style="color:#FFF; font-size:12px;"><?php echo $m4['rubrique']; ?></span>
                                   </a></li>
                               <?php } ?>
                            </ul>
                        </li>
                        <li class="dropdown" style="background:#a15224; border-left:1px solid #FFF; width:228px; height:80px; padding-top:10px; border-radius:0px 5px 5px 0px;"> 
                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <center><span class="rub_5"><span style="color:#FFF;">PARTENAIRE <br> FOURNISSEUR  <br> </span></span></center></a>
                            <ul role="menu" class="dropdown-menu">
                                <?php foreach ($menu5 as $m5) { ?>     
                                <li style="width:227px; border-top:1px solid #FFF; background:#a15224;text-align:left; border-radius:0px 5px 5px 0px;">
                                    <a href="rubrique-<?php echo $m5['Id'].'&'.format_url(GetLibcateg($m5['Id_rubrique'])).'-'.format_url(GetLibRub($m5['Id'])).'-annuaire-agriculture-lespagesvertes'; ?>">
                                        <span style="color:#FFF; font-size:12px;"><?php echo $m5['rubrique']; ?></span>
                                    </a></li>                     
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </nav>
        </div>
    </div>
</div><!--container-->

    <div class="container">
        <div class="row">
            <div class="clearfix">&nbsp;</div>
            
            <div class="col-md-9" style="padding: 0;">
            <?php
            $pages = array('accueil','det_ese','det_cat','cat_ese','rubrique','referencement','annonce','ajout_annonce','det_annonce','contact','search','ese_cat','agence','resultat','responsable','ajout_res','save','traitement','publicite');

            if(isset($_GET['page'])){$page = nettoyage($_GET['page']);}else{$page = '';}

            if(in_array($page, $pages)){
                include('pages/'.$page.'.php');
            }
			
            else if($_GET['recherche']){
                include('pages/resultat.php');
            }	
					
            else{
                include('pages/accueil.php');
            }
						
			
			

            ?>
            </div>
            
            <div class="col-md-3">
                <?php include_once('pages/menu_droit.php'); ?>
            </div><!--col-md-3"-->

            <div class="clearfix"><br/></div>
            <div class="clearfix">&nbsp;</div>
                
            <!--<div class="col-md-12">
                <img src="< ?/*= $pub_site['image']; */?>" class="border img-responsive img-rounded" />
            </div>-->
            <!--LAST ENTREPRISE
			<?php //if($_GET['page']!="det_ese") {?>
            <div class="col-md-12">
                <?php //include_once("slide_last_ese.php"); ?>
            </div>			
			<div class="clearfix">&nbsp;</div>
			<?php //}?>-->
               <div class="col-md-12" style="background:#090; padding:8px 5px 5px 5px;  color:#fff; margin-top: 10px;">
                <p>
                    <span class="col-lg-6">
                        <b>&COPY; <?= gmdate('Y') ?> LES PAGES VERTES - Tous droits r&eacute;serv&eacute;s</b>
                    </span>
                    <span class="col-lg-6" style="text-align: right;">
                        <b>CREDIT PHOTO : ANADER - FIRCA - SAPH</b>
                    </span>
                </p>
            </div><!--col-md-12-->
        </div>
    </div>

    <a href="#0" class="cd-top">Top</a>
	
    <!--fichiers javascript-->


	
    <script>
        $(function(){
        $("ul#ticker01").liScroll();
        }); 

        dropdown.mouseleave(function () {
        menu.trigger('click');
    });
    </script>

	<!-- style switcher -->

<!-- jquery jcarousel partenaire defilant -->
<script src="js/style-switcher/jquery-1_.js"></script>	
<script src="js/style-switcher/styleselector_.js"></script>	
<script type="text/javascript" src="js/carousel/jquery.jcarousel.min_.js"></script>
<script defer src="js/carousel/jquery.flexslider_.js"></script>
<script defer src="js/carousel/custom_.js"></script>
<!-- jquery jcarousel -->

<script type="text/javascript">
(function($) {
 "use strict";

	jQuery(document).ready(function() {
			jQuery('#mycarouselthree').jcarousel();
	});
	
})(jQuery);
</script>

<!--jquery ui-->
<link rel="stylesheet" href="library/jquery-ui/jquery-ui.css">
<script src="library/jquery-ui/jquery-ui.js"></script>

	
	<?php 
	// Déconnexion de la BDD		
	if($db){
	//$db = NULL;
	}
	?>
</body>
</html>