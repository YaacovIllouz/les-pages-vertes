<?php
abstract class gestionDate
{
	public static function formatDate($timestamp,$lang)
	{
		$jour_fr = Array("Dim","Lun","Mar","Mer","Jeu","Ven","Sam");
		$mois_fr = Array("Jan","Fev","Mar","Avr","Mai","Juin","Juil","Ao�t","Sep","Oct","Nov","Dec");

		$jour_en = Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
		$mois_en = Array("Jan","Feb","Mar","Apr","may","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

		$jour_mois = gmdate('j', $timestamp);
		$jour_semaine = gmdate('w', $timestamp);
		$mois_chiffre = gmdate('n', $timestamp);
		$mois_chiffre--;
		$annee = gmdate('Y', $timestamp);

		$heure = gmdate('H', $timestamp);
		$minute = gmdate('i', $timestamp);

		if($lang == 'fr')
		{
			$jour_lettre = $jour_fr[$jour_semaine];
			$mois_lettre = $mois_fr[$mois_chiffre];
		}
		if($lang == 'en')
		{
			$jour_lettre = $jour_en[$jour_semaine];
			$mois_lettre = $mois_en[$mois_chiffre];
		}

		return $jour_lettre.' '.$jour_mois.' '.$mois_lettre.' '.$annee.', '.$heure.':'.$minute;
	}

	public static function detailsDate($timestamp)
	{
		$jour_mois = gmdate('j', $timestamp);
		$mois_chiffre = gmdate('n', $timestamp);
		$annee = gmdate('Y', $timestamp);

		$heure = gmdate('H', $timestamp);
		$minute = gmdate('i', $timestamp);

		$infos = array('mois'=>$mois_chiffre,'jour'=>$jour_mois,'annee'=>$annee,'heure'=>$heure,'minute'=>$minute);
	}

	public static function formatCourt($timestamp,$lang)
	{
		$jour_mois = gmdate('j', $timestamp);
		$mois_chiffre = gmdate('n', $timestamp);
		$annee = gmdate('Y', $timestamp);

		if($lang == 'en'){return $mois_chiffre.'/'.$jour_mois.'/'.$annee;}
		elseif($lang == 'fr'){return $jour_mois.'/'.$mois_chiffre.'/'.$annee;}
	}

	public static function heure($timestamp)
	{
		$heure = gmdate('H', $timestamp);
		return $heure;
	}

	public static function minutes($timestamp)
	{
		$minute = gmdate('i', $timestamp);
		return $minute;
	}

  function __destruct(){}
}
//echo gestionDate::formatDate($timestamp,'fr');
?>