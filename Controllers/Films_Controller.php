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
			$view->display();
		}

		public function show($params) {
			$film = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
			$film->affiches = Nf_FilmManagement::getInstance()->getAffiches($film);
			$film->commentaires = Nf_CommNoteManagement::getInstance()->getCommentairesParFilm($film);

			$viewparams["film"] = $film;

			$view = new Show_Films_View($viewparams);
			$view->display();
		}
		
		public function edit($params) {
			$film = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
			$view = new Edit_Films_View($film);
			$view->display();
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
			
			$viewparams["films"] = $new;
			$view = new ListAll_Films_View($viewparams);
			$view->display();
		}
			
		public function add($params) {
			$view = new Add_Films_View($params);
			$view->display();
		}
	}
?>