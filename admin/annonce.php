<?php
$maintenant = time();

if((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $nom        = minToMajSansAccent($_POST['civilite'].' '.$_POST['nom']);
  $email      = strtolower($_POST['email']);
  $phone      = $_POST['phone'];
  $societe    = minToMajSansAccent($_POST['societe']);
  $titre      = minToMajSansAccent($_POST['titre']);
  $contenu    = htmlentities($_POST['contenu']);
  $etat       = $_POST['etat'];

  if(isEmail($email)){
    $envoi = $db->query('INSERT INTO annonce SET nom="'.$nom.'", entreprise="'.$societe.'", contact="'.$phone.'", 
                        email="'.$email.'", titre="'.$titre.'", contenu="'.$contenu.'", date="'.gmdate('Y-m-d H:i:s').'", etat="'.$etat.'" ');
    if($envoi){
      echo '<script>alert("VOTRE ANNONCE A ETE AJOUTEE AVEC SUCCES");</script>';
      echo '<script>document.location.href="?page=all_annonce";</script>';
    }
    else{
      echo '<div style="color: red;"><h3 class="alert alert-danger">Une erreur est survenue lors de l\'envoi 
                  de votre annonce.</h3></div>';
    }
  }
}
?>

<article class="module width_full">
    <header>
        <h3><b>Gestion des Annonces - Ajouter une annonce</b></h3>
    </header>
    <div class="module_content">

        <form action="" method="post" name="form1" id="form1">
            <table align="center" style="width:100%;">

              <tr valign="baseline">
                <td  style="width:20%;" align="right" valign="middle"><br/><b>Civilit&eacute;</b></td>
                <td>&nbsp;</td>
                <td><br/>
                  <select name="civilite" style="padding: 5px; width: 90%;">
                    <option value="">--- S&eacute;lectionnez ---</option>
                    <option value="MME">MADAME</option>
                    <option value="MLLE">MADEMOISELLE</option>
                    <option value="M.">MONSIEUR</option>
                  </select>
                </td>
              </tr>

              <tr valign="baseline">
                <td style="width:20%;" align="right" valign="middle" ><br/><b>Nom & Pr&eacute;noms</b></td>
                <td style="width: 2px">&nbsp;</td>
                <td style="width:78%;"><br/><input type="text" name="nom" value="" style="width: 90%; padding: 5px;" /></td>
              </tr>

              <tr valign="baseline">
                <td  style="width:20%;" align="right" valign="middle"><br/><b>T&eacute;l&eacute;phone</b></td>
                <td>&nbsp;</td>
                <td><br/><input type="text" name="phone" value="" style="width: 90%; padding: 5px;" /></td>
              </tr>

              <tr valign="baseline">
                <td  style="width:20%;" align="right" valign="middle"><br/><b>Aresse Email</b></td>
                <td>&nbsp;</td>
                <td><br/><input type="text" name="email" value="" style="width: 90%; padding: 5px;" /></td>
              </tr>

              <tr valign="baseline">
                <td style="width:20%;" align="right" valign="middle"><br/><b>Entreprise &nbsp;</b></td>
                <td>&nbsp;</td>
                <td><br/><input type="text" name="societe" value="" style="width: 90%; padding: 5px;" /></td>
              </tr>

              <tr valign="baseline">
                <td style="width:20%;" align="right" valign="middle"><br/><b>Titre de l'annonce &nbsp;</b></td>
                <td>&nbsp;</td>
                <td><br/><input type="text" name="titre" value="" style="width: 90%; padding: 5px;" /></td>
              </tr>

              <tr valign="baseline">
                <td style="width:20%;" align="right" valign="middle"><br/><b>contenu de l'Annonce</b></td>
                <td>&nbsp;</td>
                <td><br/><textarea name="contenu" rows="7" id="editor" style="width:70%;"></textarea></td>
              </tr>

              <tr valign="baseline">
                <td  style="width:20%;" align="right" valign="middle"><br/><b>Publier</b></td>
                <td>&nbsp;</td>
                <td><br/>
                  <select name="etat" style="padding: 5px; width: 90%;">
                    <option value="">--- S&eacute;lectionnez ---</option>
                  <option value="1">Publier</option>
                  <option value="0">Ne pas publier</option>
                  </select>
                </td>
              </tr>
              
              <tr valign="baseline">
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                   <br />
                  <input type="submit" name="btn" value="Valider" class="alt_btn"  />
                 </td>
              </tr>
            </table>
          <input type="hidden" name="MM_insert" value="form1" />
        </form>
        <div class="clear"></div>
    </div>
</article>
<script>
  CKEDITOR.replace( 'editor' );
</script>