<?php
	class Add_Films_View extends Main_Global_View {
		private $directors = array();
		private $actors = array();

		public function Add_Films_View($params) {
			$this->directors = $params["directors"];
			$this->actors = $params["actors"];
			$filmscss = array("films.css");
			$this->setCSS($filmscss);
		}

		public function mainContent() {
			ob_start();
?>
<section id="add_acteur" class="formulaire">
    <article class="formArticle">
        <header>
            Ajouter un film
        </header>
         <form name="form_star" action="index.php?controller=Films&action=validateAdd" method="POST">

            <section class="informations">
                <label for="title">Titre :</label><input type="text" name="title" value=''>

                <label for="year">Annee :</label>
                <input type="text" name="year" value=''>

                <label for="style">Style :</label>
                <input type="text" name="style" value=''>

                <label for="lang">Langue :</label>
            <input type="text" name="lang" value=''>
            </section>

            <div class="description">
                <label for="desc">Description :</label>
                <textarea name="desc" rows="7"></textarea>
            </div>

            <div class="realisateur">
                <label for="real">Selectionner un realisateur :</label>


                <?php
                    foreach($this->directors as $rea) {
                    ?>
                    <li>
                        <?php
                            $name = utf8_encode($rea->getPrenom()) . " " . utf8_encode($rea->getNom());
                            $id = $rea->getId();
                             echo $name;
                        ?>
                        <input type="radio" name="real" value='<?php echo $id;?>'><br>

                    </li>
                    <?php
                        }
                    ?>


                <div class='url_img' id='f1'>Url d'une image<input name='url[]' type='text'/></div>
            </div>


            <section class="filmographie">
                    <?php
                    if($this->actors) {
                        foreach($this->actors as $actor) {
                        ?>
                                <div class="role">
                                <input class="checkboxFilm" type="checkbox" name="check_list_acteur[]" value='<?php echo $actor->getId();?>' id='<?php echo $actor->getId()?>'>
                            <?php
                            if($actor->portraits){
                                ?>
                                            <img id="imageRole<?php echo $actor->getId()?>" src="<?php echo $actor->portraits[0]->getSrc();?>"/>
                            <?php
                            }
                            else{
                            ?>
                                <img id="imageRole<?php echo $actor->getId()?>" src="./img/personneDefaut.png"/>
                            <?php
                            }
                            ?>
                                <div id="hiddenRole<?php echo $actor->getId()?>">
                                    <p>Role :<input type="text" name="role<?php echo $actor->getId();?>"></p>
                                </div>

                            </div>
    <?php
                        }
                    }
                        ?>
            </section>
            <input type="submit">
        </form>
    </article>
            </section>

<?php
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
		}
	}

?>