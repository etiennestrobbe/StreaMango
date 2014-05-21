<?php
	class ListAll_Films_View extends Main_Global_View {
		
		private $films = array();
		
		public function ListAll_Films_View($viewparams) {
			
			$this->films = $viewparams["films"];
		}
		
		public function mainContent() {
			ob_start();
?>
            <section id="films">

<?php
	if(! $this->films) {
?>
<article>
Aucun film n'est pr&eacute;sent dans la base de donn&eacute;es.
</article>
        </section>
<?php
	} else {?>
		<!--<header>
			<a  href="./index.php?controller=Films&action=add">Ajouter un film</a>
		</header>--><?php
		foreach($this->films as $film) {
?>
            <article class="film">

		<aside>
            <?php
            if($film->affiches) {

                ?>

                <img src="<?php echo $film->affiches[0]->getSrc(); ?>" />

            <?php

            }
            ?>
		</aside>
                <header>
                    <a href="./index.php?controller=Films&action=show&id=<?php echo $film->getId(); ?>"><?php echo $film->getTitre(); ?></a>
                </header>
            </article>

<?php
		}
        ?>
        </section>
        <?php
	}
?>

<?php
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;	
		}
	}
?>