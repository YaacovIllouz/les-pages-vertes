<?php 
//info de l'entreprisse dont l'id est passer par le get
$ese = $db->query("SELECT E.*, R.*, S.rubrique AS sous_rub FROM entreprise E, rubrique R, sous_rubrique S 
                   WHERE E.Id_sous_rubrique=S.Id AND R.Id=S.Id_rubrique AND E.Id_ese =".$_GET['id'])->fetch();
				   
 if(($ese['entreprise']!="") && ($ese['sigle']!="")) {
			 $info_ese = $ese['sigle'].'('.$ese['entreprise'].')';
			 } 
			 else if(($ese['entreprise']!="") && ($ese['sigle']=="")) {
			 $info_ese = ($ese['entreprise']);
			 }else if(($ese['entreprise']=="") && ($ese['sigle']!="")) {
			 $info_ese = ($ese['sigle']);
			 }
			 
			 echo $info_ese.' - '.GetLibRub($ese['Id_sous_rubrique'])	;		   
?>