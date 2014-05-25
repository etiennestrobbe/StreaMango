<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sebastien Petillon
 * Date: 5/20/14
 * Time: 6:55 PM
 */

class Search_Global_View {

    private $link;
    private $controller;

    public function Search_Global_View($param,$controller){
        $this->controller = $controller;
        $this->link = $param;
    }

    function getSearch(){
        ob_start();
        ?>
<section id="barre-recherche">
    <img id="loupe" src="img/loupe.png"/>
    <form method="post" action="index.php?controller=<?php echo $this->controller;?>&action=search">
        <input type="text" id="search" name="search"/>
        <input type="submit" id="controller_search" value="Search"/>
    </form>
    <a href="<?php echo $this->link;?>" ><img id="plus" src="img/ajouter.png"/></a>
</section>
<?php
        $footer = ob_get_contents();
        ob_end_clean();

        return $footer;
    }

} 