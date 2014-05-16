<?php
	class Edit_Films_View extends Main_Global_View {
		private $film;
		
		public function Edit_Films_View($params) {
			$filmscss = array("films.css");
			$this->setCSS($filmscss);
			$this->film = $params;
		}
		
		public function mainContent() {
			ob_start();
?>
<article class="film">
	<header>
		Modifier le film 
		<?php echo $this->film->getTitre(); ?>
	</header> 
	Title :
	<input type="title" name="title"><br>
	<footer>
		<input type="submit">
	</footer>
</article>
<?php		
			$content = ob_get_contents();
			ob_end_clean();	
			return $content;	
		}
	}
?>