<?php
/**
 * Created by IntelliJ IDEA.
 * User: Etienne Strobbe
 * Date: 4/23/14
 * Time: 3:49 PM
 */

class Stars_Controller {

    /**
     * display a page to add a star
     */
    public function add_star(){
        $view = new Add_Star_View(null);
        echo("maman");
        $view->display();

    }

} 