<?php
//transformation de chaine en caratere d'imprimerie sans accents
function minToMajSansAccent($chaine){
    if(isset($chaine) && !empty($chaine)){
        $chaine = htmlentities(trim($chaine), ENT_NOQUOTES, 'UTF-8');
        $chaine = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $chaine);
        $chaine = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $chaine); // pour les ligatures e.g. '&oelig;'
        $chaine = preg_replace('#&[^;]+;#', '', $chaine); // supprime les autres caract√®res
        $chaine_formatee = strtoupper($chaine);
        return $chaine_formatee;
    }
}
//Fonction pour le calcul du nombre de jour entre deux dates
function nombreJours($date1, $date2) {
    $arr_date1 = explode("-", $date1);
    $time_a_comparer1 = mktime(0, 0, 0, $arr_date1[1], $arr_date1[0], $arr_date1[2]);

    $arr_date2 = explode("-", $date2);
    $time_a_comparer2 = mktime(0, 0, 0, $arr_date2[1], $arr_date2[0], $arr_date2[2]);

    $difference = $time_a_comparer2 - $time_a_comparer1;
    $nbre_jour = intval($difference / 86400);
    return $nbre_jour;
}

function calculAge($date1, $date2) { 
    $arr_date1 = explode("-", $date1);
    $time_a_comparer1 = mktime(0, 0, 0, $arr_date1[1], $arr_date1[0], $arr_date1[2]);

    $arr_date2 = explode("-", $date2);
    $time_a_comparer2 = mktime(0, 0, 0, $arr_date2[1], $arr_date2[0], $arr_date2[2]);

    $difference = $time_a_comparer2 - $time_a_comparer1;
    $nbre_jour = 1 + intval($difference / 86400);	//86400
    $age = intval($nbre_jour / 365);
    return $age;
}

//Fonction conversion de la date format anglais (AAAA-MM-JJ) au format francais(JJ-MM-AAAA)
function reverseDateFr($date){
    $annee = substr($date, 0, 4); 
    $mois = substr($date, 5, 2); 
    $jour = substr($date, 8, 2);  
    $date = $jour . '-' . $mois . '-' . $annee; 
    return $date;
}

//Fonction conversion de la date format francais(JJ-MM-AAAA) au format anglais (AAAA-MM-JJ)
function reverseDateEn($date){
    $annee = substr($date, 6, 4); 
    $mois = substr($date, 3, 2); 
    $jour = substr($date, 0, 2);  
    $date = $annee . '-' . $mois . '-' . $jour; 
    return $date;
}

//Fonction conversion de la date format francais(JJ-MM-AAAA) au format anglais (JJ Mois AAAA)	
function reverseDateEntiere($date){
       $annee = substr($date, 0, 4); 
       $mois = substr($date, 5, 2); 
       $jour = substr($date, 8, 2); 

       switch($mois){
            case '01': $mois='Janvier'; break;
            case '02': $mois='F&eacute;vrier'; break;
            case '03': $mois='Mars'; break;
            case '04': $mois='Avril'; break;
            case '05': $mois='Mai'; break;
            case '06': $mois='Juin'; break;
            case '07': $mois='Juillet'; break;
            case '08': $mois='Ao&ucirc;t'; break;
            case '09': $mois='Septembre'; break;		
            case '10': $mois='Octobre'; break;
            case '11': $mois='Novembre'; break;
            case '12': $mois='D&eacute;cembre'; break;
            default: $mois=''; break; 
       } 
       $date = $jour.' '.$mois.' '.$annee; 
       return $date;
}

//Fonction conversion du num√©ro mois (01) en libell√© mois (janvier)
	function libelleMois($date){
		$annee = substr($date, 0, 4); 
		$mois = substr($date, 5, 2); 
		$jour = substr($date, 8, 2); 
		switch($mois){
			case '01': $mois='Janvier'; break;
			case '02': $mois='F&eacute;vrier'; break;
			case '03': $mois='Mars'; break;
			case '04': $mois='Avril'; break;
			case '05': $mois='Mai'; break;
			case '06': $mois='Juin'; break;
			case '07': $mois='Juillet'; break;
			case '08': $mois='Ao&ucirc;t'; break;
			case '09': $mois='Septembre'; break;
			case '10': $mois='Octobre'; break;
			case '11': $mois='Novembre'; break;
			case '12': $mois='D&eacute;cembre'; break;
		} 
		$libelleMois = $mois; 
		return $libelleMois;
	}

