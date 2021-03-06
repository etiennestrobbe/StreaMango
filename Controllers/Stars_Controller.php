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
        $view->display("","Stars");

    }

    public function edit($param){
        $stars = Nf_ActeurReaManagement::getInstance()->idToPeople($param["id"]);
        $actor = new Data_Acteur($stars);
        $real = new Data_Realisateur($stars);

        $filmForActor = Nf_FilmManagement::getInstance()->getFilmsParActeur($actor);
        $filmForReal = Nf_FilmManagement::getInstance()->getFilmsParRea($real);
        $films = ($filmForActor)?$filmForActor:$filmForReal;

        foreach($films as $key => $film){
            $films[$key]->affiches = Nf_FilmManagement::getInstance()->getAffiches($film);
        }

        $viewparams["star"] = $stars;
        $viewparams["films"] = $films;
        $view = new Edit_Stars_View($viewparams);
        $view->display("","Stars");

    }

    public function edit_the_star(){
        /* Récupération des données $_POST */
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $nationalite = $_POST["nationalite"];
        $naissance = (int)$_POST["naissance"];
        $sex = ($_POST["sexe"]=="f");

        /* Init des DB */
        $list_acteurs_reals = Nf_ActeurReaManagement::getInstance();

        /* Init date dèces si checked */
        if(isset($_POST["check_mort"])){
            $date_mort = $_POST["deces"];
        }

        /* Creation de l'objet acteur */
        $people = new Data_People($nom,$prenom,$naissance,$nationalite,$sex);

        /* S'il est mort on ajoute sa date de mort */
        if(isset($date_mort)){
            $people->setMort($date_mort);
        }
        $acteur = new Data_Acteur($people);
        $list_acteurs_reals->updatePersonne(Nf_ActeurReaManagement::getInstance()->idToPeople($_POST["id_star"]),$acteur);

        /* Recuperation image */
        if(isset($_POST["url"])){
            foreach($_POST["url"] as $key => $a_file){
                $list_acteurs_reals->addPortraitAUnePersonne($acteur,$a_file);
            }
        }

        $link = "index.php?controller=Stars&action=show&id=".$_POST["id_star"];
        header('Location:'.$link);
    }

    public function del($param){
        $id = $param["id"];
        Nf_ActeurReaManagement::getInstance()->removePersonne(Nf_ActeurReaManagement::getInstance()->idToPeople($id));
        $link = "index.php?controller=Stars&action=listAllStar";
        header('Location:'.$link);

    }

    public function add_the_star(){
        /* Récupération des données $_POST */
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $nationalite = $_POST["nationalite"];
        $naissance = (int)$_POST["naissance"];
        $sex = ($_POST["sexe"]=="f");



        /* Init des DB */
        $list_films = Nf_FilmManagement::getInstance();
        $list_acteurs_reals = Nf_ActeurReaManagement::getInstance();


        /* Init date dèces si checked */
        if(isset($_POST["check_mort"])){
            $date_mort = $_POST["deces"];
        }


        /* Creation de l'objet acteur */
        $people = new Data_People($nom,$prenom,$naissance,$nationalite,$sex);

        /* S'il est mort on ajoute sa date de mort */
        if(isset($date_mort)){
            $people->setMort($date_mort);
        }
        // Si la case acteur a été coché
        //if(isset($_POST["acteur"])){
        $acteur = new Data_Acteur($people);
        $list_acteurs_reals->addActeur($acteur);
        //}
        // Si la case real a été coché

        /* Recuperation image */
        if(isset($_POST["url"])){
            foreach($_POST["url"] as $key => $a_file){
                $list_acteurs_reals->addPortraitAUnePersonne($acteur,$a_file);
            }
        }

        /* Liaison de l'acteur aux films */
        if(!empty($_POST["check_list_acteur"])){
            foreach($_POST["check_list_acteur"] as $check){
                $films_to_change  = $list_films->idToFilm($check);
                $role = new Data_Role($nom,$acteur);
                $list_films->addPersonnagesAuFilm($films_to_change,$role);
            }

        }

        header('Location:index.php?controller=Stars&action=listAllStar');

    }

    public function add_the_real(){
        /* Récupération des données $_POST */
        $nom = $_POST["nomReal"];
        $prenom = $_POST["prenomReal"];
        $nationalite = $_POST["nationaliteReal"];
        $naissance = (int)$_POST["naissanceReal"];
        $sex = ($_POST["sexeReal"]=="f");



        /* Init des DB */
        $list_films = Nf_FilmManagement::getInstance();
        $list_acteurs_reals = Nf_ActeurReaManagement::getInstance();


        /* Init date dèces si checked */
        if(isset($_POST["check_mortReal"])){
            $date_mort = $_POST["decesReal"];
        }


        /* Creation de l'objet acteur */
        $people = new Data_People($nom,$prenom,$naissance,$nationalite,$sex);

        /* S'il est mort on ajoute sa date de mort */
        if(isset($date_mort)){
            $people->setMort($date_mort);
        }
        // Si la case acteur a été coché
        //if(isset($_POST["acteur"])){
        $acteur = new Data_Realisateur($people);
        $list_acteurs_reals->addRealisateur($acteur);
        //}
        // Si la case real a été coché

        /* Recuperation image */
        if(isset($_POST["urlReal"])) {
            foreach ($_POST["urlReal"] as $key => $a_file) {
                $list_acteurs_reals->addPortraitAUnePersonne($acteur, $a_file);
            }
        }

        header('Location:index.php?controller=Stars&action=listAllStar');

    }


	
	public function show($param){
        $star_to_show = Nf_ActeurReaManagement::getInstance()->idToPeople($param["id"]);
        if($star_to_show) {
            $actor = new Data_Acteur($star_to_show);
            $real = new Data_Realisateur($star_to_show);

            $star_to_show->portraits = Nf_ActeurReaManagement::getInstance()->getPortraits($star_to_show);
            $filmForActor = Nf_FilmManagement::getInstance()->getFilmsParActeur($actor);
            $filmForReal = Nf_FilmManagement::getInstance()->getFilmsParRea($real);
            $films_of_stars = ($filmForActor) ? $filmForActor : $filmForReal;
            foreach ($films_of_stars as $film) {
                $film->affiches = Nf_FilmManagement::getInstance()->getAffiches($film);
            }
            $viewparam["star"] = $star_to_show;
            $viewparam["films"] = $films_of_stars;
        }
        else{
            $viewparam["star"] = null;
            $viewparam["film"] = null;
        }


        $view = new Show_Stars_View($viewparam);
        $view->display("","Stars");
    }


	public function listAllStar(){

        $stars = Nf_ActeurReaManagement::getInstance()->getPersonnes();

        function starCmp($star1, $star2) {
            return strcmp($star1->getNom(), $star2->getNom());
        }
        uasort($stars,'starCmp');

        foreach($stars as $key=>$star){
            $stars[$key]->portraits = Nf_ActeurReaManagement::getInstance()->getPortraits($star);
        }

        $viewparams["stars"] = $stars;
        $view = new ListAll_Stars_View($viewparams);
        $view->display("index.php?controller=Stars&action=add_star","Stars",1);


    }

    public function search(){
        $param = $_POST["search"];
        $res = $this->privateSearch($param);
        if($res){
            $id["id"] = $res->getId();
            $this->show($id);
        }
        else{
            $this->show(null);
        }

    }

    private function privateSearch($param){
        $peoples = Nf_ActeurReaManagement::getInstance();
        if(isset($param)) {
            $termes = explode("%20",$param);
            foreach($termes as $key => $value) {

                $res = $peoples->getPersonnes($value);
                foreach ($res as $key2 => $film) {
                    return $film;
                }
            }
        }
        return null;
    }
}