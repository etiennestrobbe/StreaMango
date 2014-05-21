<?php

class Show_Stars_View extends Main_Global_View{

    private $star;
    private $films;

    public function Show_Stars_View($param1,$param2){
        $this->star = $param1["star"];
        $this->films = $param2["films"];
    }
    /**
     * Permet d'obtenir le contenu principal de la page.
     *
     * @return string
     */
    protected function mainContent()
    {
        ob_start();?>
        <section><?php
        if(!$this->star){
            ?>
            <article>
                Cette star n'existe pas !!
            </article></section>
        <?php
        }
        else{
            ?>
            <article class="star">
                <aside><?php
                foreach($this->star->portraits as $portrait){?>
                    <img src="<?php echo $portrait->getSrc();?>"/>
                    <?php
                }
                    ?>
                </aside>
                <header>
                    <?php echo $this->star->getNom()." ".$this->star->getPrenom();?>
                </header>
                </article>
                <?php
            if(!$this->films){
                echo "<p>Pas de filmographie</p>";
            }
            else {?>Filmographie :<?php
                foreach ($this->films as $film) {
                    ?>
                    <article class="film">

                        <aside><?php
                            if ($film->affiches) {
                                foreach ($film->affiches as $affiche) {
                                    ?>
                                    <img src="<?php echo $affiche->getSrc() ?>">
                                <?php
                                }

                            }
                            ?>
                        </aside>
                        <header>
                            <?php echo $film->getTitre(); ?>
                        </header>
                    </article>
                    </section>
                <?php
                }
            }
                ?>
        <?php
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}