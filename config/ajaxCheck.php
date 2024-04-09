<?php
include_once('main_include.inc');

//liste liee pays - ville
if(isset($_POST['id_rubrique']) && !empty($_POST['id_rubrique'])){
    $id_pays = (int) $_POST['id_rubrique'];
    $retour ="";
    $result = $db->query("SELECT * FROM t_sous_rubrique WHERE id_rubrique=".$id_pays." ORDER BY libelle_sous_rub DESC")->fetchAll();    
    if($result){
        $retour .= "<select name='id_sous_rub' id='id_sous_rub' class='form-control'><option value=''> Veulliez S&eacute;lectionner</option>";
        foreach($result as $v){
            $retour .= "<option value='".$v['id_sous_rub']."'>".minToMajSansAccent(html_entity_decode($v['libelle_sous_rub']))."</option>";
        }
        $retour .="</select>";  
    }
    echo $retour;
}

//ajout de langue
if(isset($_POST['langue']) && !empty($_POST['langue']) && isset($_POST['niveau']) && !empty($_POST['niveau'])){
    //si on recoit les du formulaire
    $langue = strtoupper(trim(htmlspecialchars($_POST['langue'])));
    $niveau = trim(htmlspecialchars($_POST['niveau']));
    $myid = (int) trim($_POST['myid']);
    
    //on cherche si le cycle existe deja
    $res1 = $db->query("SELECT * FROM t_langue WHERE libelle_langue='".$langue."'")->fetch();
    if(!empty($res1)){
        //il existe un cycle de ce nom on renvoie une erreur serveur
        header('500, Erreur Interne',true,500);
    }else{
        //ce cycle n'existe pas donc on l'insÃ¨re
        $req2 = insertLangue($myid, $langue, $niveau);        
        
        if($req2){
            $i=1;
            //on compte le nbre de classe pour le cycle
            $langues = selectLangue($col='id_candidat', $val=$myid, $deb='',$limit='', $order='DESC');
            foreach ($langues as $v) {
                $id = $v['id_langue'];            
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $v['libelle_langue']; ?></td>
                <td><?php echo $v['niveau_langue']; ?></td>
                <td>
                    <a class="button red del-lang" href="./ajaxCheck.php?lang=<?php echo $id; ?>" 
                       onclick="event.preventDefault();
                        var stat = confirm('Voulez-vous vraiment supprimer cette langue?');
                        if(stat == true){
                            var $a=$(this);
                            var url= $a.attr('href');
        
                            $.ajax({
                                url : url,
                                success : function(){
                                    $a.parents('tr').fadeOut();
                                },
                                error : function(){
                                    alert('Vous ne pouvez pas supprimer cette langue !');
                                }
                            })
                        }"> Supprimer
                    </a>
                </td>                         
            </tr>
            <?php
            }
        }
    }
}

//suppression de langue
if(isset($_GET['lang']) && !empty($_GET['lang'])){
    $lang = (int) $_GET['lang'];
    $req = deleteLangue($lang);
    if($req){
        return "ok";
    }
}
