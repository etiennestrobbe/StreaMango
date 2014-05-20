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
                <form name="form_star" action="index.php?controller=Stars&action=add_the_star" method="post" onsubmit="return validateFormStar();">
                    <section class="portrait">
                        <div class='url_img' id='f1'>Url d'une image<input name='url[]' type='text'/>1</div>
                        <div id='file_tools'>
                            <img src='./public/img/add.png' id='add_file' title='Add new input' style="width: 30px"/>
                            <img src='./public/img/remove.png' id='del_file' title='Delete' style="width: 30px"/>
                        </div>
                    </section>

                    <section class="informations">
                        <?php
                        insertInputText("Nom","nom");
                        insertInputText("Prénom","prenom");?>
                        <p> Nationalité :
                            <select name="nationalite">
                                <option value="FRANCAISE">Française</option>
                                <option value="AMERICAINE">Américaine</option>
                                <option value="ANGLAISE">Anglaise</option>
                                <option value="BELGE">Belge</option>
                                <option value="ITALIENNE">Italienne</option>
                                <option value="ESPAGNOL">Espagnol</option>
                                <option value="GRECQUE">Grecque</option>
                                <option value="TCHEQUE">Tchèque</option>
                                <option value="ALLEMANDE">Allemande</option>
                                <option value="SUISSE">Suisse</option>
                                <option value="PORTUGAISE">Portugaise</option>
                                <option value="MONEGASQUE">Monégasque</option>
                                <option value="POLONAISE">Polonaise</option>
                                <option value="AUTRICHIENNE">Autrichienne</option>
                                <option value="DANOISE">Danoise</option>
                                <option value="IRLANDAISE">Irlandaise</option>
                                <option value="SUEDOISE">Suedoise</option>
                                <option value="NORVEGIENNE">Norvegienne</option>
                                <option value="FILANDAISE">Finlandaise</option>
                                <option value="ESTONIENNE">Estonienne</option>
                                <option value="LETONNE">Letonne</option>
                                <option value="LITUANIENNE">Lituanienne</option>
                                <option value="GEORGIENNE">Georgienne</option>
                                <option value="ROUMAINE">Roumaine</option>
                                <option value="MOLDAVE">Moldave</option>
                                <option value="SLOVENE">Slovène</option>
                                <option value="SLOVAQUE">Slovaque</option>
                                <option value="CROATE">Croate</option>
                                <option value="SERBE">Serbe</option>
                                <option value="UKRAINIENNE">Ukrainienne</option>
                                <option value="BIELORUSSE">Bielorusse</option>
                                <option value="RUSSE">Russe</option>
                                <option value="LUXEMBOURGEOISE">Luxembourgeoise</option>
                                <option value="HOLLANDAISE">Hollandaise</option>
                                <option value="CANADIENNE">Canadienne</option>
                                <option value="JAPONAISE">Japonaise</option>
                                <option value="INDIENNE">Indienne</option>
                                <option value="CHINOISE">Chinoise</option>
                                <option value="EGYPTIENNE">Egyptienne</option>
                                <option value="MAROCAINE">Marocaine</option>
                                <option value="ALGERIENNE">Algérienne</option>
                                <option value="TUNISIENNE">Tunisienne</option>
                                <option value="BRESILIENNE">Bresilienne</option>
                                <option value="MEXICAINE">Mexicaine</option>
                                <option value="MONGOLE">Mongole</option>
                                <option value="AUSTRALIENNE">Australienne</option>
                                <option value="NEOZELANDAISE">Neozelandaise</option>
                                <option value="ECOSSAISE">Ecossaise</option>
                                <option value="GALLOISE">Galloise</option>
                                <option value="ARGENTINE">Argentine</option>
                                <option value="CHILIENNE">Chilienne</option>
                                <option value="PERUVIENNE">Peruvienne</option>
                                <option value="BOLIVIENNE">Bolivienne</option>
                                <option value="COLOMBIENNE">Colombienne</option>
                            </select>
                        <?php insertInputText("Année de naissance","naissance");?>
                        <input type="checkbox" id="check_mort" name="check_mort" onclick="displayMort();"/>Décédé <p id="input_mort"></p>
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
                                            <input type="checkbox" name="check_list_acteur[]" value="<?php echo $film->getId();?>">
                                            <p>Role :<input type="text" name="role<?php echo $film->getId();?>"></p>
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
                    <!-- TODO check en JS si tous les truc sont bien remplis -->
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