<?php
	class ListAll_Films_View extends Main_Global_View {
		
		private $films = array();
		
		public function ListAll_Films_View($viewparams) {
			$filmscss = array("films.css");
			$this->setCSS($filmscss);
			
			$this->films = $viewparams["films"];
		}
		
		public function mainContent() {
			ob_start();
?>

<?php
	if(! $this->films) {
?>
<article>
Aucun film n'est pr&eacute;sent dans la base de donn&eacute;es.
</article>
<?php
	} else {
		
		foreach($this->films as $film) {
?>

<article class="film">
	<header>
		<?php echo $film->getTitre(); ?>
	</header>
	
	<aside>
		<?php
			if($film->affiches) {
			
				foreach($film->affiches as $affiche) {
				
		?>
		
				<img src="<?php echo $affiche->getSrc(); ?>" />
		
		<?php
					
				}
				
			}
		?>
	</aside>
	
	<section>
		<p>Ann&eacute;e : <?php echo $film->getAnnee(); ?></p>
		<p>R&eacute;alisateur :
			<?php if($film->getRealisateur()) { ?>
			<a  href="./index.php?controller=Stars&action=show&id=<?php echo $film->getRealisateur()->getId(); ?>"><?php echo utf8_encode($film->getRealisateur()); ?></a>
			<?php } else { ?>
			R&eacute;alisateur inconnu.
			<?php } ?>
		</p>
		<p>Style : <?php echo utf8_encode($film->getStyle()); ?></p>
		<p>Langue : <?php echo utf8_encode($film->getLangue()); ?></p>
		<h2>Description</h2>
		<p><?php echo utf8_encode($film->getResume()); ?></p>
		<h2>Acteurs</h2>
		<p>
			<?php
				if(!count($film->getPersonnages())) {
			?>
			
			Ce film n'a aucun personnage.<br /><br />
			
			<?php
				}
				else
				{
			?>			
			<ul>
			
				<?php
					foreach($film->getPersonnages() as $role){
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
		<a  href="./index.php?controller=Films&action=edit&id=<?php echo $film->getId(); ?>">Editer</a>
	</footer>
</article>


<?php
		}
	}
?>

<?php
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;	
		}
	}
?>