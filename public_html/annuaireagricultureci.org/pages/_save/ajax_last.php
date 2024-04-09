<?php

include_once("../../config/main_include_en.inc");
require_once('../../_fonctions/fonctions.php');
include_once("../../_fonctions/url.inc.php");


	//sous rubrique

	if(isset($_POST['rubrique'])){

		$rub = (int) $_POST['rubrique'];

		$rs = $db->query("SELECT * FROM sous_rubrique WHERE Id_rubrique=".$rub)->fetchAll();

		if($rs){

			$retour = '<select name="sous_rub" class="form-control" required>

						<option value="">--- S&eacute;lectionnez une sous rubrique ---</option>';

			foreach ($rs as $r){

				$retour .= '<option value="'.$r['Id'].'">'.$r['rubrique'].'</option>';

			}

			$retour .= '</select>';

			echo $retour;

		}

	}



	//rechecher avec autocompletion

	if(isset($_GET['term']) && !empty($_GET['term'])) {

		//get search term

		$term = $_GET['term'];



		$rub = $db->query("SELECT * FROM sous_rubrique WHERE rubrique LIKE '".$term."%' ORDER BY rubrique ASC")->fetchAll();

        $ese = $db->query("SELECT DISTINCT sigle, entreprise FROM entreprise WHERE sigle LIKE '".$term."%' OR entreprise LIKE '%".$term."%' ORDER BY sigle ASC")->fetchAll();



        if($rub) {

			foreach ($rub as $v) {

				$data[] = trim($v['rubrique']);

			}

			//get matched data from skills table

			if($ese) {

				foreach ($ese as $v) {

					if (!empty($v['sigle'])&&(!empty($v['entreprise']))) {

						$data[] = trim($v['sigle']).':'.trim($v['entreprise']);

					} 
					
					else if (empty($v['sigle'])&&(!empty($v['entreprise']))) {

						$data[] = trim($v['entreprise']);

					} 					
					
					else  {

						$data[] = trim($v['sigle']);

					}

				}

			}

		}

		else{

            if($ese) {

				foreach ($ese as $v) {

					if (!empty($v['sigle'])&&(!empty($v['entreprise']))) {

						$data[] = trim($v['sigle']).':'.trim($v['entreprise']);

					} 
					
					else if (empty($v['sigle'])&&(!empty($v['entreprise']))) {

						$data[] = trim($v['entreprise']);

					} 					
					
					else  {

						$data[] = trim($v['sigle']);

					}

                }

            }

        }



		//return json data

		echo json_encode($data);

	}

	// Déconnexion de la BDD
	unset($db);	
?>