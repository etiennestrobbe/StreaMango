<?php

// ne pas oublier le // define("PATHTOROOT", "../");

/**
 * @author renevier-gonin
 * @package includes
 *
 * @abstract fonction pour l'interpréteur php pour charger les classes
 * utilise la constante PATHTOROOT (à définir par define("PATHTOROOT", "<...>");
 * cette constante indique le chemin relatif entre la page php (qui inclut autoload.inc) et la racine du site web
 */
function __autoload($class_name)
{
	if (@constant("PATHTOROOT")) $path = constant("PATHTOROOT");
	else
	{
		echo "VOUS N AVEZ PAS DEFINI PATHTOROOT :(par exemple define(\"PATHTOROOT\", \"../\"); ";
		die();
	}
	if (strrpos($path, "/") != (strlen($path)-1) ) $path .="/";

	if (strlen($class_name) > 5)
	{
		$rep = substr($class_name, 0, 5);
		// **** CAS Data_ ou Libs_
		if (($rep == "Data_") || ($rep == "Libs_"))
		{
			$rep = substr($rep, 0, 4);

			// include constant("RACINE")."$rep/$class_name.inc";
			include $path."metier/$rep/$class_name.inc";
		}
		else
		{
			$rep = substr($class_name, 0, 3);
			// **** CAS Nf_
			if ($rep =="Nf_")
			{
				$rep = substr($rep, 0, 2);
				include $path."metier/$rep/$class_name.inc";
			}
			else
			{

				// agent PAC ?

				$name = "";
				// facette Control ?
				$indice = strpos($class_name, "Control");
				if ($indice === 0)
				{
					include_once $path."agents/PAC/Control.inc";
					return;
				}
				else if ($indice)
				{
					$name = substr($class_name, 0, strlen($class_name)-7);
				}
				else
				{
					$indice = strpos($class_name, "Abstraction");
					if ($indice === 0)
					{
						include_once $path."agents/PAC/Abstraction.inc";
						return;
					}
					else if ($indice)
					{
						$name = substr($class_name, 0, strlen($class_name)-11);
					}
					else
					{
						$indice = strpos($class_name, "Presentation");
						if ($indice === 0)
						{
							include_once $path."agents/PAC/Presentation.inc";
							return;
						}
						else if ($indice)
						{
							$name = substr($class_name, 0, strlen($class_name)-12);
						}
						else
						{
							include_once $path."includes/{$class_name}.inc";
							return;
						}
					}
				}

				include_once $path."agents/{$name}/{$class_name}.inc";
			}
		}
	}
	else 
	{
		include_once $path."includes/{$class_name}.inc";
	}

}





session_name("renevier-gonin-film-tp03-05");
session_start();

?>
