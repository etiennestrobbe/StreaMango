<?php

	class Header_Global_View {
		
		private $css;
		private $js;
		
		public function Header_Global_View($css, $js)
		{
			$this->css = $css;
			$this->js = $js;
		}
		
		public function getHeader() {
			ob_start();
?>
<!doctype html>
<html lang="fr">
	<head>
		<title>Cours POO-IHM : Biblioth&egrave;que de films</title>
		<meta charset="utf-8">
		
		<?php
			// Traitement des feuilles de styles à intégrer
			foreach($this->css as $cssFileName) {
		?>
				<link rel="stylesheet" type="text/css" href="./public/css/<?php echo $cssFileName; ?>">
		<?php
			}
		?>
		
		<?php
			// Traitement des scripts js à intégrer
			foreach($this->js as $jsFileName) {
		?>
				<script type="text/javascript" src="./public/js/<?php echo $jsFileName; ?>"></script>
		<?php
			}
		?>
		
	</head>
<body>
	<header>
		Cours POO-IHM : Biblioth&egrave;que de films
	</header>
	<div id="wrapper">
		<nav id="menu">
			<ul>
				<li><a href="./index.php">Accueil</a></li>
				<li><a href="./index.php?controller=Films&action=listAll">Films</a></li>
			</ul>
		</nav>
		<section id="main">
<?php			
			$head = ob_get_contents();
			ob_end_clean();
			
			return $head;
		}
		
	}
	
	
?>