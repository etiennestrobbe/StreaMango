<?php
	class Index_Accueil_View extends Main_Global_View {
		
		public function Index_Accueil_View() {
		}
		
		public function mainContent() {
			ob_start();
?>

<article id="welcome">
	<header>Bienvenue dans ma biblioth&egrave;que de films!</header>

	<p>Les fonctionnalit&eacute;s minimales attendues : lister, afficher, cr&eacute;er, editer, supprimer pour les films et les stars (acteur/r&eacute;alisateur).</p>
</article>

<?php
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;	
		}
	}
?>