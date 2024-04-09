<?php

if(isset($_FILES['logo']))
{ 
     $dossier = '../../userfiles/image/';
	 
	 $fichier=$_FILES['logo']['name'];
			
			$element = pathinfo($fichier);//extrait le nom du fichier sans l'extension echo $element['filename'];
			
			//Elimination de tout espace ou - . ; : ' par _			
			$element = preg_replace("#[ -.;:'&\"]+#", "_", $element);
			
			//nom temporaire de l'image (sur le serveur)
			$tmp=$_FILES['logo']['tmp_name'];
			
			$extension=strrchr($fichier,'.');//extension de l'image
			$extension=substr($extension,1) ;//echo $type."--".$extension;
			//Le upload existe on rajoute dans son nom le timestamp du moment pour le différencier
			//de la première (comme cela on est sûr de ne pas avoir 2 images avec le même nom :) )
			$nomlogo = $element['filename'].'-'.date("Ymd_His").".".$extension;
	 	 
     if(move_uploaded_file($tmp,$dossier.$nomlogo)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
		 $ok1=1;
          //$msge2='Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          $ok1=0;
		  //$msge2='Echec de l\'upload !';
     }
}

?>