<?php

	include_once("../config/main_include.inc");



	//rechecher avec autocompletion

	if(isset($_GET['query']) && !empty($_GET['query'])){

		//get search term

		$searchTerm = $_GET['query'];

		$data = array();

		//get matched data from skills table

		$query = $db->query("SELECT DISTINCT Id_ese, sigle, entreprise FROM entreprise WHERE sigle LIKE '".$searchTerm."%' AND flag_ese=1 ORDER BY sigle ASC")->fetchAll();

		foreach($query as $v) {

			if(!empty($v['entreprise'])){

				$data['id'] = $v['Id_ese'];

				$data['label'] = $v['sigle'].' - '.$v['entreprise'];

			}

			else{

				$data['id'] = $v['Id_ese'];

				$data['label'] = $v['sigle'];

			}

		}



		//return json data

		echo json_encode($data);

	}

?>