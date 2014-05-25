<?php
	class Show_Films_View extends Main_Global_View {

		private $film;
		
		public function Show_Films_View($viewparams) {
			$this->film = $viewparams["film"];
		}
		
		public function mainContent() {
			ob_start();
			if(! $this->film) {
?>

<article>
No film to show.
</article>

<?php
	} else {
?>

<article class="one">
	<header>
		<?php echo $this->film->getTitre(); ?>
	</header>
	
	<aside>
		<?php
			if($this->film->affiches) {
			
				foreach($this->film->affiches as $affiche) {

		?>
		
				<img src="<?php echo $affiche->getSrc(); ?>" />
		
		<?php
					
				}
				
			}
		?>
	</aside>
	
	<section>
		<p>Ann&eacute;e : <?php echo $this->film->getAnnee(); ?></p>
		<p>R&eacute;alisateur :
			<?php if($this->film->getRealisateur()) { ?>
			<a  href="./index.php?controller=Stars&action=show&id=<?php echo $this->film->getRealisateur()->getId(); ?>"><?php echo utf8_encode($this->film->getRealisateur()); ?></a>
			<?php } else { ?>
			R&eacute;alisateur inconnu.
			<?php } ?>
		</p>
		<p>Style : <?php echo utf8_encode($this->film->getStyle()); ?></p>
		<p>Langue : <?php echo utf8_encode($this->film->getLangue()); ?></p>
		<p id="note">Note :
			<?php
				if(! $this->film->note) {
					echo utf8_encode("Ce film n'a pas encore de notes.");
				}
				else {
					if($this->film->note >= 9) {
			?>
			<span><label></label></span>
			<?php
					}
					if($this->film->note >= 7) {
			?>
			<span><label></label></span>
			<?php
					}
					if($this->film->note >= 5) {
			?>
			<span><label></label></span>
			<?php
					}
					if($this->film->note >= 3) {
			?>
			<span><label></label></span>
			<?php
					}
					if($this->film->note >= 1) {
			?>
			<span><label></label></span>
			<?php
					}
					else {
			?>
			<span><label id="nul"></label></span>
			<?php
					}
				}
			?>
		</p>
		<h2>Description</h2>
		<p><?php echo utf8_encode($this->film->getResume()); ?></p>
		<h2>Acteurs</h2>
		<p>
			<?php
				if(!count($this->film->getPersonnages())) {
			?>
			
			Ce film n'a aucun personnage.<br /><br />
			
			<?php
				}
				else
				{
			?>			
			<ul>
			
				<?php
					foreach($this->film->getPersonnages() as $role){
				?>
					
				<li>
					<a  href="./index.php?controller=Stars&action=show&id=<?php echo $role->acteur->getId(); ?>"><?php echo utf8_encode($role->acteur); ?></a> : <?php echo utf8_encode($role->nom); ?>
				</li>
				
				<?php
					}
				?>
			
			</ul>
			
			<?php
				}
			?>
		</p>
	</section>

	<section class="one">
		<form>
			<b>Commenter : </b><input type="text" size="50" id="comment"><br/>
			<b>Note : </b>
			<div id="rating" film="<?php echo $this->film->getId();?>">
			    <span><input type="radio" id="str5" value="5"><label for="str5"></label></span>
			    <span><input type="radio" id="str4" value="4"><label for="str4"></label></span>
			    <span><input type="radio" id="str3" value="3"><label for="str3"></label></span>
			    <span><input type="radio" id="str2" value="2"><label for="str2"></label></span>
			    <span><input type="radio" id="str1" value="1"><label for="str1"></label></span>
			</div>
		</form>
	</section>
	
	<footer>
		<a  href="./index.php?controller=Films&action=edit&id=<?php echo $this->film->getId(); ?>">Editer</a>

        <a id="delFilm" href="index.php?controller=Films&action=delete&id=<?php echo $this->film->getId();?>">Supprimer</a>

		
	</footer>
</article>

<article class="one">
	<h2>Commentaires :</h2>
	<p>
		<?php
			if(!count($this->film->commentaires)) {
		?>
		
		Ce film n'a aucun commentaire.<br /><br />
		
		<?php
			}
			else
			{
		?>			
		<ul>
		
			<?php
				foreach($this->film->commentaires as $commentaire){
			?>
				
			<li>
				<a href="./index.php?controller=Users&action=show&id=<?php echo $commentaire->getAuteur()->getId(); ?>"><?php echo utf8_encode($commentaire->getAuteur()->getPrenom().' '.$commentaire->getAuteur()->getNom()); ?></a> : <?php echo utf8_encode($commentaire->getCommentaire()); ?>
			</li>
			
			<?php
				}
			?>
		
		</ul>
		
		<?php
			}
		?>
	</p>
</article>

<?php
			}
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;	
		}
	}
?>