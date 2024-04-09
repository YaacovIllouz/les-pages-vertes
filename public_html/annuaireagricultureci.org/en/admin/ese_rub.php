<?php
if(isset($_GET['id'])) {
  $id = $_GET['id'];

$rs = $db->query("SELECT * FROM sous_rubrique WHERE Id_rubrique = ".$id." ORDER BY rubrique ASC")->fetchAll();
$i=1;
?>

<article class="module width_full">
    <header>
        <h3><b>
            Les rubriques de la catégorie
            <?php
            $rub = $db->query("SELECT * FROM rubrique WHERE Id = '".$id."'")->fetch();
            echo $rub['rubrique'];
            ?>
          </b></h3>
    </header>
    <div class="module_content">
            <table class="tablesorter" cellspacing="0">
              <thead>
              <tr>
                <th>N&deg</th>
                <th>Cat&eacute;gories</th>
                  <th>Pub</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($rs as $row_rs_sous_rub) { ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td  valign="middle">
                    <a href="index.php?page=liste_ese&id=<?php echo $row_rs_sous_rub['Id']; ?>">
                      <span style="color:#090;"><b><?php echo $row_rs_sous_rub['rubrique']; ?></b></span>
                    </a>
                  </td>
                    <td>
                        <a href="index.php?page=ajout_pub_cat&id=<?php echo $row_rs_sous_rub['Id']; ?>">
                            <span style="color:#090;"><b>Ajouter pub</b></span>
                        </a>
                    </td>
                </tr>
              <?php } ?>
              </tbody>

            </table>
        </div>
  </div>
  </article>
<?php } ?>