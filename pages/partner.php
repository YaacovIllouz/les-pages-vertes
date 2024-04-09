<script src="../js/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
<script type="text/javascript">
  $(function() {
    $(".newsticker-jcarousellite").jCarouselLite({
      vertical: true,
      hoverPause:true,
      visible: 1,
      auto:500,
      speed:2000
    });
  });
</script>
<div class="newsticker-jcarousellite">
  <ul>
    <?php
    $par = $db->query("SELECT * FROM partenaire")->fetchAll();
    if(is_array($par)){
      foreach ($par as $p){
    ?>
    <li style="min-height: 130px;">
      <a href="<?= $p['site']; ?>" target="_blank" title="<?= $p['nom']; ?>">
        <img src="<?= $p['logo']; ?>" width="150" alt="<?= $p['nom']; ?>" />
      </a>
    </li>
    <?php  } } ?>
  </ul>
</div>