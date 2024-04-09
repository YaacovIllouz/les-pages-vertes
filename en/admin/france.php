<?php
// connexion à la base de données
try {
    $bdd = new PDO('mysql:host=91.216.107.161;dbname=580653v5xdg', 'lespa580653', 'fJGGACgQ');
} catch(Exception $e) {
    exit('Impossible de se connecter à la base de données.');
}

if(isset($_POST['rub'])){
    $id = $_POST['rub'];
    $retour = '<select name="Id_sous_rubrique" id="Id_sous_rubrique" style="width: 300px;"><option value="">-- s&eacute;lectionnez --</option>';
    if($id){
        $sourub = $bdd->query("SELECT * FROM sous_rubrique WHERE Id_rubrique = ". $id ." ORDER BY rubrique ASC ")->fetchAll();
        if($sourub){
            foreach ($sourub as $v){
                $retour .= '<option value="'.$v['Id'].'">'.$v['rubrique'].'</option>';
            }
        }
    }
    $retour .= '</select>';
    echo $retour;
}



	if(isset($_GET['go']) || isset($_GET['id_region'])) {

		$json = array();

		if(isset($_GET['go'])) {
			// requête qui récupère les régions
			$requete = "SELECT Id, rubrique FROM rubrique ORDER BY rubrique ASC";
		} else if(isset($_GET['id_region'])) {
			$id = htmlentities(intval($_GET['id_region']));
			// requête qui récupère les départements selon la région
			$requete = "SELECT Id, rubrique FROM sous_rubrique WHERE Id_rubrique = ". $id ." ORDER BY rubrique ASC";
		}

		// exécution de la requête
		$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

		// résultats
		while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
			// je remplis un tableau et mettant l'id en index (que ce soit pour les régions ou les départements)
			$json[$donnees['Id']][] = utf8_encode($donnees['rubrique']);
		}

		// envoi du résultat au success
		echo json_encode($json);
	}
?>