//Fonction conversion du num√©ro mois (01) en libell√© mois (janvier)
	function libelleDate($date){
		$annee = substr($date, 3, 4); 
		$mois = substr($date, 0, 2); 
		switch($mois){
			case '01': $mois='Janvier'; break;
			case '02': $mois='F&eacute;vrier'; break;
			case '03': $mois='Mars'; break;
			case '04': $mois='Avril'; break;
			case '05': $mois='Mai'; break;
			case '06': $mois='Juin'; break;
			case '07': $mois='Juillet'; break;
			case '08': $mois='Ao&ucirc;t'; break;
			case '09': $mois='Septembre'; break;
			case '10': $mois='Octobre'; break;
			case '11': $mois='Novembre'; break;
			case '12': $mois='D&eacute;cembre'; break;
		} 
		$lib_date = $mois.' '.$annee; 
		return $lib_date;
	}
        
// Email address verification
function isEmail($email) { 
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));		
}

//fonction d'envoi de mail
function envoiMail($email_src='', $email_dest='', $sujet='', $corps=''){
  /* D'autres en-t√™tes : errors, From cc's, bcc's, etc */
    $headers  = "From: ".$email_src."\n";
    $headers .= "X-Sender: <".$email_src.">\n";
    $headers .= "X-Mailer: PHP\n"; //Maileur
    $headers .= "X-Priority: 1\n"; //Message urgent!
    $headers .= "Return-Path: <".$email_src.">\n";  //Re-chemin de retour pour les erreurs
    $headers .= "Content-Type: text/html; charset=UTF-8\n"; //Type MIME
    //$headers .= "Cc:\n"; //Champs CC
    $headers .= "Bcc:".$email_src.""; //Champs BCCs
  
  //verifie si le destinataire est correct
  if(isEmail($email_dest)){
      $envoi = mail($email_dest, $sujet, $corps, $headers);	
  }
  return $envoi;
}

//=================================//	
//Image functions
//=================================//
//You do not need to alter these functions
function resizeImage($image, $width, $height, $scale) {
        $ext = strtolower(substr(strrchr($image, '.'), 1));
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);

        if($ext == 'jpg' or $ext == 'jpeg'){
        $source = imagecreatefromjpeg($image);
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);
        imagejpeg($newImage,$image,90);
        }
        if($ext == 'png'){
        $source = imagecreatefrompng($image);
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);
        imagepng($newImage,$image,9);
        }
        if($ext == 'gif'){
        $source = imagecreatefromgif($image);
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);
        imagegif($newImage,$image,90);
        }
        chmod($image, 0777);
        return $image;
}
//You do not need to alter these functions
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        $source = imagecreatefromjpeg($image);
        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
        imagejpeg($newImage,$thumb_image_name,90);
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
}

//You do not need to alter these functions
function getHeight($image) {
        $sizes = getimagesize($image);
        $height = $sizes[1];
        return $height;
}

//You do not need to alter these functions
function getWidth($image) {
        $sizes = getimagesize($image);
        $width = $sizes[0];
        return $width;
}

//upload image
function uploadImage($tmp, $target, $file_name){

	//DEFINITION DES VARIABLES LIEES AU FICHIER 
	$extension=   array('png','PNG', 'jpg', 'JPG', 'JPEG', 'jpeg', 'gif', 'GIF');	//Extension du fichier
	$taille_max = 15005000000; //Taille maximale du fichier		
	$ext = '.'.substr(strrchr($file_name, '.'), 1);
	$erreur = "";
	//v√©rifications de l'extensions du fichier
	if(file_exists($tmp) && !in_array(substr(strrchr($file_name, '.'), 1), $extension)){
		$erreur .= '<font color="red">Veillez s&eacute;lectionner un fichier de type <b>"PNG", "JPG", "GIF"</b> !!!</font>';
	}else{
		$erreur .= "";
	}
	//v√©rifications de la taille de la photo
	if(file_exists($tmp) && filesize($tmp) > $taille_max){
		$erreur .= '<font color="red">Votre fichier doit faire moins de 20 Mo !</font>';
	}else{
		$erreur .= "";
	}
	//copie du fichier joint si aucune erreur
	if($erreur == "" && !empty($file_name)){
		move_uploaded_file($tmp, $target.$file_name);
		chmod($target.$file_name, 0755);
		$max_width = "640";	// Max width allowed for the large image
		$width = getWidth($target.$file_name);
		$height = getHeight($target.$file_name);
		
		//Scale the image if it is greater than the width set above
		if ($width > $max_width){
			$scale = $max_width/$width;
			$uploaded = resizeImage($target.$file_name, $width, $height, $scale);
		}else{
			$scale = 1;
			$uploaded = resizeImage($target.$file_name, $width, $height, $scale);
			$upload1  = resizeImage($target.$file_name, $width, $height, $scale);
		}
	}
}

