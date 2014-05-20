<?php
	class ListAll_Films_View extends Main_Global_View {
		
		private $films = array();
		
		public function ListAll_Films_View($viewparams) {
			$filmscss = array("films.css");
			$this->setCSS($filmscss);
			
			$this->films = $viewparams["films"];
		}
		
		public function mainContent() {
			ob_start();
?>

<?php
	if(! $this->films) {
?>
<article>
Aucun film n'est pr&eacute;sent dans la base de donn&eacute;es.
</article>
<?php
	} else {
		
		foreach($this->films as $film) {
?>

<article class="film">
	<header>
		<a href="./index.php?controller=Films&action=show&id=<?php echo $film->getId(); ?>"><?php echo $film->getTitre(); ?></a>
	</header>
	
	<section>
		<?php
			if($film->affiches) {
				
		?>
		
				<img src="<?php echo $film->affiches[0]->getSrc(); ?>" />
		
		<?php
				
			}
		?>
	</section>
	
	<footer>
	</footer>
</article>


<?php
		}
	}
?>

<?php
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;	
		}
	}
?>