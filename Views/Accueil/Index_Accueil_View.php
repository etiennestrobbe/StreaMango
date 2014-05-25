<?php
	class Index_Accueil_View extends Main_Global_View {
		
		public function Index_Accueil_View() {
		}
		
		public function mainContent() {
			ob_start();
?>

<article id="welcome" class="one">
	<header>Bienvenue dans votre biblioth&egrave;que de films!</header>

	Ici, vous pouvez consulter, éditer, ajouter des films ainsi que des stars (acteurs ou réalisateurs).
	N'hésitez pas à vous créer un profil. Il vous permettra d'ajouter des amis ou encore de commenter et noter les films.
	
	</article>

<?php
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;	
		}
	}
?>