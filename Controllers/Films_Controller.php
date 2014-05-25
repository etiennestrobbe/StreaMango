<?php
	class Films_Controller {
			
		public function listAll($params) {
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
			
			$view = new ListAll_Films_View($viewparams);
			$view->display("index.php?controller=Films&action=add","Films",1);
		}

		public function show($params) {
            $film = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
            if($film) {
                $film->affiches = Nf_FilmManagement::getInstance()->getAffiches($film);
                $film->commentaires = Nf_CommNoteManagement::getInstance()->getCommentairesParFilm($film);

                $viewparams["film"] = $film;
            }
            else {
                $viewparams["film"] = null;
            }

			$view = new Show_Films_View($viewparams);
			$view->display("","Films");
		}
		
		public function edit($params) {
			$film = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
			$view = new Edit_Films_View($film);
			$view->display("","Films");
		}
		
		public function delete($params) {
			$film = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
			$film = Nf_FilmManagement::getInstance()->removeFilm($film);
			
			header('Location:index.php');
		}
			
		public function validateEdit($params) {
			$titre = $_POST['title'];
			$annee = $_POST['year'];
			$style = $_POST['style'];
			$lang = $_POST['lang'];
			$desc = $_POST['desc'];
			$rea = $_POST['real'];
			$roles;
			$actors;

			$old = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
			$new = new Data_Film();
			$new->setTitre($titre);
			$new->setAnnee($annee);
			$new->setStyle($style);
			$new->setLangue($lang);
			$new->setResume($desc);
			
			$realisateur = new Data_Realisateur();
			
			//$realisateur = $rea;
			$new->setRealisateur($realisateur);
			
			// Requete de mise à jour
			Nf_FilmManagement::getInstance()->updateFilm($old, $new);
			
			 header('Location:index.php');
		}
			
		public function add($params) {	
			// On récupère la liste des réalisateurs et des acteurs
			$realisateurs = Nf_ActeurReaManagement::getInstance()->getRealisateurs();
			$acteurs = Nf_ActeurReaManagement::getInstance()->getActeurs();
			
			// On les tri
			function peopleCmp($p1, $p2) {
				return strcmp($p1->getNom(), $p2->getNom());
			}
			uasort($realisateurs,'peopleCmp');
			uasort($acteurs,'peopleCmp');

			foreach($acteurs as $key=>$value){
				$acteurs[$key]->portraits = Nf_ActeurReaManagement::getInstance()->getPortraits($value);
			}
	
			// On les envoi à la Add_Film_View
			$viewparams["directors"] = $realisateurs;
			$viewparams["actors"] = $acteurs;			
			
			$view = new Add_Films_View($viewparams);
			$view->display("","Films");
		}
		
		public function validateAdd($params) {
			$titre = $_POST['title'];
			$annee = $_POST['year'];
			$style = $_POST['style'];
			$lang = $_POST['lang'];
			$desc = $_POST['desc'];
			$rea = $_POST['real'];		

			$real = Nf_ActeurReaManagement::getInstance()->idToPeople($rea);		
			$realisateur = new Data_Realisateur($real);
			
			$new = new Data_Film();
			$new->setTitre($titre);
			$new->setAnnee($annee);
			$new->setStyle($style);
			$new->setLangue($lang);
			$new->setResume($desc);
			$new->setRealisateur($realisateur);

			$film = Nf_FilmManagement::getInstance()->addFilmComplet($new);
			
			echo("la ?");
			echo("Test".$_POST['check_list_acteur']);
			echo("TEST:".$test);

			
			if(!empty($_POST['check_list_acteur'])){
				echo("NOT EMPTY");
				foreach($_POST['check_list_acteur'] as $check){
					$acteur  = Nf_ActeurReaManagement::getInstance()->idToPeople($check);	
					$role = new Data_Role($_POST['role'.$check],$acteur);
					echo("ROLE".$role);
					$film = Nf_FilmManagement::getInstance()->addPersonnagesAuFilm($film,$role);
				}
			}
			
			 /* Recuperation image */
       /* if(isset($_POST["url"])){
            foreach($_POST["url"] as $key => $a_file){
                $list_acteurs_reals->addPortraitAUnePersonne($acteur,$a_file);
            }
        }*/
		
			//header('Location:index.php');
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
            $films = Nf_FilmManagement::getInstance();
            if(isset($param)) {
                $termes = explode("%20",$param);
                foreach($termes as $key => $value) {

                    $res = $films->getFilmsParTitre($value);
                    foreach ($res as $key2 => $film) {
                        return $film;
                    }
                }
            }
            return null;
        }
	}