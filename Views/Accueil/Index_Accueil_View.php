<?php
	class Index_Accueil_View extends Main_Global_View {
		
		public function Index_Accueil_View() {
		}
		
		public function mainContent() {
			ob_start();
?>

<article id="welcome" class="one">
	<header>Bienvenue dans notre biblioth&egrave;que de films!</header>

	Vous serez ici chez vous, et nous mangerons des BADLONEEEEES !
	</article>

<?php
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;	
		}
	}
?>