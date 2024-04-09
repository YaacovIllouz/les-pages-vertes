<?php
$pub_milieu = $db->query("SELECT image FROM pub_site WHERE position = 'Milieu' ORDER BY Id DESC LIMIT 0,1")->fetchAll();
$pub_gauche = $db->query("SELECT image FROM pub_site WHERE position = 'Gauche' ORDER BY Id DESC")->fetch();
?>

<div class="col-md-4">
    <img src="<?php echo $pub_gauche['image']; ?>" alt="Pub gauche" class="img-responsive border" style="border-radius:3px;" />
</div><!--col-md-3-->

<div class="col-md-8">
    <div class="last_add" style="border:1px solid #090; border-radius:3px 3px 3px 3px;">
        <!--<h1 class="titre">L'AGRICULTURE IVOIRIENNE</h1>-->
        <iframe width="535" height="300" src="https://www.youtube.com/embed/venXRekxIlY" frameborder="0" allowfullscreen></iframe>
    </div><!--slide-->
    <br />
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <!--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
         <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>-->
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php 
            $i = 0;
            foreach($pub_milieu as $p){
                $i++;
            ?>
            <div class="item <?php if($i==1){echo 'active';} ?>" >
                <img src="<?= $p['image']; ?>" alt="Pub milieu" class="img-responsive img-rounded">
            </div>
            <?php } ?>
        </div>

        <!-- Left and right controls -->
        <!--<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>-->
    </div><!--carousel-->

<div class="clearfix">&nbsp;</div>
<!-- derniere annoncee -->
<div>
    <div class="titre_droit" style="border-radius:3px; font-weight: bold;">DERNIERES ENTREPRISES AJOUTEES</div>
    <div style="border:1px solid #090; border-radius:3px 3px 3px 3px;">
        <?php include_once("last_ese.php"); ?>
        <div>&nbsp;</div>
    </div>
    <!--
    <?php
/*    $select = $db->query("SELECT * FROM annonce WHERE etat=1 ORDER BY Id DESC LIMIT 0, 2 ")->fetchAll();
        if($select){
            echo '<div class="titre_droit" style="border-radius: 5px; font-weight: bold;">
        DERNIERES ANNONCES
        <span style=" float: right;"><a href="?page=annonce" style="color:#fff;"> Voir plus</a>&nbsp;</span>
    </div><br/>';
            foreach($select as $row_rs_annonce){
        $date = explode(' ', $row_rs_annonce['date']);
        */?>
        <div class="col-md-12" style="min-height:100px; border:1px solid #090; margin-bottom:10px; border-radius:10px; padding:0px;">
            <div class="col-md-12" style="padding:5px 10px;">
                <b style=" color:#090;">
                    <a href="?page=det_annonce&id=<?/*= $row_rs_annonce['Id']; */?>" title="Voir les d&eacute;tails" style="color: #090;">
                        <?/*= $row_rs_annonce['titre'];*/?>
                    </a>
                </b>
            </div><br/>
            <div style="padding:5px 10px;">
                <div style="color:#000;">
                    <b>Entreprise : <?/*= $row_rs_annonce['entreprise']; */?></b><br />
                    <b>T&eacute;l&eacute;phone : <?/*= $row_rs_annonce['contact']; */?></b> <br/>
                    <b>Email : <?/*= $row_rs_annonce['email']; */?></b>
                </div>
            </div>
            <div class="col-md-12" style="background:#090; height:25px; border-radius:0px 0px 8px 8px;">
                <span style="float:left; margin-top:3px; height:15px;color:#FFF;">
                    Publi&eacute;e le <?/*= '<b>'.reverseDateFr($date[0]). '</b>';*/?>
                </span>
                    <span style="float:right; margin-top:3px; height:15px;color:#FFF;">
                    <a href="?page=det_annonce&id=<?/*= $row_rs_annonce['Id']; */?>"
                       title="Voir les d&eacute;tails" style="color:#FFF;">
                        <b>D&eacute;tails ></b>
                    </a>
                </span>
            </div>
        </div><br />
        --><?php /*}} */?>
    </div>

</div><!--col-md-8-->