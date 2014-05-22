<?php
	class Add_Films_View extends Main_Global_View {
		private $directors = array();
		private $actors = array();
		
		public function Add_Films_View($params) {
			$this->directors = $params["directors"];
			$this->actors = $params["actors"];
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
	
<!--	
		<div id="films" class="filmographie">
				<?php /*
				if($this->actors) {
					foreach($this->actors as $actor) {
						if($actor->portraits){
							?>
							<div class="film">
								
								<input class="checkboxFilm" type="checkbox" name="check_list_acteur[]" value='<?php echo $actor->getId();?>' id='<?php echo $actor->getId()?>'>

										<img src="<?php echo $actor->portraits[0]->getSrc();?>"/>
										<div id="hiddenRole<?php echo $actor->getId()?>">
											<p>Role :<input type="text" name="role<?php echo $actor->getId();?>"></p>
										</div>
							</div>
						<?php
						}
						else{
						?>
						<div class="film">
							<img src="./img/personneDefaut.png"/>
										<div id="hiddenRole<?php echo $actor->getId()?>">
											<p>Role :<input type="text" name="role<?php echo $actor->getId();?>"></p>
										</div>
						</div>
							<?php
						}
					}
				}*/
                    ?>		
		</div>-->
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