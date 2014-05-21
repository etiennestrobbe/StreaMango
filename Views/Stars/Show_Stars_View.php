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
            <article class="one">
                <header>
                    <?php echo $this->star->getNom()." ".$this->star->getPrenom();?>
                </header>
                <aside><?php
                foreach($this->star->portraits as $portrait){?>
                    <img src="<?php echo $portrait->getSrc();?>"/>
                    <?php
                }
                    ?>
                </aside>
                <section>
                    <p>Année de naissance : <?php echo $this->star->getNaissance();?></p>
                    <?php $mort = $this->star->getMort();
                    echo ($mort == -1)?"":"<p>Date de dèces : ".$mort." (".($mort-$this->star->getNaissance())." ans)</p>";

                    ?>
                    <p>Nationalité : <?php echo $this->star->getNationalite();?></p>
                    <p>Sexe : <?php echo ($this->star->isSexeFeminin())?"Feminin":"Masculin";?></p>


                </section>

                </article>
                <?php
            if(!$this->films){
                echo "<p>Pas de filmographie</p>";
            }
            else {?>
                <article class="one">Filmographie :<?php
                foreach ($this->films as $film) {
                    ?>
                    <a href="./index.php?controller=Films&action=show&id=<?php echo $film->getId();?>">
                        <article class="one">
                            <aside><?php
                                if ($film->affiches) {
                                        ?>
                                        <img src="<?php echo $film->affiches[0]->getSrc() ?>">
                                    <?php

                                }
                                else{
                                    ?>
                                    <img src="./img/aucuneImage.png"/>
                                    <?php
                                }
                                ?>
                            </aside>
                            <header>
                                <?php echo $film->getTitre(); ?>
                            </header>
                    </a>
                </article>
                <?php
                }
            }
                ?>
            </article>
        <?php
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}