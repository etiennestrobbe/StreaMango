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

   <section id="add_acteur" class="formulaire">
            <article class="formArticle">
                <header>
                    Ajouter un film
                </header>
                		

	<section class="informations">
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
		<br>
		<section class="filmographie">
		<label for="real">Affecter des acteurs :</label><br>

			
				<?php 
				if($this->actors) {
					foreach($this->actors as $actor) {
						if($actor->portraits){
							?>
							<div class="role">
								
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
						<div class="role">
							<img src="./img/personneDefaut.png"/>
										<div id="hiddenRole<?php echo $actor->getId()?>">
											<p>Role :<input type="text" name="role<?php echo $actor->getId();?>"></p>
										</div>
						</div>
							<?php
						}
					}
				}
                    ?>		
			</section>
		 </article>
		<!--<div class='url_img' id='f1'>Url d'une image<input name='url[]' type='text'/></div>-->
		<input type="submit">
	</form>
	</section>
	</section>
</article>
<?php		
			$content = ob_get_contents();
			ob_end_clean();	
			return $content;	
		}
	}
?>