<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sebastien Petillon
 * Date: 5/20/14
 * Time: 6:55 PM
 */

class Search_Global_View {

    private $link;

    public function Search_Global_View($param){
        $this->link = $param;
    }

    function getSearch(){
        ob_start();
        ?>
<section id="barre-recherche">
    <img id="loupe" src="img/loupe.png" onClick="hideShowResearch();"/>
    <form>
        <input type="text" id="search" name="search"/>
    </form>
    <a href="<?php echo $this->link;?>" ><img id="plus" src="img/ajouter.png"/></a>
</section>
<?php
        $footer = ob_get_contents();
        ob_end_clean();

        return $footer;
    }

} 