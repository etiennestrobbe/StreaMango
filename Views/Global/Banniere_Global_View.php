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
            <div id="form">
                <form>
                    <label for="login">Login : </label>
                    <input type="text" id="login" name="login"/>
                    <label for="pass">Mot de passe : </label>
                    <input type="password" id="pass" name="pass"/>
                    <input type="submit" id="submit" name="ok" value="OK"/>
                </form>

                <div id="inscription">
                    <p>
                        <a href="#">Inscription ?</a>
                    </p>
                </div>
            </div>



        </banniere>
        <?php
        $footer = ob_get_contents();
        ob_end_clean();

        return $footer;
    }

} 