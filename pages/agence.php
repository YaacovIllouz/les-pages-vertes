<?php
if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $page  = "?page=agence&id=".$id."&current_page=";
    $page1 = "?page=agence&id=".$id;

    $nb_results_p_page = 6; // nombre de r�sultats par page
    $nb_avant = 1; // nombre de page avant la page courante
    $nb_apres = 3; // nombre de page apr�s la page courante
    $premiere = 1; // aficher le lien "premi�re page" (1 ou 0)
    $derniere = 1; // afficher le lien "derni�re page" (1 ou 0)
    $courant = empty($_GET['current_page']) ? 1 : $_GET['current_page']; // page
    $start = ($courant - 1) * $nb_results_p_page; // start (requete mysql)

    // comptage du nombre de lignes de la base
    $count1 = $db->query("SELECT COUNT(Id) AS total FROM agence WHERE Id_ese = ".$id)->fetch();
    if($count1){
        $nb_results = $count1['total'];
    }

    //liste des agences pour l'entreprise
    $agence = $db->query("SELECT * FROM agence WHERE Id_ese = '".$id."' ORDER BY agence ASC LIMIT ".$start.", ".$nb_results_p_page." ")->fetchAll();
?>

<div class="col-md-4">
    <?php
    $pub = $db->query("SELECT image FROM pub_site WHERE position = 'Annonce' ORDER BY Id DESC LIMIT 1 ")->fetch();
    if($pub) { ?>
        <img src="<?php echo $pub['image']; ?>"  class="img-responsive pub_gauche"  />
    <?php }?>
</div><!--col-md-3"-->
<div class="col-md-8">
    <div class="titre_droit"><b>NOS AGENCES / NOS SITES</b></div><br />

    <?php
        foreach ($agence as $row_rs_agence) { ?>
            <div class="col-md-12"
                 style="min-height:120px; border:1px solid #090; margin-bottom:10px; border-radius:10px; padding:0px;">
                <table style="width: 100%;">
            <tr>
                <td style="width:120px;"><b style="margin-left:20px;">Adresse</b></td>
                <td>
                    <span style="color:#090;"><b><?php echo $row_rs_agence['sit_geographique']; ?></b></span><br/>
                    <span style=" color:#090;"><b><?php echo $row_rs_agence['agence']; ?></b></span>
                </td>
            </tr>
                    <tr>
                        <td colspan="2" style="border-bottom:1px dotted #CCC;"></td>
                    </tr>
            <tr>
                <td><b style="margin-left:20px;">Tel.</b></td>
                <td><b><?php echo $row_rs_agence['tel']; ?></b></td>
            </tr>
                    <tr>
                        <td colspan="2" style="border-bottom:1px dotted #CCC;"></td>
                    </tr>
            <tr>
                <td><b style="margin-left:20px;">Cel.</b></td>
                <td><b><?php echo $row_rs_agence['cel']; ?></b></td>
            </tr>
                    <tr>
                        <td colspan="2" style="border-bottom:1px dotted #CCC;"></td>
                    </tr>
            <tr>
                <td><b style="margin-left:20px;">Email</b></td>
                <td><b><?php echo $row_rs_agence['email']; ?></b></td>
            </tr>
                </table>
            </div>
        <?php } ?>

    <div class="clearfix">&nbsp;</div>
        <!-- Pagination -->
    <div style="text-align: center;">   <!-- DC Pagination:A1 Start -->
        <ul class="tsc_pagination tsc_paginationA tsc_paginationA06"  style="text-align: center;">
            <?php
            // nombre total de pages
            $nb_pages = ceil($nb_results / $nb_results_p_page);

            // nombre de pages avant
            $avant = $courant > ($nb_avant + 1) ? $nb_avant : $courant - 1;
            // nombre de pages apr�s
            $apres = $courant <= $nb_pages - $nb_apres ? $nb_apres : $nb_pages - $courant;

            // premi�re page
            if($premiere && $courant - $avant > 1)
                echo '<li><a href="'. $_SERVER['SCRIPT_NAME'].$page1.'" class="first" title="D&eacute;but">&lt;&lt;</a></li>';

            // page pr�c�dente
            if($courant > 1)
                echo '<li><a href="'.$_SERVER['SCRIPT_NAME'].$page.($courant-1).'" class="previous" title="Pr&eacute;c.">&lt;</a></li>';

            // affichage des num�ros de page
            for($i = $courant - $avant; $i <= $courant + $apres; $i++)
            {
                // page courante
                if($i == $courant)
                    echo '<li><a href="#" class="current">'.$i.'</a></li>';
                else
                    echo '<li><a href="'.$_SERVER['SCRIPT_NAME'].$page.$i.'">'.$i.'</a></li>';
            }

            // page suivante
            if($courant < $nb_pages)
                echo '<li><a href="'.$_SERVER['SCRIPT_NAME'].$page.($courant + 1).'" class="next" title="Suiv.">&gt;</a></li>';

            if($derniere && $courant + $apres < $nb_pages)
                echo '<li><a href="'.$_SERVER['SCRIPT_NAME'].$page.$nb_pages.'" class="last" title="Fin">&gt;&gt;</a></li>';
            ?>
        </ul>
    </div>
</div><!--col-md-8"-->
<?php } ?>