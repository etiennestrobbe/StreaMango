<?php
	class Show_Films_View extends Main_Global_View {

		private $film;
		
		public function Show_Films_View($viewparams) {
			$filmscss = array("film.css");
			$this->setCSS($filmscss);
			
			$this->film = $viewparams["film"];
		}
		
		public function mainContent() {
			ob_start();
			if(! $this->film) {
?>

<article>
No film to show.
</article>

<?php
	} else {
?>

<article class="film">
	<header>
		<?php echo $this->film->getTitre(); ?>
	</header>
	
	<aside>
		<?php
			if($this->film->affiches) {
			
				foreach($this->film->affiches as $affiche) {
				
		?>
		
				<img src="<?php echo $affiche->getSrc(); ?>" />
		
		<?php
					
				}
				
			}
		?>
	</aside>
</article>

<?php
			}
			// TODO (Marc)
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;	
		}
	}
?>