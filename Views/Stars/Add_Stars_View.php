<?php
class Add_Stars_View extends Main_Global_View {


    public function Add_Stars_View($viewparams)
    {
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

        <section id="add_acteur" class="formulaire">
            <article class="formArticle">
                <header>
                    Ajouter une nouvelle star :
                </header>
                <form name="form_star" action="index.php?controller=Stars&action=add_the_star" method="post" onsubmit="return validateFormStar();">
                    <section class="portrait">
                        <div id='file_tools'>
                            <img src='./public/img/add.png' id='add_file' title='Add new input' style="width: 30px"/>
                            <img src='./public/img/remove.png' id='del_file' title='Delete' style="width: 30px"/>
                        </div>
                        <div class='url_img' id='f1'>Url d'une image :<input name='url[]' type='text'/></div>

                    </section>

                    <section class="informations">
                        <?php
                        insertInputText("Nom","nom");
                        insertInputText("Prénom","prenom");?>
                        <p> Nationalité :
                            <select name="nationalite">
                                <?php
                                $enumNationalite = Data_NATIONALITE::getValues();
                                foreach($enumNationalite as $nationalite) {
                                    ?>
                                    <option value="<?php echo $nationalite; ?>"><?php echo strtolower($nationalite); ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            </p>
                        <?php insertInputText("Année de naissance","naissance");?>
                        <input type="checkbox" id="check_mort" name="check_mort" onclick="displayMort();"/>Décédé <p id="input_mort"></p>
                        <p>Sexe
                            <select name="sexe">
                                <option value="m">Homme</option>
                                <option value="f">Femme</option>
                            </select>
                        </p>
                    </section>

                    <section class="filmographie">
                        <p>Filmographie
                            <?php
                                if($this->films) {
                                    foreach ($this->films as $film) {
                                        if ($film->affiches) {
                                            ?>
                            <div class="role">
                                <input id="checkboxFilm<?php echo $film->getId();?>" class="checkboxFilm" type="checkbox" name="check_list_acteur[]" value="<?php echo $film->getId();?>">


                                            <?php

                                            foreach ($film->affiches as $affiche) {
                                                ?>
                                                <img id="imageRole<?php echo $film->getId()?>" src="<?php echo $affiche->getSrc();?>"/>
                            <div id="hiddenRole<?php echo $film->getId()?>"><p>Role :<input type="text" name="role<?php echo $film->getId();?>"></p></div></div><?php break; ?>
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



            </article></section>

        <?php
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
?>