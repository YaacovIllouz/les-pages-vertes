<?php
include_once("../config/main_include.inc");

    $rub = $db->query("SELECT Id, rubrique FROM sous_rubrique ORDER BY rubrique ASC")->fetchAll();
    $ese = $db->query("SELECT ID_ese, sigle, entreprise FROM entreprise ORDER BY sigle ASC")->fetchAll();

    if($rub) {
        /*foreach ($rub as $v) {
          $data[]  = '{id:'.$v['rubrique'].', text:'.$v['rubrique'].', entity_id:'.$v['Id'].', data_type:category, score:1.188177},';
        }*/
//get matched data from skills table
        /*if($ese) {
            foreach ($ese as $v) {
                if (!empty($v['entreprise'])) {
                    $data[] = $v['sigle'].' : '.$v['entreprise'];
                } else {
                    $data[] = $v['sigle'];
                }
            }
        }*/
    }
    /*else{
        if($ese) {
            foreach ($ese as $v) {
                if (!empty($v['entreprise'])) {
                    $data[] = $v['sigle'].' : '.$v['entreprise'];
                } else {
                    $data[] = $v['sigle'];
                }
            }
        }
    }*/

//return json data
//echo json_encode($rub);
echo json_encode($ese);

?>