<?php
/**
 * @author renevier-gonin
 * @package includes
 * 
 * @abstract pour définir (une seule fois) la connexion à la base de données.  
 */
/**
 * 
 * @var @ignore
 */
$test = @constant("CONNEXION");
if (! $test)
{
	define("CONNEXION", mysql_connect("localhost", "root", "root"));
	mysql_select_db("ihm2011-dev", constant("CONNEXION"));
}

?>