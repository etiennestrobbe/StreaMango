<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sebastien Petillon
 * Date: 5/20/14
 * Time: 6:55 PM
 */

class Search_Global_View {

    function getSearch(){
        ob_start();
        ?>
<section id="barre-recherche">
    <img id="loupe" src="img/loupe.png" onClick="hideShowResearch();"/>
    <form>
        <input type="text" id="search" name="search"/>
    </form>
		<a  href="./index.php?controller=Films&action=add">
			<img id="plus" src="img/ajouter.png"/>
		</a>
</section>
<?php
        $footer = ob_get_contents();
        ob_end_clean();

        return $footer;
    }

} 