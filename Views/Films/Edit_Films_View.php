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
	<form action="index.php?controller=Films&action=validateEdit&id=<?php echo $this->film->getId();?>"  method="POST">
		<label for="title">Titre :</label><br>
		<input type="text" name="title" value='<?php echo $this->film->getTitre(); ?>'><br>
	   
		<label for="year">Année :</label><br>
		<input type="text" name="year" value='<?php echo $this->film->getAnnee(); ?>'><br>
	   
		<label for="style">Style :</label><br>
		<input type="text" name="style" value='<?php echo $this->film->getStyle(); ?>'><br>
		
		<label for="lang">Langue :</label><br>
		<input type="text" name="lang" value='<?php echo $this->film->getLangue(); ?>'><br>

		<label for="desc">Description :</label><br>
		<textarea name="desc" cols="70" rows="7"><?php echo $this->film->getResume(); ?></textarea><br>
		
		<label for="real">Realisateur :</label><br>
		<input type="text" name="real" value='<?php echo($this->film->getRealisateur()->getPrenom(). " " .$this->film->getRealisateur()->getNom());?>'><br>
	   
		 <label for="real">Acteurs/Personnages :</label><br>			
		<ul>
			<?php 
				foreach($this->film->getPersonnages() as $role){
			?>
			<li>
				<input type="text" name="actor" value='<?php echo(utf8_encode($role->acteur->getPrenom()) . " " . utf8_encode($role->acteur->getNom())); ?>'>
				<input type="text" name="role" value='<?php echo utf8_encode($role->nom); ?>'><br>
			</li>
			<?php
				}
			?>
		</ul>
		<br>
		
	
	<footer>
			<input type="submit">	
	</footer>
	</form>
</article>
<?php		
			$content = ob_get_contents();
			ob_end_clean();	
			return $content;	
		}
		
	}
?>