//upload Fichier
function uploadFichier($tmp, $target, $file_name){

	//DEFINITION DES VARIABLES LIEES AU FICHIER 
	$extension=   array('doc','docx', 'pdf', 'xls', 'ppt');	//Extension du fichier
	$taille_max = 15005000000; //Taille maximale du fichier		
	$ext = '.'.strtolower(substr(strrchr($file_name, '.'), 1));
	$erreur = "";
	//v√©rifications de l'extensions du fichier
	if(file_exists($tmp) and !in_array(substr(strrchr($file_name, '.'), 1), $extension)){
		$erreur .= '<font color="red">Veillez s&eacute;lectionner un fichier de type <b>"DOC", "PDF", "PPT", "XLS"</b> !!</font>';
	}else{
		$erreur .= "";
	}
	//v√©rifications de la taille de la photo
	if(file_exists($tmp) && filesize($tmp) > $taille_max){
		$erreur .= '<font color="red">Votre fichier doit faire moins de 20 Mo !</font>';
	}else{
		$erreur .= "";
	}
	//copie du fichier joint si aucune erreur
	if($erreur == "" && !empty($file_name)){
		move_uploaded_file($tmp, $target.$file_name);
		chmod($target.$file_name, 0755);
	}
}
////////////////////////////////////////////////////////////////////////////////
//execution requete sur la base donne
////////////////////////////////////////////////////////////////////////////////


/* +=======================================================================+ */
// FONCTION INSERT, DELETE, SELECT ET UPDATE SUR LA TABLE "USER"			//
/* +=====================================================================+ */

//fonction pour l'ordre INSERT
function insertUser($id, $nom, $login, $passe, $statut, $type){
global $db;
    //requete sql
    $query = "INSERT INTO t_user (id_user, nom, login, pass, statut, type) ";
    $query.= " VALUES('', '".$nom."', '".$login."', '".$passe."', '".$statut."', '".$type."')";
    //Execution de la requete	 
    $res = $db->query($query);
    if (!$res){
        $result = false;        
    }
    else{ 
        $result = true;        
    }
    return $result;
}	  	 
	 
//fonction pour l'ordre UPDATE
function updateUser($id, $nom, $login, $passe, $statut, $type){
    global $db;
    //requete sql
    $query = "UPDATE t_user SET `nom`='".$nom."', `type`='".$type."',`login`='".$login."', ";
    $query.= " `passe`='".$passe."', `statut`='".$statut."' WHERE id_user = '".$id."'";
    //Execution de la requete	 
    $res = $db->query($query);
    if (!$res){ 
        $result = false;        
    }
    else{ 
        $result = true;     
    }
    return $result;
}
	 
//fonction pour l'ordre SELECT
function selectUser($col='', $val='', $deb='',$limit='', $order='DESC'){
    global $db;
    //requete sql
    $query = "SELECT * FROM t_user ";
    if($col!=''){
        $query.= " WHERE ".$col."='".$val."'";
    }
    if($order!=''){
        $query.= " ORDER BY id_user ".$order." ";
    }
    if($deb!='' && $limit!=''){
        $query.= " LIMIT ".$deb.", ".$limit." ";
    }
    //Execution de la requete	 
    $result = $db->query($query)->fetchAll();
    return $result;
}	 

//fonction pour l'ordre DELETE
function deleteUser($id=''){
    global $db;
    //requete sql
    if($id!=''){
    $query = "DELETE FROM t_user WHERE id_user = '".$id."' LIMIT 1";
    }
    //Execution de la requete	 
    $res = $db->query($query);
    if(!$res){
        $result = false;        
    }
    else{
        $result = true;    
    }
    return $result;
}

//====================//
//article
//===================//

//fonction pour l'ordre INSERT "Article"
function insertArticle($id, $type, $titre, $resume, $contenu, $photo, $date_reg){ 
    global $db;
    //requete sql
    $query="INSERT INTO t_article (id_article, type, titre, resume, contenu, image, date_ajout ) VALUES(";
    $query.= "'', '".$type."', '".$titre."', '".$resume."', '".$contenu."', '".$photo."', '".$date_reg."')";
    //Execution de la requete	 
    $res = $db->query($query);
    if (!$res){
        $result = false;
    }
    else{ 
        $result = true;
    }
    return $result;
}

