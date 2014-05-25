<?php

class Show_Stars_View extends Main_Global_View{

    private $star;
    private $films;

    public function Show_Stars_View($param){
        $this->star = $param["star"];
        $this->films = $param["films"];
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
             <article class="msg">
                Cette star n'existe pas !!
            </article></section>
        <?php
        }
        else{
            ?>
            <article class="one">
                <a href="index.php?controller=Stars&action=edit&id=<?php echo $this->star->getId();?>">Editer</a>
                <a id="delStar" href="index.php?controller=Stars&action=del&id=<?php echo $this->star->getId();?>">Supprimer</a>
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
                <article id="films"><p class="msg">Filmographie :</p><?php
                foreach ($this->films as $film) {
				?>					
					<a href="./index.php?controller=Films&action=show&id=<?php echo $film->getId();?>">
                    <article class="film">
                            <aside><?php
                                if ($film->affiches) {
                                        ?>
                                        <img src="<?php echo $film->affiches[0]->getSrc() ?>">
                                    <?php
                                }else{
                                    ?>
                                    <img src="./img/aucuneImage.png"/>
                                    <?php
                                }
                                ?>
                            </aside>
                            <header>
                                <?php echo $film->getTitre(); ?>
                            </header>
                </article>
				</a>
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