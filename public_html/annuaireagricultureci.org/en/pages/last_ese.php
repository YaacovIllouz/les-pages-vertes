<?php
$last = $db->query("SELECT Id_ese, sigle, entreprise, image FROM entreprise WHERE Id_rubrique > 0 ORDER BY Id_ese DESC LIMIT 0,3")->fetchAll();
?>
<div>
  <?php foreach ($last as $row_rs_lats_ese) { ?>
  <div class="col-md-2" style="height:60px;">
      <a href="index.php?page=det_ese&id=<?= $row_rs_lats_ese['Id_ese']; ?>">
          <img src="<?= $row_rs_lats_ese['image']; ?>"  class="img-responsive" />
      </a>
  </div><!--col-md-4-->
  <div class="col-md-10" style="height:80px; font-weight: bold;">
        <a href="index.php?page=det_ese&id=<?= $row_rs_lats_ese['Id_ese']; ?>">
            <span style="color:#060; font-size:18px;"><b><?= $row_rs_lats_ese['sigle']; ?></b></span><br />
            <span style="color:#000; font-size:14px;"><b><?= $row_rs_lats_ese['entreprise']; ?></b></span>
        </a>
  </div> <!--col-md-9-->
    <hr style="border-bottom: solid 1px #ccc;"/>
    <?php } ?>
</div>