<?php


class uploadImage
{
	private $UploadError;

    // Taille maximum exprim�e en kilo-octets pour l'upload d'un fichier.
    private $MaxFilesize;

    // Largeur maximum d'une image exprim�e en pixel.
    private $ImgMaxWidth;

    // Hauteur maximum d'une image exprim�e en pixel.
    private $ImgMaxHeight;

    // Largeur minimum d'une image exprim�e en pixel.
    private $ImgMinWidth;

    // Hauteur minimum d'une image exprim�e en pixel.
    private $ImgMinHeight;

    // R�pertoire de destination dans lequel vont �tre charg� les fichiers.
	private $DirUpload;

    // Politique de s�curit� max : ignore tous les fichiers ex�cutables / interpr�table.
    private $SecurityMax;

    // Permet de pr�ciser un nom pour le fichier � uploader. Peut s'utiliser conjointement avec les propri�t�s $Suffixe / $Prefixe
    private $Filename;

    // Pr�fixe pour un nom de fichier
    private $Prefixe;

    // Suffixe pour un nom de fichier
    private $Suffixe;

    // Chaine de caract�res repr�sentant les ent�tes de fichiers autoris�s (mime-type).
    private $MimeType;

    // D�finit si les erreurs de configuration de la classe doivent �tre affich�es en sortie �cran et doivent stopper le script courant.
    private $TrackError;

	private $Extension = '';

	private $ArrOfError = array();

	/******************** Fichier transtf�r� ***********************/

	private $tmp_file_size	= 0;
	private $tmp_file_type	= '';
	private $original_file_name	= '';
	private $tmp_file_ext	= '';
	private $tmp_file		= '';

	function __construct($MaxFilesize,$ImgMaxHeight,$ImgMaxWidth,$ImgMinHeight,$ImgMinWidth,$DirUpload)
	{
        $this-> MaxFilesize = $MaxFilesize * 1024;	//(Ko)
        $this->ImgMaxHeight = $ImgMaxHeight;
        $this->ImgMaxWidth	= $ImgMaxWidth;
        $this->ImgMinHeight	= $ImgMinHeight;
        $this->ImgMinWidth	= $ImgMinWidth;
        $this->DirUpload    = $DirUpload;
		$this->Extension    = '';
        $this->MimeType     = '';
		$this->Filename     = '';
        $this->SecurityMax  = true;
        $this->TrackError	= true;
        $this->UploadError	= false;
	}

	function CheckUpload()
	{
		// R�cup des propri�t�s
		$this->tmp_file		  = $_FILES['userfile']['tmp_name']; // emplacement temporaire
        $this->tmp_file_size  = $_FILES['userfile']['size'];     // poids du fichier
		$this->original_file_name  = $_FILES['userfile']['name'];     // nom du fichier
		$this->tmp_file_ext   = strtolower(substr($this->original_file_name, strrpos($this->original_file_name, '.'))); // extension du fichier

		$size = getimagesize($this->tmp_file);
		$this->tmp_file_type  = $size['mime'];     // type mime

        // On ex�cute les v�rifications demand�es
		if (is_uploaded_file($this->tmp_file))
		{
			$fp		 = fopen($this->tmp_file, 'r');
		    $content = fread($fp, $this->tmp_file_size);
		    $content = addslashes($content);
		    fclose($fp);

			$this-> CheckSecurity();
			$this-> CheckMimeType();
			$this-> CheckExtension();
            $this-> CheckImg();
		}
		else
		{
			$this->UploadError = true;
			$this-> AddError($_FILES['userfile']['error']); // Le fichier n'a pas �t� upload�, on r�cup�re l'erreur
		}

        // Si le fichier a pass� toutes les v�rifications, on proc�de � l'upload, sinon on positionne la variable globale UploadError � 'true'
        if ($this->UploadError){return false;}else{return true;}
	}

    // Ecrit le fichier sur le serveur.
	function WriteFile()
	{
		//$name = $this->original_file_name;
		$name = substr(sha1(mt_rand()), 0, 8).$this->tmp_file_ext;
		$type = $this->tmp_file_type;
		$temp = $this->tmp_file;
		$size = $this->tmp_file_size;
		$ext  = $this->tmp_file_ext;

        if (is_uploaded_file($temp))
        {
            // Si le fichier existe, on �crase
            $uploaded = move_uploaded_file($temp, $this-> DirUpload.$name);

            // Informations pouvant �tre utiles au d�veloppeur (si le fichier a pu �tre copi�)
            if ($uploaded != false)
            {
                $this-> Infos['nom']          = $name;
                $this-> Infos['chemin']       = $this-> DirUpload.$name;
                //$this-> Infos['poids']        = number_format(filesize($this-> DirUpload.$name)/1024, 3, '.', '');
                //$this-> Infos['mime-type']    = $type;
                //$this-> Infos['extension']    = $ext;
            	return true;
            }
        }// End is_uploaded_file

        return false;
	} // End function

