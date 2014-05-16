<?php
class Add_Stars_View extends Main_Global_View {

    private $star;

    public function Add_Stars_View($viewparams)
    {
        $filmscss = array("films.css");
        $this->setCSS($filmscss);

        $this->films = $viewparams["films"];
    }




    public function mainContent() {

        ob_start();
            function insertInputText($name,$value){?>
                <p><?php echo $name?>
                <input type="text" name="<?php echo $value?>"/></p>
                <?php
            }
            ?>

            <article class="star">
                <header>
                    Ajouter une nouvelle star :
                </header>
                <form action="" method="post">
                    <section class="portrait">
                        <!-- TODO ajouter images -->
                        <div class='file_upload' id='f1'><input name='file[]' type='file'/>1</div>
                        <div id='file_tools'>
                            <img src='./public/img/add.png' id='add_file' title='Add new input' style="width: 30px"/>
                            <img src='./public/img/remove.png' id='del_file' title='Delete' style="width: 30px"/>
                        </div>
                    </section>

                    <section class="informations">
                        <?php
                        insertInputText("Nom","nom");
                        insertInputText("Prénom","prenom");
                        insertInputText("Nationalité","nationalite");
                        insertInputText("Année de naissance","naissance");?>
                        <input type="checkbox" id="check_mort" onclick="displayMort();"/>Décédé <p id="input_mort"></p>
                        <p>Sexe
                            <select name="sexe">
                                <option value="m">Homme</option>
                                <option value="f">Femme</option>
                            </select>
                        </p>
                        <p>Type
                            <input type="checkbox" name="acteur"/>Acteur
                            <input type="checkbox" name="real"/>Réalisateur
                        </p>
                    </section>

                    <section class="filmographie">
                        <p>Filmographie
                            <?php
                                if($this->films) {
                                    foreach ($this->films as $film) {
                                        if ($film->affiches) {
                                            ?>
                                            <input type="checkbox" name="<?php echo $film->getId(); ?>">
                                            <?php

                                            foreach ($film->affiches as $affiche) {
                                                ?>
                                                <img src="<?php echo $affiche->getSrc();?>"/><?php break; ?>
                                            <?php

                                            }

                                        }
                                        ?>
                                    <?php

                                    }
                                }
                            ?>
                        </p>


                    </section>

                    <input type="submit" value="Ajouter"/>
                </form>



            </article>

        <?php
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
?>