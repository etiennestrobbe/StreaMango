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
	<form>
	<table>
   <tr>
       <td><label for="title">Titre :</label></td>
       <td><input type="text" name="title" value='<?php echo $this->film->getTitre(); ?>'></td>
   </tr>
   <tr>
       <td><label for="year">Année :</label></td>
       <td><input type="text" name="year" value='<?php echo $this->film->getAnnee(); ?>'></td>
   </tr>
     <tr>
       <td><label for="style">Style :</label></td>
       <td><input type="text" name="style" value='<?php echo $this->film->getStyle(); ?>'></td>
   </tr>
   <tr>
       <td><label for="lang">Langue :</label></td>
       <td><input type="text" name="lang" value='<?php echo $this->film->getLangue(); ?>'></td>
   </tr>
     <tr>
       <td><label for="desc">Description :</label></td>
       <td><textarea name="desc" cols="70" rows="7"><?php echo $this->film->getResume(); ?></textarea></td>
   </tr>
</table>
	<br>
	Ajouter / Supprimer un acteur<br>
	Réalisateur
	</form>
	<footer>
		<input type="submit">
		
		<?php
			/*$title = $_POST['title'];
			$year = $_POST['year'];
			$style = $_POST['style'];
			$lang = $_POST['lang'];
			$desc = $_POST['desc']; 
	
			if ($_POST['submit']) {
				echo '<p>Your message has been sent!</p>';
			}*/
		?>
	</footer>
</article>
<?php		
			$content = ob_get_contents();
			ob_end_clean();	
			return $content;	
		}
	}
?>