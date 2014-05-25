<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sebastien Petillon
 * Date: 5/20/14
 * Time: 6:37 PM
 */

class Menu_Global_View {
    public function getMenu($param =0) {
        ob_start();
        ?>
        <nav>
            <a href="index.php?controller=Accueil">Accueil</a>
            <a class="currentPage" href="index.php?controller=Films&action=listAll">Films</a>
            <a href="index.php?controller=Stars&action=listAllStar">Stars</a>
            <a href="./index.php?controller=Users&action=show&id=<?php if($_SESSION["connected"]=="true"){echo unserialize($_SESSION["user"])->getId();}else {echo 0;} ?>">Profil</a>
            <?php if($param!=0) { ?>
                <img id="hide_show_button" src="img/plus.png"/>
            <?php
            }
            ?>
        </nav>
        <?php
        $footer = ob_get_contents();
        ob_end_clean();

        return $footer;
    }

}


?>