<?php
    session_start();
    require_once('../../config/main_include_en.inc');
    require_once('../../class/class.inc');
    require_once('../../Connections/annuaire_en.php');

    if (!function_exists("GetSQLValueString")) {
        function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
        {
            if (PHP_VERSION < 6) {
                $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
            }

            $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

            switch ($theType) {
                case "text":
                    $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                    break;
                case "long":
                case "int":
                    $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                    break;
                case "double":
                    $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                    break;
                case "date":
                    $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                    break;
                case "defined":
                    $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                    break;
            }
            return $theValue;
        }
    }

$maxRows_rs_rubrique = 10;
$pageNum_rs_rubrique = 0;
if (isset($_GET['pageNum_rs_rubrique'])) {
  $pageNum_rs_rubrique = $_GET['pageNum_rs_rubrique'];
}
$startRow_rs_rubrique = $pageNum_rs_rubrique * $maxRows_rs_rubrique;

mysql_select_db($database_annuaire, $annuaire);
$query_rs_rubrique = "SELECT * FROM rubrique ORDER BY rubrique ASC";
$query_limit_rs_rubrique = sprintf("%s LIMIT %d, %d", $query_rs_rubrique, $startRow_rs_rubrique, $maxRows_rs_rubrique);
$rs_rubrique = mysql_query($query_limit_rs_rubrique, $annuaire) or die(mysql_error());
$row_rs_rubrique = mysql_fetch_assoc($rs_rubrique);