	// V�rifie si le fichier pass� en param�tre existe d�j� dans le r�pertoire DirUpload
	function AlreadyExist($file)
	{
		if (file_exists($this-> DirUpload.$file) and is_file($this-> DirUpload.$file)){return true;}else{return false;}
	}

	// V�rifie la hauteur/largeur d'une image
	function CheckImg()
	{
        // V�rification de la largeur puis de la hauteur
        if ($taille = @getimagesize($this->tmp_file))
        {
	        if (!Empty($this->ImgMaxWidth)  && $taille[0] > $this-> ImgMaxWidth){$this-> AddError(8);}
	        if (!Empty($this->ImgMaxHeight) && $taille[1] > $this-> ImgMaxHeight){$this-> AddError(9);}
            if (!Empty($this->ImgMinWidth)  && $taille[0] < $this-> ImgMinWidth){$this-> AddError(10);}
            if (!Empty($this->ImgMinHeight) && $taille[1] < $this-> ImgMinHeight){$this-> AddError(11);}
        }

        return true;
	}

	// V�rifie l'extension des fichiers suivant celles pr�cis�es dans $Extension
	function CheckExtension()
	{
        $ArrOfExtension = explode(';', strtolower($this->Extension));

		if (!Empty($this-> Extension) && !in_array($this->tmp_file_ext, $ArrOfExtension))
		{
            $this-> AddError(7);
            return false;
		}

		return true;
	}

	// V�rifie l'ent�te des fichiers suivant ceux pr�cis�s dans $MimeType
	function CheckMimeType()
	{
        $ArrOfMimeType = explode(';', $this->MimeType);

        if (!isset($this->MimeType) or !$this->MimeIsCorrect())// or !in_array($this->tmp_file_type, $ArrOfMimeType))
        {
            $this-> AddError(6);
			return false;
		}

		return true;
	}

	function MimeIsCorrect()
	{
		if($this->tmp_file_type == 'image/jpeg' and ($this->tmp_file_ext == '.jpg' or $this->tmp_file_ext == '.jpeg')
        //or $this->tmp_file_type == 'image/bmp' and $this->tmp_file_ext == '.bmp'
        or $this->tmp_file_type == 'image/png' and $this->tmp_file_ext == '.png'
        or $this->tmp_file_type == 'image/gif' and $this->tmp_file_ext == '.gif')
        {return true;}else{return false;}
	}

    // Ajoute une erreur pour le fichier sp�cifi� dans le tableau des erreur
	function AddError($code_erreur)
	{
		$this->UploadError = true;
		switch ($code_erreur)
        {
            case 1 :
            case 2 : $msg = 'La taille de l\'image est supérieure à la taille max autorisée ('.number_format($this->MaxFilesize/1024, 2, '.', '').')';
                     break;

            case 3 : $msg = 'Fichier mi-chargé';
                     break;

            case 4 : $msg = 'Le formulaire est vide';
                     break;

            case 6 : $msg = 'Format incorrect';
                     break;

            case 7 : $msg = 'Fichiers autorisés *.jpg *.jpeg *.gif *.png';
                     break;

            case 8 : $msg = 'La largeur de l\'image est supérieure à la largeur max autorisée ['.$this->ImgMaxWidth.' pixels]';
                     break;

            case 9 : $msg = 'La hauteur de l\'image est supérieure à la hauteur max autorisée ['.$this->ImgMaxHeight.' pixels]';
                     break;

            case 10 : $msg = 'La hauteur de l\'image est inférieur à la hauteur min autorisée ['.$this->ImgMinHeight.' pixels]';
                      break;

            case 11 : $msg = 'La largeur de l\'image est inférieur à la largeur min autorisée ['.$this->ImgMinWidth.' pixels]';
                      break;
        }
		static $verif = array();
		if(!in_array($code_erreur,$verif))
		{
        	$this-> ArrOfError[] = $msg;
			$verif[] = $code_erreur;
		}
    }


