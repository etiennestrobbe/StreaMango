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
                    <a id="logout">Déconnexion</a>
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
                    </form>

                    <div id="inscription">
                        <p>
                            <a href="#">Inscription ?</a>
                        </p>
                    </div>
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
                </form>

                <div id="inscription">
                    <p>
                        <a href="#">Inscription ?</a>
                    </p>
                </div>
            <?php
            }?>





        </banniere>
        <?php
        $footer = ob_get_contents();
        ob_end_clean();

        return $footer;
    }

} 