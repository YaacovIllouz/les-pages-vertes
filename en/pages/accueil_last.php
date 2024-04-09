<?php
$pub_milieu = $db->query("SELECT image FROM pub_site WHERE position = 'Milieu' AND fixe = 1 AND etat = 1 ORDER BY Id DESC LIMIT 0,1")->fetchAll();

$pub_milieu_defilant = $db->query("SELECT image FROM pub_site WHERE position = 'Milieu' AND defilant = 1 AND etat = 1 ORDER BY Id DESC LIMIT 0,8")->fetchAll();

$pub_gauche = $db->query("SELECT image FROM pub_site WHERE position = 'Gauche' ORDER BY Id DESC")->fetch();
?>

<div class="col-md-4">
    <img src="<?= $pub_gauche['image']; ?>" class="img-responsive border" style="border-radius:3px;" />
</div><!--col-md-3-->

<div class="col-md-8">
    <div class="last_add" style="border:1px solid #090; border-radius:3px 3px 3px 3px;">
        <!--<h1 class="titre">L'AGRICULTURE IVOIRIENNE</h1>-->
        <iframe width="535" height="300" src="https://www.youtube.com/embed/venXRekxIlY" frameborder="0" allowfullscreen></iframe>
    </div><!--slide-->
	<br />
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
       <!-- <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
         <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>-->

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php 
            $i = 0;
            foreach($pub_milieu_defilant as $p){
                $i++;
            ?>
            <div class="item <?php if($i==1){echo 'active';} ?>" >
                <img src="<?= $p['image']; ?>" alt="Pub milieu" class="img-responsive img-rounded">
            </div>
            <?php } ?>
        </div>

        <!-- caroussel poub milieu Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Précédent</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Suivant</span>
        </a>
    </div><!--carousel-->
    <br />
    <div id="myCarousel_" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <!--<ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <!-- <li data-target="#myCarousel" data-slide-to="1"></li>
			 <li data-target="#myCarousel" data-slide-to="2"></li>
			 <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>-->

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php
                $i = 0;
                foreach($pub_milieu as $p){
                    $i++;
                    ?>
                    <div class="item <?php if($i==1){echo 'active';} ?>" >
                        <img src="../<?= $p['image']; ?>" alt=" " class="img-responsive img-rounded">
                    </div>
                <?php } ?>
        </div>

		<!-- caroussel poub milieu Left and right controls 
       <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>-->
    </div><!--carousel-->
       

    <div class="clearfix">&nbsp;</div>

</div><!--col-md-8-->