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
	<table>
   <tr>
       <td><label for="title">Titre :</label></td>
       <td><input type="text" name="title" value=''></td>
   </tr>
   <tr>
       <td><label for="year">Année :</label></td>
       <td><input type="text" name="year" value=''></td>
   </tr>
     <tr>
       <td><label for="style">Style :</label></td>
       <td><input type="text" name="style" value=''></td>
   </tr>
   <tr>
       <td><label for="lang">Langue :</label></td>
       <td><input type="text" name="lang" value=''></td>
   </tr>
     <tr>
       <td><label for="desc">Description :</label></td>
       <td><textarea name="desc" cols="70" rows="7"></textarea></td>
   </tr>
</table>
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