<?php

function sans_accent($chaine) 
{ 
   $accent  ="ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ‗אבגדהוזחטיךכלםמןנסעףפץצרשתû‎‎‏ÿ"; 
   $noaccent="aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby"; 
   return strtr(trim($chaine),$accent,$noaccent); 
}

function nettoyage($valeur)
{
	if(!get_magic_quotes_gpc())
	{
		//return mysql_real_escape_string(htmlentities(sans_accent(utf8_decode($valeur))));
	}
	else
	{
		return htmlentities(sans_accent(utf8_decode($valeur)));
	}
}
?>