if (isset($_GET['totalRows_rs_rubrique'])) {
  $totalRows_rs_rubrique = $_GET['totalRows_rs_rubrique'];
} else {
  $all_rs_rubrique = mysql_query($query_rs_rubrique);
  $totalRows_rs_rubrique = mysql_num_rows($all_rs_rubrique);
}
$totalPages_rs_rubrique = ceil($totalRows_rs_rubrique/$maxRows_rs_rubrique)-1;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Zone d'administration lespagesvertesci.net</title>
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../css/tsc_pagination.css">
    <link href="../../fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="js/hideshow.js" type="text/javascript"></script>
    <script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.equalHeight.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <!--<script type="text/javascript" src="../js/ajax.js"></script>-->

    <link rel="stylesheet" href="../library/jquery-ui/jquery-ui.css">
    <script src="../library/jquery-ui/jquery-ui.js"></script>

    <script type="text/javascript">
	$(document).ready(function() {

            //When page loads...
            $(".tab_content").hide(); //Hide all content
            $("ul.tabs li:first").addClass("active").show(); //Activate first tab
            $(".tab_content:first").show(); //Show first tab content

            //On Click Event
            $("ul.tabs li").click(function() {

                    $("ul.tabs li").removeClass("active"); //Remove any "active" class
                    $(this).addClass("active"); //Add "active" class to selected tab
                    $(".tab_content").hide(); //Hide all tab content

                    var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                    $(activeTab).fadeIn(); //Fade in the active ID content
                    return false;
            });

            $('.column').equalHeight();

            $(".tablesorter").tablesorter();


            $("#recherche").autocomplete({
                source: '../pages/ajax.php',
                minLength: 1,
                select: function(event, ui) {
                    $('#recherche').val(ui.item.value);
                    $("#serachForm").submit();

                },
                search: function(event, ui) {
                    $('.spinner').show();
                },
                open: function(event, ui) {
                    $('.spinner').hide();
                }
            });

            $("#sigle").autocomplete({
                source: '../pages/ajax.php',
                minLength: 1,
                select: function(event, ui) {
                    $('#recherche').val(ui.item.value);
                }
            });

        });
        
        CKEDITOR.replace( 'editor1' );
    </script>

    <style>
        .module_content a.btn{
            color: #000;
        }
        .tablesorter td{ border: dotted 1px #ccc;}

        input[type='text'].ui-autocomplete-loading {
            background:  url('../images/ajax-loader.gif') no-repeat right center;
        }

        .ui-widget{
            font-size: 12px;
            width: 260px;
            height: auto;
            max-height: 280px;
            display:none;
            margin-top:1px;
            border-top:0px;
            overflow:hidden;
            border:1px #CDCDCD solid;
            background-color: white;
            overflow-y: scroll;
            border: solid 1px #090;
            background-color: #ffffff;
            /*font-family: "Times New Roman";*/
        }

        .ui-menu .ui-menu-item a.ui-corner-all:hover,
        .ui-menu .ui-menu-item a.ui-corner-all:focus,
        .ui-menu .ui-menu-item a.ui-corner-all:active {
            background: #fff !important;
            color:#090;
            border-top: solid 1px;
            border-bottom: solid 1px;
        }

        .ui-state-hover,
        .ui-widget-content .ui-state-hover,
        .ui-widget-header .ui-state-hover,
        .ui-state-focus, .ui-widget-content .ui-state-focus,
        .ui-widget-header .ui-state-focus {
            background: #fff;
            color: #090;
            border-top: solid 1px;
            border-bottom: solid 1px;
            border-radius: 0;
        }

        ..ui-menu-item {
            font-weight: bold;
            display: block;
            clear: both;
            font-weight: normal;
            line-height: 20px;
            color: #000;
            white-space: nowrap;
            padding: 5px 0;
            border-bottom: solid 1px #ccc;

        &.ui-state-focus {
             color: #ffffff;
             text-decoration: none;
             background: #ccc;
             border-radius: 0px;
             -webkit-border-radius: 0px;
             -moz-border-radius: 0px;
             background-image: none;
         }
        }

        .ui-menu-item:first-letter{color: #090; font-weight: bold; font-size: 15px;}
        /*fin recherche */
    </style>
</head>
<body>
    <header id="header">
        <hgroup>
            <h1 class="site_title"><a href="index.php">LES PAGES VERTES</a></h1>
            <h2 class="section_title" style="width:600px; float: left;">Zone d'administration</h2>
            <div style="width: 200px; float: right;"><br/><a href="../../admin/" target="_blank" style="background:
            #1D8A11; color: #FFFFFF;"><b>ZONE ADMIN EN FRANCAIS</b></a></div>
        </hgroup>
    </header> <!-- end of header bar -->
	
    <section id="secondary_bar">
        <div class="user">
            <p>Administrateur</p>
        </div>
        <div class="breadcrumbs_container">
            <article class="breadcrumbs">
                <a href="index.php">Website Admin</a> 
                <div class="breadcrumb_divider"></div> <a class="current">Zone d'administration</a>
            </article>
        </div>
    </section><!-- end of secondary bar -->
	
    <aside id="sidebar" class="column">
        <form class="quick_search" action="index.php?page=search" method="post" id="serachForm">
            <input type="text" name="recherche" id="recherche" placeholder="Recherche" style="width:85%; float: left;">
            <div class="ui-widget"></div>
            <input type="submit" name="sub" value="OK" style="border-radius: 25%; margin: 3px 0 0 0;" />
        </form>
        <hr/>
        
        <h3><b style="color:green;">RUBRIQUES</b></h3>
        <ul class="toggle">
            <li class="icn_edit_article"><a href="index.php?page=ajout_rubrique">Ajouter une cat&eacute;gorie</a></li>
            <li class="icn_edit_article"><a href="index.php?page=liste_rubrique">Liste des cat&eacute;gories</a></li>
            <li class="icn_categories"><a href="index.php?page=ajout_sous_rubrique">Ajouter une rubrique</a></li>
            <li class="icn_categories"><a href="index.php?page=liste_sr">Liste des rubriques</a></li>
        </ul>
        
        <h3><b style="color:green;">ENTREPRISE</b></h3>
        <ul class="toggle">
            <li class="icn_edit_article"><a href="index.php?page=ajout_ese">Ajouter une entreprise</a></li>
            <li class="icn_edit_article"><a href="index.php?page=ref">R&eacute;f&eacute;rencement</a></li>
            <li class="icn_categories"><a href="index.php?page=ref_soumis">R&eacute;f&eacute;rencement Soumis</a></li>
            <li class="icn_categories"><a href="index.php?page=ese_dup">Dupliquer une fiche</a></li>
        </ul>
        
        <h3><b style="color:green;">CATEGORIE</b></h3> 
        <ul class="toggle"> 
            <?php do { ?>
              <li class="icn_view_users" style="text-transform: capitalize;"><a href="index.php?page=ese_rub&id=<?php echo $row_rs_rubrique['Id']; ?>">
                  <?php echo strtolower($row_rs_rubrique['rubrique']); ?></a></li>
            <?php } while ($row_rs_rubrique = mysql_fetch_assoc($rs_rubrique)); ?>
        </ul>
        
        <h3><b style="color:green;">FLASH INFO</b></h3>
        <ul class="toggle">
            <li class="icn_folder"><a href="index.php?page=ajout_flash">Ajouter un journal lumineux</a></li>
            <li class="icn_photo"><a href="index.php?page=all_flash">Liste des journaux lumineux publi&eacute;es</a></li>
        </ul>

        <h3><b style="color:green;">GESTION DES ANNONCES</b></h3>
        <ul class="toggle">
            <li class="icn_settings"><a href="index.php?page=annonce">Ajouter une annonce</a></li>
            <li class="icn_security"><a href="index.php?page=all_annonce">Les annonces publi&eacute;s</a></li>
        </ul>

        <h3><b style="color:green;">PUBLICITES</b></h3>
        <ul class="toggle">
            <li class="icn_settings"><a href="index.php?page=ajout_pub_accueil">Ajouter une pub accueil</a></li>
            <li class="icn_settings"><a href="index.php?page=pub_bas">Ajouter une pub Fiche</a></li>
        </ul>

        <h3><b style="color:green;">PARTENAIRES</b></h3>
        <ul class="toggle">
            <li class="icn_settings"><a href="index.php?page=ajout_partenaire">Ajouter un partenaire</a></li>
        </ul>

        <h3><b style="color:green;">PUB RECHERCHE ACCUEIL</b></h3>
        <ul class="toggle">
            <li class="icn_settings"><a href="index.php?page=pub_search">Ajouter une publicit&eacute;</a></li>
        </ul>

        <footer>
            <hr />
            <p><strong>&copy; <?php gmdate('Y'); ?> Administration les pages vertes</strong></p>
        </footer>
    </aside><!-- end of sidebar -->
	
    <section id="main" class="column">	
        <?php
        $pages = array('accueil','ajout_rubrique','liste_rubrique','mod_rubrique','sup_rubrique',
            'ajout_sous_rubrique','liste_s_rubrique','mod_sr','ajout_ese','liste_ese','ajout_flash',
            'ajout_agence','ajout_dirigeant','mod_ese','sup_ese','annonce','all_flash','fiche_ese',
            'sup_sr','sup_ese','mod_flash','sup_flash','sup_agence','mod_agence','liste_sr','ajout_pub',
            'ese_cat','ese_s','ese_rub','search','ajout_pub_cat','all_annonce','mod_annonce','sup_annonce',
            'ajout_pub_accueil','mod_pub_accueil','sup_accueil','mod_pub_ese','sup_pub_ese','mod_logo',
            'ajout_pub2','mod_pub_cat','sup_pub_cat', 'ref','mod_ref','list_pub','ref_soumis','ajout_partenaire',
            'pub_search','pub_bas','ese_dup','etat_pubsite','fixe_pubsite','slide_pubsite');
		
        if(isset($_GET['page'])){$page = nettoyage($_GET['page']);}else{$page = '';}

        if(in_array($page,$pages))
        {
                include($page.'.php');
        }
        else
        {
                include('accueil.php');
        }
        ?>
        <div class="spacer"></div>
    </section>
    <script>
        $(document).ready(function (){

            $("#rubrique").change(function () {
                var rub = $("#rubrique").val();
                $.ajax({
                    type : 'POST',
                    url  : 'france.php',
                    data : 'rub='+rub,
                    success : function (server_response) {
                        $("#bloc-sousrub").html(server_response);
                    }
                });
            });

        })
    </script>
</body>
</html>