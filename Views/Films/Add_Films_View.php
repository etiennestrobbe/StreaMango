<?php
	class Add_Films_View extends Main_Global_View {
		
		public function Add_Films_View($params) {
			$filmscss = array("films.css");
			$this->setCSS($filmscss);
			$this->film = $params;
		}
		
		public function mainContent() {
			ob_start();
?>
<article class="film">
	<header>
		Ajouter un film
	</header> 
	<form action=""  method="POST">
	
		<label for="title">Titre :</label><br>
		<input type="text" name="title" value=''><br>
	  
		<label for="year">Année :</label><br>
		<input type="text" name="year" value=''><br>

		<label for="style">Style :</label><br>
		<input type="text" name="style" value=''><br>

		<label for="lang">Langue :</label><br>
		<input type="text" name="lang" value=''><br>

		<label for="desc">Description :</label><br>
		<textarea name="desc" cols="70" rows="7"></textarea><br>

		<br>
		Réalisateur
		Ajouter / Supprimer un acteur<br>
	</form>
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