<?php

class ListAll_Stars_View extends Main_Global_View{

    private $stars;

    public function ListAll_Stars_View($viewparams)
    {
        $this->stars = $viewparams["stars"];
    }

    /**
     * Permet d'obtenir le contenu principal de la page.
     *
     * @return string
     */
    protected function mainContent()
    {
        ob_start();?>
        <section id="acteurs"><?php
        if(!$this->stars){
            ?>
            <article>
                Aucune star !
            </article></section>
        <?php
        }
        else{
            foreach($this->stars as $star) {

                ?>
				<a href="./index.php?controller=Stars&action=show_star&id=<?php echo $star->getId(); ?>">
                <article class="acteur">
                    <aside><?php
                    if($star->portraits){
                        ?>
                        <img src="<?php echo $star->portraits[0]->getSrc()?>">
						<?php
                    }
					else{
                        ?>
						<img src="./img/personneDefaut.png" />
						<?php
					}
                        ?>
                    </aside>
                    <header>
                        <?php echo $star->getNom()." ".$star->getPrenom()?>
                    </header>
                </article>
				</a>
            <?php
            }
            ?>
</section>
<?php
        }
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}