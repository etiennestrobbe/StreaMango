<?php
/**
 * Created by IntelliJ IDEA.
 * User: Etienne Strobbe
 * Date: 5/20/14
 * Time: 7:32 PM
 */

class Edit_Stars_View extends Main_Global_View{

    private $star;
    private $films;

    public function Edit_Stars_View($viewparams)
    {
        $this->star = $viewparams["star"];
        $this->films = $viewparams["films"];
    }




    public function mainContent()
    {

        ob_start();
        ?>
        <section class="formulaire"><?php
        if(!$this->star){
            ?>
            <article>
                <?php echo $this->star ?>
                Cette star n'existe pas !!
            </article></section>
            <?php
        }
        else{
            ?>
                <article class="formArticle">
                    <header>
                        Editer :
                    </header>
                    <form name="form_star" action="index.php?controller=Stars&action=edit_the_star" method="post" onsubmit="return validateFormStar();">
                        <section class="portrait">
                            <!-- TODO faire plus tard... -->
                        </section>

                        <section class="informations">
                            <p>Nom : <input type="text" name="nom" value="<?php echo $this->star->getNom();?>" /></p>
                            <p>Prénom : <input type="text" name="prenom" value="<?php echo $this->star->getPrenom();?>" /></p>
                            <p>Année de naissance: <input type="text" name="naissance" value="<?php echo $this->star->getNaissance();?>" /></p>
                            <p> Nationalité :
                                <select name="nationalite">
                                    <?php
                                    $enumNationalite = Data_NATIONALITE::getValues();
                                    foreach($enumNationalite as $nationalite) {
                                        ?>
                                        <option
                                            <?php if ($nationalite == $this->star->getNationalite()) echo "selected"; ?> value="<?php echo $nationalite; ?>"><?php echo strtolower($nationalite); ?></option>
                                    <?php
                                    }
                                        ?>
                                </select>
                                </p>
                                <!--php insertInputText("Année de naissance","naissance");?> -->
                                <input type="checkbox" id="check_mort" name="check_mort" onclick="displayMort();"/>Décédé <p id="input_mort"></p>
                            <p>Sexe
                                <select name="sexe">
                                    <option <?php if(!$this->star->isSexeFeminin()) echo "selected" ?>value="m">Homme</option>
                                    <option <?php if($this->star->isSexeFeminin()) echo "selected" ?> value="f">Femme</option>
                                </select>
                            </p>
                            <p>Type
                                <input type="radio" name="typeStar" value="acteur"> Acteur<br/>
                                <input type="radio" name="typeStar" value="real"> Réalisateur <br/>
                            </p>
                            <input type="hidden" name="id_star" value="<?php echo $this->star->getId();?>"
                        </section>

                        <!-- TODO check en JS si tous les truc sont bien remplis -->
                        <input type="submit" value="Modifier"/>
                    </form>



                </article></section>
<?php
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

} 