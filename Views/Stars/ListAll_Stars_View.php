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
                <article class="acteur">
                    <aside><?php
                    if($star->portraits){
                        foreach($star->portraits as $portrait){?>
                            <img src="<?php echo $portrait->getSrc()?>"><?php
                            break;
                        }
                    }
                        ?>
                    </aside>
                    <header>
                        <?php echo $star->getNom()." ".$star->getPrenom()?>
                    </header>
                </article>
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