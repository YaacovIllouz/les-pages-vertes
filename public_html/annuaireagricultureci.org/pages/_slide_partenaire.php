<div class="container">
      <div class="margin_top5"></div>
        
            <div class="clients" style="margin-left:-15px">
        		<h4 class="titre_partenaire"><b>NOS PARTENAIRES</b></h4>
                <br />
                <div class="container" style="margin-left:-15px">
                    
                    <ul id="mycarouselthree" class="jcarousel-skin-tango" style="height:100px">
						<?php
							$par = $db->query("SELECT * FROM partenaire")->fetchAll();
							if(is_array($par)){
							foreach ($par as $p){
							?>
							<li>
							<a href="<?= $p['site']; ?>" target="_blank" title="<?= $p['nom']; ?>">
							<img src="<?= $p['logo']; ?>" style="max-height:150px; max-width:150px; width:auto; height:50px" alt="<?= $p['nom']; ?>" />
							</a>
							</li>
                        <?php  } } ?>
                    </ul>                   
                    
                
                </div>
        
        </div>
    
    </div>
</div>