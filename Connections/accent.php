<?php 
function sans_accent($chaine) 
{ 
   $accent  ="��������������������������������������������������������������"; 
   $noaccent="aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby"; 
   return strtr(trim($chaine),$accent,$noaccent); 
} 
?>