	// V�rifie les crit�res de la politique de s�curit�
	function CheckSecurity()
	{
        // Bloque tous les fichiers executables, et tous les fichiers php pouvant �tre interpr�t� mais dont l'ent�te ne peut les identifier comme �tant dangereux
		if ($this-> SecurityMax===true)
		{
			// Note : is_executable ne fonctionne pas => ?
            if (ereg('application/octet-stream', $this->tmp_file_type) || preg_match("/.php$|.inc$|.php3$/i", $this->tmp_file_ext))
            {
                $this-> AddError(7);
				return false;
            }
		}

		return true;
	}

    function GetError(){return $this->ArrOfError;}

	// Retourne le tableau contenant les informations sur les fichiers upload�s
	function GetSummary(){return $this->Infos;}

	function SetExtension($extension){$this->Extension = $extension;}

	function SetMimeType($mimeType){$this->MimeType = $mimeType;}

    // Affiche les erreurs de configuration et stoppe tout traitement
	function Error($error_msg)
    {
        if ($this-> TrackError)
        {
            echo 'Erreur classe Upload : ' . $error_msg;
            exit;
        }
    }

    function __destruct(){}
}

class Image {
    
    var $file;
    var $image_width;
    var $image_height;
    var $width;
    var $height;
    var $ext;
    var $types = array('','gif','jpeg','png','swf');
    var $quality = 80;
    var $top = 0;
    var $left = 0;
    var $crop = false;
    var $type;
    
    function Image($name='') {
        $this->file = $name;
        $info = getimagesize($name);
        $this->image_width = $info[0];
        $this->image_height = $info[1];
        $this->type = $this->types[$info[2]];
        $info = pathinfo($name);
        $this->dir = $info['dirname'];
        $this->name = str_replace('.'.$info['extension'], '', $info['basename']);
        $this->ext = $info['extension'];
    }
    
    function dir($dir='') {
        if(!$dir) return $this->dir;
        $this->dir = $dir;
    }
    
    function name($name='') {
        if(!$name) return $this->name;
        $this->name = $name;
    }
    
    function width($width='') {
        $this->width = $width;
    }
    
    function height($height='') {
        $this->height = $height;
    }
    
    function resize($percentage=50) {
        if($this->crop) {
            $this->crop = false;
            $this->width = round($this->width*($percentage/100));
            $this->height = round($this->height*($percentage/100));
            $this->image_width = round($this->width/($percentage/100));
            $this->image_height = round($this->height/($percentage/100));
        } else {
            $this->width = round($this->image_width*($percentage/100));
            $this->height = round($this->image_height*($percentage/100));
        }
        
    }
    
    function crop($top=0, $left=0) {
        $this->crop = true;
        $this->top = $top;
        $this->left = $left;
    }
    
    function quality($quality=80) {
        $this->quality = $quality;
    }
    
    function show() {
        $this->save(true);
    }
    
    function save($show=false) {

        if($show) @header('Content-Type: image/'.$this->type);
        
        if(!$this->width && !$this->height) {
            $this->width = $this->image_width;
            $this->height = $this->image_height;
        } elseif (is_numeric($this->width) && empty($this->height)) {
            $this->height = round($this->width/($this->image_width/$this->image_height));
        } elseif (is_numeric($this->height) && empty($this->width)) {
            $this->width = round($this->height/($this->image_height/$this->image_width));
        } else {
            if($this->width<=$this->height) {
                $height = round($this->width/($this->image_width/$this->image_height));
                if($height!=$this->height) {
                    $percentage = ($this->image_height*100)/$height;
                    $this->image_height = round($this->height*($percentage/100));
                }
            } else {
                $width = round($this->height/($this->image_height/$this->image_width));
                if($width!=$this->width) {
                    $percentage = ($this->image_width*100)/$width;
                    $this->image_width = round($this->width*($percentage/100));
                }
            }
        }
        
        if($this->crop) {
            $this->image_width = $this->width;
            $this->image_height = $this->height;
        }

        if($this->type=='jpeg') $image = imagecreatefromjpeg($this->file);
        if($this->type=='png') $image = imagecreatefrompng($this->file);
        if($this->type=='gif') $image = imagecreatefromgif($this->file);
        
        $new_image = imagecreatetruecolor($this->width, $this->height);
        imagecopyresampled($new_image, $image, 0, 0, $this->top, $this->left, $this->width, $this->height, $this->image_width, $this->image_height);
        
        $name = $show ? null: $this->dir.DIRECTORY_SEPARATOR.$this->name.'.'.$this->ext;
        if($this->type=='jpeg') imagejpeg($new_image, $name, $this->quality);
        if($this->type=='png') imagepng($new_image, $name);
        if($this->type=='gif') imagegif($new_image, $name);
        
        imagedestroy($image); 
        imagedestroy($new_image);
        
    }
    
}
?> 