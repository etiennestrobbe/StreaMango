<?php
	class Show_Films_View extends Main_Global_View {

		private $film;
		
		public function Show_Films_View($viewparams) {
			$filmscss = array("films.css");
			$this->setCSS($filmscss);
			
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

<article class="film">
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
	
	<footer>
		<a  href="./index.php?controller=Films&action=edit&id=<?php echo $this->film->getId(); ?>">Editer</a>
	</footer>
</article>

<?php
			}
			// TODO (Marc)
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;	
		}
	}
?>