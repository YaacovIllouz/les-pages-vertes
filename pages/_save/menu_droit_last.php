<div class="titre_droit_menu">
    <a href="index.php"><b>ACCUEIL</b></a>
</div>
<!--home-->
<!--<div class="titre_droit"><b>RECHERCHER</b></div><!--search-->
<!--<div class="search" style="border-radius:0px 0px 5px 5px;;">
    <form method="post" action="index.php?page=resultat" name="serachForm" id="serachForm">
        <div class="form-group col-lg-12" style="padding: 0;">
            <input type="text" class="form-control col-lg-7" id="entreprise" name="entreprise"
                   placeholder="Sigle, D&eacute;nomination, Rubrique" required onblur="this.value='';"
                   value="" />
            <div class="ui-widget"></div>
        </div>
        <br/><br/>
        <div class="form-group col-lg-12">
            <div class="form-group col-lg-7"></div>
            <div class="form-group col-lg-5">
                <button type="submit" name="btnValide" class="btn btn-success active" style="border-radius:5px;"><b>VALIDER</b></button>
            </div>
        </div>
    </form>
</div>
<br/>-->

<!--référencement-->
<div class="titre_droit"><b>REFERENCEMENT GRATUIT</b></div>
<div class="bloc_droit" style="">
    <ul>
        <li class="menu"><a href="index.php?page=referencement">Cr&eacute;er</a></li>
        <li class="menu"><a href="index.php?page=contact">Modifier</a></li>
    </ul>
</div>

<!--dernieres entreprise ajouter-->
<!--<div class="titre_droit"><b style="font-size: 13px;">DERNIERES ENTREPRISES AJOUTEES</b></div>
<div class="bloc_droit">
    <div class="lastentr-jcarousellite">
        <ul>
            <?php
/*            $last = $db->query("SELECT * FROM entreprise ORDER BY Id_ese DESC LIMIT 0,4")->fetchAll();
            foreach ($last as $l){
            */?>
                <li style="margin-bottom: 5px;"><a href="index.php?page=det_ese&id=<?/*= $l['Id_ese']; */?>">
                        <img src="<?/*= $l['image'];*/?>" width="150" height="81" alt="<?/*= $l['sigle'];*/?>" />
                    </a><br />
                    <span style="font-size:16px; font-weight:bold"><?/*= $l['sigle'];*/?></span>
                </li>
            <?php /*} */?>
        </ul>
    </div>
</div>-->

<!--Annoncce-->
<div class="titre_droit"><b>ANNONCES</b></div>
<div class="bloc_droit">
    <ul>
        <li class="menu"><a href="index.php?page=ajout_annonce">Publier une annonce</a></li>
        <li class="menu"><a href="index.php?page=annonce">Toutes les annonces</a></li>
    </ul>
</div>

<!--Video-->
<div class="titre_droit"><b>VIDEO</b></div>
<div class="bloc_droit">
<iframe width="100%" height="auto" src="https://www.youtube.com/embed/venXRekxIlY" frameborder="0" allowfullscreen></iframe>
</div>

<!--Partenaires-->
<div class="titre_droit"><b>NOS PARTENAIRES</b></div>
<div class="bloc_droit">
    <?php include_once("partner.php"); ?>
</div>





<div class="titre_droit_menu"><a href="index.php?page=contact"><b>NOUS CONTACTER</b></a></div>
<!--<div class="titre_droit_menu"><a href="index.php"><b>ACCUEIL</b></a></div>home-->

<!--référencement-->
<div class="titre_droit"><b>SUIVEZ-NOUS</b></div>
<div class="bloc_droit" style="max-height:60px; height:70px; min-height:70px;">
    <div style="text-align: center; color: #090;">
        <a href="https://www.facebook.com/lespagesvertesci.net" target="_blank"><i id="social" class="fa fa-facebook-square fa-3x social-fb"></i></a>
        <a href="https://twitter.com/pageverteci" target="_blank"><i id="social" class="fa fa-twitter-square fa-3x social-tw"></i></a>
        <a href="https://plus.google.com/u/0/105743595372533030444/posts" target="_blank"><i id="social" class="fa fa-google-plus-square fa-3x social-gp"></i></a>
        <a href="https://www.linkedin.com/in/lespagesvertesci" target="_blank"><i id="social" class="fa fa-linkedin-square fa-3x social-gp"></i></a>
    </div>
</div>
<?php 
//$db = null;
?>