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
<article class="one">
	<header>
		Ajouter un film
	</header> 
	 <form name="form_film" action="index.php?controller=Films&action=validateAdd" method="POST">
	
		<div class="infos">
			<label for="title">Titre :</label><input type="text" name="title" value=''>
		  
			<label for="year">Annee :</label>
			<input type="text" name="year" value=''>

			<label for="style">Style :</label>
			<input type="text" name="style" value=''>

			<label for="lang">Langue :</label>
		<input type="text" name="lang" value=''>
		</div>
		
		<div class="description">
			<label for="desc">Description :</label>
			<textarea name="desc" rows="7"></textarea>
		</div>
		
		<div class="realisateur">
			<label for="real">Selectionner un realisateur :</label>
			

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
		</div>
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