//fonction pour l'ordre UPDATE "article"
function updateArticle($id, $type, $titre, $resume, $contenu){ 
    global $db;
    //requete sql
    $query = "UPDATE t_article SET `titre`='".$titre."', `resume`='".$resume."', `contenu`='".$contenu."', `type`='".$type."' ";
    $query.= " WHERE id_article='".$id."' ";
    //Execution de la requete	 
    $res = $db->query($query);
    if (!$res){
        $result = false;
    }
    else{ 
        $result = true;
    }
    return $result;
}

//fonction pour l'ordre SELECT "article"
function selectArticle($col='', $val='', $deb='', $limit='', $order='DESC'){
    global $db;
    //requete sql
    $query = "SELECT * FROM t_article ";
    if($col!=''){
        $query.= " WHERE ".$col." = '".$val."' ";
    }
    if($order!=''){
        $query.= " ORDER BY id_article ".$order." ";
    }
    if($deb!='' && $limit!=''){
        $query.= " LIMIT ".$deb.", ".$limit." ";
    }
    //Execution de la requete	 
    $result = $db->query($query)->fetchAll();
    return $result;
}
	
//fonction pour l'ordre DELETE "Article"
function deleteArticle($id=''){	
    global $db;
    //requete sql
    if($id!=''){
        $query = "DELETE FROM t_article WHERE id_article='".$id."' LIMIT 1";
    }
    //Execution de la requete	 
    $res = $db->query($query);
    if (!$res){
        $result = false;
    }
    else{ 
        $result = true;
    }
    return $result;
}

//====================//
//Entreprise
//===================//

//fonction pour l'ordre INSERT "Article"
function insertEntreprise($id, $rubrique, $nom, $email, $sujet, $question, $date_reg){ 
    global $db;
    //requete sql
    $query="INSERT INTO t_faq (id_faq, id_rubrique, nom_prenom, email, sujet, question, date_reg ) VALUES(";
    $query.= "'', '".$rubrique."', '".$nom."', '".$email."', '".$sujet."', '".$question."', '".$date_reg."')";
    //Execution de la requete	 
    $res = $db->query($query);
    if(!$res){
        $result = false;
    }
    else{ 
        $result = true;
    }
    return $result;
}

//fonction pour l'ordre UPDATE "article"
function updateEntreprise($id, $user, $reponse, $date){ 
    global $db;
    //requete sql
    $query = "UPDATE t_faq SET id_user='".$user."', reponse='".$reponse."', `date_reponse`='".$date."'";
    $query.= " WHERE id_faq='".$id."' ";
    //Execution de la requete	 
    $res = $db->query($query);
    if (!$res){
        $result = false;
    }
    else{ 
        $result = true;
    }
    return $result;
}

//fonction pour l'ordre SELECT "article"
function getEntreprise($col='', $val='', $deb='', $limit='', $order='DESC'){
    global $db;
    //requete sql
    $query = "SELECT * FROM t_entreprise E, t_sous_rubrique R WHERE E.id_sous_rub=R.id_sous_rub ";
    if(!empty($col) && !empty($val)){
        $query.= " AND ".$col." = '".$val."' ";
    }
    if(!empty($order)){
        $query.= " ORDER BY id_entreprise ".$order." ";
    }
    if($deb>=0 && $limit>0){
        $query.= " LIMIT ".$deb.", ".$limit." ";
    }
    //Execution de la requete	 
    $result = $db->query($query)->fetchAll();
    return $result;
}
	
//fonction pour l'ordre DELETE
function deleteEntreprise($id){	
    global $db;
    //requete sql
    if($id>0){
        $query = "DELETE FROM t_entreprise WHERE id_entreprise='".$id."' LIMIT 1";
        if($query){
            //Execution de la requete	 
            $res = $db->query($query);
            if(!$res){
                $result = false;
            }
            else{ 
                $result = true;
            }
            return $result;
        }
    }    
}

function sans_accent($chaine) { 
   $accent  ="¿¡¬√ƒ≈∆«»… ÀÃÕŒœ–—“”‘’÷ÿŸ⁄€‹›ﬁﬂ‡·‚„‰ÂÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ¯˘˙˚˝˝˛ˇ"; 
   $noaccent="aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby"; 
   return strtr(trim($chaine),$accent,$noaccent); 
}

function nettoyage($valeur){
    if(!get_magic_quotes_gpc()){
        return (htmlentities(sans_accent(utf8_decode($valeur))));
    }
    else{
        return htmlentities(sans_accent(utf8_decode($valeur)));
    }
}

