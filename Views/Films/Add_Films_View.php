<?php
	class Add_Films_View extends Main_Global_View {
		private $directors = array();
		
		public function Add_Films_View($params) {
			$this->directors = $params["directors"];
			$filmscss = array("films.css");
			$this->setCSS($filmscss);
		}
		
		public function mainContent() {
			ob_start();
?>
<article class="film">
	<header>
		Ajouter un film
	</header> 
	 <form name="form_film" action="index.php?controller=Films&action=validateAdd" method="POST">
	
		<label for="title">Titre :</label><br>
		<input type="text" name="title" value=''><br>
	  
		<label for="year">Annee :</label><br>
		<input type="text" name="year" value=''><br>

		<label for="style">Style :</label><br>
		<input type="text" name="style" value=''><br>

		<label for="lang">Langue :</label><br>
		<input type="text" name="lang" value=''><br>

		<label for="desc">Description :</label><br>
		<textarea name="desc" cols="70" rows="7"></textarea><br>
		
		<label for="real">Selectionner un realisateur :</label><br>
		

		<?php 
			foreach($this->directors as $rea) {
			?>
			<li>	
				<?php
					$name = utf8_encode($rea->getPrenom()) . " " . utf8_encode($rea->getNom());
					$id = $rea->getId(); 
					 echo $name;
				?>
				<input type="radio" name="real" value='<?php echo $id;?>'><br>
							
			</li>
			<?php
				}
			?>


		<!--<div class='url_img' id='f1'>Url d'une image<input name='url[]' type='text'/></div>-->
		
		<br>
		Réalisateur
		Ajouter / Supprimer un acteur<br>
		
		<input type="submit">
	</form>
</article>
<?php		
			$content = ob_get_contents();
			ob_end_clean();	
			return $content;	
		}
	}
?>