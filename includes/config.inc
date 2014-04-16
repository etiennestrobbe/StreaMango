<?php

class config {

//  const STYLE = "messtyles/styleNav.css";
 const STYLE = "messtyles/styleFleur.css";
 
 const HIDE_UNREACHABLELINK = false;
 
 const PAGE_PUBLIQUE = "toujours accessible";
 const PAGE_POUR_CONNECTE = "accessible si connecte";
 const PAGE_POUR_DECONNECTE = "accessible si deconnecte";

public static  $map = array(  
		array("index.php", "connexion"),
		array("index.php", "deconnexion"),
		array("Films.php", "Film(s)"),
		array("Stars.php", "Star(s)"),
		// array("Fubuki.php", "jouer à Fubuki"),
		array("Resultat.php", "voir une solution")
	);

public static  $publicAcces  = array (
		"connexion" => config::PAGE_POUR_DECONNECTE,
		"deconnexion" => config::PAGE_POUR_CONNECTE,
		"Film(s)" => config::PAGE_POUR_CONNECTE,
		"Star(s)" => config::PAGE_POUR_CONNECTE,
		// "jouer à Fubuki" => config::PAGE_PUBLIQUE,
		"voir une solution" => config::PAGE_POUR_CONNECTE
	);
}
?>