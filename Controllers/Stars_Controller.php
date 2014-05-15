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
    public function add_star($param){
        $limit = 0;
        if(isset($params["limit"])) {
            $limit = (int) $params["limit"];
        }

        $films = Nf_FilmManagement::getInstance()->getFilms();

        function filmCmp($film1, $film2) {
            return strcmp($film1->getTitre(), $film2->getTitre());
        }

        uasort($films, 'filmCmp');

        foreach($films as $key => $film) {
            $films[$key]->affiches = Nf_FilmManagement::getInstance()->getAffiches($film);
        }

        $viewparams["films"] = $films;
        $view = new Add_Stars_View($viewparams);
        $view->display();

    }

} 