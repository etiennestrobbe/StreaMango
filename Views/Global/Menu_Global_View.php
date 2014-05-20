<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sebastien Petillon
 * Date: 5/20/14
 * Time: 6:37 PM
 */

class Menu_Global_View {
    public function getMenu() {
        ob_start();
        ?>
        <nav>
            <a href="#">Accueil</a>
            <a class="currentPage" href="index.php?controller=Films&action=listAll">Films</a>
            <a href="index.php?controller=Stars&action=add_star">Stars</a>
            <a href="#">Profil</a>
            <img src="img/moins.png"/>
        </nav>
        <?php
        $footer = ob_get_contents();
        ob_end_clean();

        return $footer;
    }

}


?>