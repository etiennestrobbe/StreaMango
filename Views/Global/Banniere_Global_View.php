<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sebastien Petillon
 * Date: 5/20/14
 * Time: 6:45 PM
 */

class Banniere_Global_View {

    public function getBanniere() {
        ob_start();
        ?>
        <banniere>


            <img src="img/logo.png" />
            <?php if(isset ($_SESSION["connected"])) {
                if ($_SESSION["connected"] == "true") {
                    ?>
					<div id="logout" class="deconnexion"><a href="#">Déconnexion ?</a></div>
                <?php
                }
                else {
                    ?>
                    <form id="form" method="post">
                        <div class="err" id="add_err"></div>
                        <label for="login">Login : </label>
                        <input type="text" id="login" name="login"/>
                        <label for="pass">Mot de passe : </label>
                        <input type="password" id="pass" name="pass"/>
                        <input type="submit" id="submit_log" name="ok" value="OK"/>
						<div id="inscription">Inscription ?</div>
                    </form>

                    
                <?php
                }
            }
            else {
                ?>
                <form id="form" method="post">
                    <div class="err" id="add_err"></div>
                    <label for="login">Login : </label>
                    <input type="text" id="login" name="login"/>
                    <label for="pass">Mot de passe : </label>
                    <input type="password" id="pass" name="pass"/>
                    <input type="submit" id="submit_log" name="ok" value="OK"/>
					<div id="inscription">
							<a href="#">Inscription ?</a>
					</div>
                </form>

            <?php
            }?>

            <article id="form_inscr">
                <label for="nom">Nom : </label>
                <input type="text" id="nom_ins" name="nom"/>
                <label for="prenom">Prenom : </label>
                <input type="text" id="prenom_ins" name="prenom"/>
                <label for="pass">Mot de passe : </label>
                <input type="password" id="pass_ins" name="pass"/>
                <input type="button" id="submit_ins" name="ok" value="Inscription"/>
            </article>





        </banniere>
        <?php
        $footer = ob_get_contents();
        ob_end_clean();

        return $footer;
    }

} 